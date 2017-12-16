<?php

namespace app\controllers;

use app\models\Datenblatt;
use app\models\Vorlage;
use Yii;
use app\models\Abschlag;
use app\models\AbschlagSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;


/**
 * AbschlagController implements the CRUD actions for Abschlag model.
 */
class AbschlagController extends Controller
{
    public function behaviors()
    {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionSerienbrief()
    {
        $datenblattIds = [];
        $maxCountAbschlags = null;
        $abschlagModel = new Abschlag(
            [
                'erstell_datum' => date('Y-m-d H:i:s')
            ]
        );

        $data = array();
        if (Yii::$app->request->isPost) {

            $submit = Yii::$app->request->post('submit', null);
            $datenblattIds = array_unique(Yii::$app->request->post('datenblatts', []));

            switch ($submit) {
                case 'selection':
                    foreach ($datenblattIds as $datenblattId) {
                        /** @var $model Datenblatt */
                        if (($model = Datenblatt::findOne($datenblattId)) !== null) {
                            if (is_null($maxCountAbschlags)) {
                                $maxCountAbschlags = count($model->abschlags);
                            } else {
                                $maxCountAbschlags = max($maxCountAbschlags, count($model->abschlags));
                            }
                        }
                    }
                    break;
                default:
                    break;
            }
        }

        $abschlagOptions = [];
        for($i=0; $i < $maxCountAbschlags; $i++) {
            $abschlagOptions[$i] = 'Abschlag ' . ($i+1);
        }

        return $this->render('serienbrief', [
            'abschlagOptions' => $abschlagOptions,
            'datenblattIds' => $datenblattIds,
            'abschlagModel' => $abschlagModel,
        ]);
    }

    public function actionUpdateAbschlagDatum()
    {
        $abschlagNr     = Yii::$app->request->getQueryParam('abschlag', null);
        $vorlageId      = Yii::$app->request->queryParams['Abschlag']['vorlage_id'];
        $datenblattIds  = Yii::$app->request->getQueryParam('datenblatt', []);
        $datenblatts    = Datenblatt::find()->where(['id' => $datenblattIds])->all();

        if (is_null($abschlagNr)) {
            echo "Bitte wählen Sie einen Abschlag";
            return;
        }

        if (($vorlage = Vorlage::findOne($vorlageId)) == null) {

            echo "Bitte wählen Sie eine Vorlage";
            return;
        }

        $data = [];
        /** @var Datenblatt $datenblatt */
        foreach ($datenblatts as $datenblatt) {

            /** @var Abschlag $abschlag */
            if (isset($datenblatt->abschlags[$abschlagNr])) {
                $abschlag = $datenblatt->abschlags[$abschlagNr];

                if (is_null($abschlag->mail_gesendet)) {

                    $abschlag->load(Yii::$app->request->get());
                    $abschlag->kaufvertrag_angefordert = $abschlag->erstell_datum;

                    if ($abschlag->save()) {
                        $data['success'][] = $datenblatt->id;
                    } else {
                        $data['error'][] = $datenblatt->id;
                    }

                } else {

                    $data['mail_gesendet'][] = $datenblatt->id;
                }

            } else {
                $data['missing'][] = $datenblatt->id;
            }
        }

        return $this->renderPartial('updateAbschlagDatum', [
            'data' => $data,
        ]);
    }

    public function actionUpdateErstelldatumVorlageForm($id)
    {
        $model = $this->findModel($id);

        $datenblatt = $model->datenblatt;

        $abschlagNr = 0;
        foreach ($datenblatt->abschlags as $abschlag) {
            if ($abschlag->id == $model->id) {
                break;
            }
            $abschlagNr++;
        }

        return $this->renderPartial('updateErstelldatumVorlageForm', [
            'model' => $model,
            'abschlagNr' => $abschlagNr,
        ]);
    }

    public function actionSendAbschlagMails()
    {
        $abschlagNr = Yii::$app->request->getQueryParam('abschlag', null);
        $vorlageId = Yii::$app->request->getQueryParam('vorlage', null);
        $datenblattIds = Yii::$app->request->getQueryParam('datenblatt', []);
        $datenblatts = Datenblatt::find()->where(['id' => $datenblattIds])->all();

        if (is_null($abschlagNr)) {
            echo "Bitte wählen Sie einen Abschlag";
            return;
        }
        if (($vorlage = Vorlage::findOne($vorlageId)) == null) {
            echo "Bitte wählen Sie eine Vorlage";
            return;
        }

        $data = [];
        /** @var Datenblatt $datenblatt */
        foreach ($datenblatts as $datenblatt) {

            /** @var Abschlag $abschlag */
            if (isset($datenblatt->abschlags[$abschlagNr])) {
                $abschlag = $datenblatt->abschlags[$abschlagNr];

                if (is_null($abschlag->mail_gesendet)) {

                    $abschlag->vorlage_id = $vorlageId;
                    $abschlag->mail_gesendet = date('Y-m-d H:i:s');
                    if (is_null($abschlag->erstell_datum)) {
                        $abschlag->erstell_datum = date('Y-m-d');
                        $abschlag->kaufvertrag_angefordert = $abschlag->erstell_datum;
                    }

                    if ($abschlag->save()) {
                        $data['success'][] = $datenblatt->id;
                    } else {
                        $data['error'][] = $datenblatt->id;
                    }

                    //send mail
                    $pdfFileContent = $this->_createPdf($abschlag->getPdfContent(), Pdf::DEST_STRING);

                    Yii::$app->mailer->compose('abschlag')
                        //->setFrom('from@domain.com')
                        //->setTo('email@gmail.com')
                        ->setTo($datenblatt->kaeufer->email)
                        ->setSubject($vorlage->betreff)
                        ->attachContent($pdfFileContent, ['fileName' => "Abschlag-$abschlagNr.pdf", 'contentType' => 'application/pdf'])
                        ->send();

                } else {
                    $data['already_sent'][] = $datenblatt->id;
                }

            } else {
                $data['missing'][] = $datenblatt->id;
            }
        }

        return $this->renderPartial('sendAbschlagMails', [
            'data' => $data,
        ]);
    }

    public function actionDownloadAlsPdf()
    {
        $abschlagNr = Yii::$app->request->getQueryParam('abschlag', null);
//        $vorlageId = Yii::$app->request->getQueryParam('vorlage', null);
        $datenblattIds = Yii::$app->request->getQueryParam('datenblatt', []);
        $datenblatts = Datenblatt::find()->where(['id' => $datenblattIds])->all();

        if ($abschlagNr == '') {
            echo "Bitte wählen Sie einen Abschlag";
            return;
        }

//        if (!$vorlageId) {
//            echo "Bitte wählen Sie eine Vorlage";
//            return;
//        }

        $pdfContents = [];
        /** @var Datenblatt $datenblatt */
        foreach($datenblatts as $datenblatt) {

            if (isset($datenblatt->abschlags[$abschlagNr])) {

                $abschlag = $datenblatt->abschlags[$abschlagNr];

                if (is_null($abschlag->kaufvertrag_angefordert)) {
                    $abschlag->kaufvertrag_angefordert = date('Y-m-d');
                    $abschlag->save();
                }

                $pdfContents[] = $abschlag->getPdfContent();
            }
        }

        $html = implode(
            '<div class="wrapper" style="page-break-before:always;"></div>',
            $pdfContents
        );

        return $this->_createPdf($html);
    }

    public function actionDownloadSonderwunschAlsPdf()
    {
        $sonderwunschVorlageId = Yii::$app->request->getQueryParam('sonderwunschVorlageId', null);
        $vorlage = Vorlage::findOne($sonderwunschVorlageId);
        $datenblattIds = Yii::$app->request->getQueryParam('datenblatt', []);
        $datenblatts = Datenblatt::find()->where(['id' => $datenblattIds])->all();

        if (!$vorlage) {
            echo "Bitte wählen Sie eine Vorlage aus!";
            return;
        }

        $pdfContents = [];
        /** @var Datenblatt $datenblatt */
        foreach($datenblatts as $datenblatt) {
            if ($datenblatt->hasAngeforderteSonderwuensche()) {
                $pdfContents[] = $datenblatt->getSonderwunschPdfContent($vorlage);
            }
        }

        $html = implode(
            '<div class="wrapper" style="page-break-before:always;"></div>',
            $pdfContents
        );

        return $this->_createPdf($html, Pdf::DEST_BROWSER, false);
    }

    /**
     * @param $content
     *
     * @return Pdf
     */
    private function _createPdf($content, $destination = Pdf::DEST_BROWSER, $useInlineCss = true)
    {
        //$headerHtml = $this->renderPartial('_pdf_header', ['model' => $modelDatenblatt, 'pdfLogo' => $pdfLogo]);
        $inlineCss = '
            .bordertop td { 
                border-top: 2px solid #cecece;
            }
        ';
        if ($useInlineCss) {
            $inlineCss .= '
                    *, body, p {
                      font-family: \'calibri\',\'serif\',\'couriernew\' !important;
                    }
                    tr:nth-child(odd) {background: #fff;} tr:nth-child(even) {background: #eee;} table{width:100%}
                ';
        }

        //get your html raw content without layouts
        // $content = $this->renderPartial('view');
        //set up the kartik\mpdf\Pdf component
        $pdf = new Pdf([
            'content' => $content,

            //'mode'=> Pdf::MODE_CORE,
            'mode' => Pdf::MODE_BLANK,
            'format' => Pdf::FORMAT_A4,
            'defaultFontSize' => 10.0,
            'orientation' => Pdf::FORMAT_A4,
            'destination' => $destination,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => $inlineCss,
            //'options'=> ['title'=> 'Datenblatt'],
            'marginBottom' => '40',
            'methods' => [
                //'setHeader' => ['Erstellt am: ' . date("d.m.Y")],
                //'setHeader' => [$headerHtml],
                //'setFooter' => ['Erstellt am :' . date("d.m.Y") . '| |' . 'Seite {PAGENO} / {nb}'],
            ]
        ]);

        return $pdf->render();
    }

    public function actionAbschlagMailVorlageForm($id)
    {
        $model = $this->findModel($id);

        $datenblatt = $model->datenblatt;

        $abschlagNr = 0;
        foreach ($datenblatt->abschlags as $abschlag) {
            if ($abschlag->id == $model->id) {
                break;
            }
            $abschlagNr++;
        }

        return $this->renderPartial('abschlagMailVorlageForm', [
            'model' => $model,
            'abschlagNr' => $abschlagNr,
        ]);
    }

    /**
     * Lists all Abschlag models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AbschlagSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Abschlag model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Abschlag model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Abschlag();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Abschlag model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Abschlag model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Abschlag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Abschlag the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Abschlag::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
