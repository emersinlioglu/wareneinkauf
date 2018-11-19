<?php

namespace app\controllers;

use app\models\Datenblatt;
use app\models\Einheitstyp;
use app\models\Kaeufer;
use app\models\Projekt;
use app\models\Zaehlerstand;
use Yii;
use app\models\Teileigentumseinheit;
use app\models\TeileigentumseinheitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Haus;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;

/**
 * TeileigentumseinheitController implements the CRUD actions for Teileigentumseinheit model.
 */
class TeileigentumseinheitController extends Controller
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

    /**
     * Lists all Teileigentumseinheit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeileigentumseinheitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dynagridProfileId' => \app\models\User::getCurrentUser()->getAktiveDynagridProfileId(),
        ]);
    }


    public function actionExportZaehler($datenblattIds) {
        $datenblattIds = explode(',', $datenblattIds);
        $datenblatts = Datenblatt::find()->where(['id' => $datenblattIds])->all();

        $dataArray = [];
        $dataArray[] = [
            'Datenblatt-ID',
            'TE-Nummer',
            'Anrede 1',
            'Vorname 1',
            'Nachname 1',
            'Anrede 2',
            'Vorname 2',
            'Nachname 2',
            'Strasse',
            'Haus-Nr.',
            'PLZ',
            'Ort',
            'Medium-Name',
            'Medium-Nr.',
            'Zählerstand',
            'Datum',
        ];

        /** @var Datenblatt $datenblatt */
        foreach ($datenblatts as $datenblatt) {

            foreach ($datenblatt->haus->zaehlerstands as $zaehlerstand) {
                $kaeufer = $datenblatt->kaeufer ? $datenblatt->kaeufer : new Kaeufer();
                $dataArray[] = [
                    $datenblatt->id,
                    implode('/ ', $datenblatt->getTenummerList()),
                    $kaeufer->getAnredeLabel(),
                    $kaeufer->vorname,
                    $kaeufer->nachname,
                    $kaeufer->getAnrede2Label(),
                    $kaeufer->vorname2,
                    $kaeufer->nachname2,
                    $kaeufer->strasse,
                    $kaeufer->hausnr,
                    $kaeufer->plz,
                    $kaeufer->ort,
                    $zaehlerstand->name,
                    $zaehlerstand->nummer,
                    $zaehlerstand->stand,
                    $zaehlerstand->datum ? Yii::$app->formatter->asDate($zaehlerstand->datum) : '',
                ];
            }
        }

        $doc = new \PHPExcel();
        $doc->setActiveSheetIndex(0);
        $doc->getActiveSheet()->fromArray($dataArray);
        $filename = 'Zaehlerangaben_'.date('d.m.Y').'.xls';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0'); //no cache

        $objWriter = \PHPExcel_IOFactory::createWriter($doc, 'Excel5');
        $objWriter->save('php://output');

        return '';
    }

    /**
     * Lists all Teileigentumseinheit models.
     * @return mixed
     */
    public function actionForecast()
    {
        $searchModel = new TeileigentumseinheitSearch();
        $dataProvider = $searchModel->searchForecast(Yii::$app->request->queryParams);

        return $this->render('forecast', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Teileigentumseinheit model.
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
     * Creates a new Teileigentumseinheit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Teileigentumseinheit();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Teileigentumseinheit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id, $preventPost = false)
    {
        $model = $this->findModel($id);
        $data = Yii::$app->request->post();

        if (!$preventPost && $model->load($data)) {

            $model->kaufpreis = $model->verkaufspreis;
            if ($model->save()) {

                if (Zaehlerstand::loadMultiple($model->zaehlerstands, $data)) {
                    foreach ($model->zaehlerstands as $item) {
                        $item->save();
                    }
                }

//                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionAddzaehlerstand($teileigentumseinheitId) {

        $new = new Zaehlerstand();
        $new->teileigentumseinheit_id = $teileigentumseinheitId;
        $new->save();

        return $this->actionUpdate($teileigentumseinheitId);
//        $this->redirect(['update', 'id' => $datenblattId]);
    }

    public function actionDeletezaehlerstand($teileigentumseinheitId, $zaehlerstandId)
    {
        $this->actionUpdate($teileigentumseinheitId);

        if ($zaehlerstand = Zaehlerstand::findOne($zaehlerstandId)) {
            $zaehlerstand->delete();
        }

        return $this->actionUpdate($teileigentumseinheitId, true);
        //return $this->redirect(['update', 'id' => $hausId]);
    }

    /**
     * Deletes an existing Teileigentumseinheit model.
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
     * Imports teileigentumseinheiten
     * @return mixed
     */
    public function actionImport()
    {
        $errors = [];
        $fehlgeschlageneTeileigentumseinheiten = [];
        $projekt_id = Yii::$app->request->post('projekt_id');
        $einheitstyp_id = Yii::$app->request->post('einheitstyp_id');
        $teileigentumseinheitenZumSpeichern = [];

        if (Yii::$app->request->isPost) {

            $projekt = Projekt::findOne($projekt_id);
            if (!$projekt) {
                $errors[] = 'Bitte ein Projekt auswählen';
            }

            if ($projekt) {

                // import card numbers file
                if (isset($_FILES['file']) && !empty($_FILES['file']['tmp_name'])) {
                    $tmpName = $_FILES['file']['tmp_name'];

                    try {
                        $inputFileType = \PHPExcel_IOFactory::identify($tmpName);
                        $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                        $objPHPExcel = $objReader->load($tmpName);
                    } catch(Exception $e) {
                        die('Error loading file "'.pathinfo($tmpName,PATHINFO_BASENAME).'": '.$e->getMessage());
                    }

                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();
                    $hausnr = null;

                    for ($row = 2; $row <= $highestRow; $row++){

                        $teNummer = trim(strval($sheet->getCellByColumnAndRow(1, $row)->getValue()));

                        if ($teNummer == '') {
                            continue;
                        }

                        $teileigentumseinheit = Teileigentumseinheit::findOne([
                            'te_nummer' => $teNummer,
                            'projekt_id' => $projekt->id,
                        ]);

                        if (!$teileigentumseinheit) {
                            $teileigentumseinheit = new Teileigentumseinheit();
                            $teileigentumseinheit->status = Teileigentumseinheit::STATUS_FREI;
                        } else if ($teileigentumseinheit->haus_id > 0) {
                            continue;
                        }

                        if ($teileigentumseinheit->haus && $teileigentumseinheit->haus->hatDatenblattMitAngefodertemAbschlag()) {
                            //$fehlgeschlageneTeileigentumseinheiten[] = $teileigentumseinheit;
                            continue;
                        }

                        $einheitstyp = Einheitstyp::findOne([
                            'name' => strval($sheet->getCellByColumnAndRow(2, $row)->getValue())
                        ]);

                        switch($sheet->getCellByColumnAndRow(3, $row)->getValue()) {
                            case 'JA':
                                $teileigentumseinheit->gefoerdert = 1;
                                break;
                            case 'NEIN':
                                $teileigentumseinheit->gefoerdert = 0;
                                break;
                        }

                        $teileigentumseinheit->einheitstyp_id = $einheitstyp ? $einheitstyp->id : null;
                        $teileigentumseinheit->hausnr = trim(strval($sheet->getCellByColumnAndRow(0, $row)->getValue()));

                        $teileigentumseinheit->projekt_id = $projekt->id;
                        $teileigentumseinheit->te_nummer = $teNummer;

                        $teileigentumseinheit->geschoss = strval($sheet->getCellByColumnAndRow(4, $row)->getValue());
                        $teileigentumseinheit->zimmer = strval($sheet->getCellByColumnAndRow(5, $row)->getValue());
                        $wohnflaeche = (float) $sheet->getCellByColumnAndRow(6, $row)->getValue();
                        $teileigentumseinheit->wohnflaeche =  $wohnflaeche == 0 ? null : $wohnflaeche;

//                        $kpEinheit = floatval(str_replace(',', '.', strval($sheet->getCellByColumnAndRow(7, $row)->getValue())));
//                        $kpEinheit = round($kpEinheit, 2);
                        $kpEinheit = (float) strval($sheet->getCellByColumnAndRow(7, $row)->getCalculatedValue());
                        $teileigentumseinheit->kp_einheit = $kpEinheit;

//                        $teileigentumseinheit->kaufpreis =
//                            $teileigentumseinheit->verkaufspreis =
//                            $teileigentumseinheit->forecast_preis = round(floatval($sheet->getCellByColumnAndRow(8, $row)->getCalculatedValue()), 2);
                        $teileigentumseinheit->kaufpreis =
                            $teileigentumseinheit->verkaufspreis =
                            $teileigentumseinheit->forecast_preis = strval($sheet->getCellByColumnAndRow(8, $row)->getCalculatedValue());

//                        $meAnteil = floatval(str_replace(',', '.', strval($sheet->getCellByColumnAndRow(9, $row)->getValue())));
//                        $meAnteil = round($meAnteil, 2);
                        $meAnteil = strval($sheet->getCellByColumnAndRow(9, $row)->getValue());
                        $teileigentumseinheit->me_anteil = $meAnteil;


                        if (!$teileigentumseinheit->validate()) {
                            $fehlgeschlageneTeileigentumseinheiten[$row] = $teileigentumseinheit;
                        } else {
                            $teileigentumseinheitenZumSpeichern[] = $teileigentumseinheit;
                        }
                    }
                }

            }

            if (count($errors) + count($fehlgeschlageneTeileigentumseinheiten) == 0) {
                foreach ($teileigentumseinheitenZumSpeichern as $te) {
                    $te->save();
                }
                return $this->redirect(['teileigentumseinheit/index', ['TeileigentumseinheitSearch[projekt_id]' => $projekt->id]]);
            }
        }

        return $this->render('import', [
            'errors' => $errors,
            'projekt_id' => $projekt_id,
            'einheitstyp_id' => $einheitstyp_id,
            'fehlgeschlageneTeileigentumseinheiten' => $fehlgeschlageneTeileigentumseinheiten,
        ]);
    }

    /**
     * Search for autocomplete
     */
    public function actionAutocomplete($datenblattId = '', $term = '')
    {
        $results = [];

        if (isset($_GET['term'])) {

            $datenblatt = Datenblatt::findOne($datenblattId);

            if ($datenblatt && $datenblatt->projekt) {

                $teileigentumseinheiten = Teileigentumseinheit::find()
                    ->where(['like', 'te_nummer', $_GET['term']])
                    ->andWhere("(haus_id IS NULL OR haus_id = '')")
                    ->andWhere("teileigentumseinheit.projekt_id = " . $datenblatt->projekt_id)
                    ->orderBy('CAST(te_nummer AS DECIMAL)')
                    ->all();

                $results[] = array(
                    'id' => 0,
                    'value' => '',
                    'label' => '',
                    'debitor_nr' => 'Debitor-Nr.',
                    'vorname' => 'Vorname',
                    'nachname' => 'Nachname'
                );

                foreach ($teileigentumseinheiten as $teileigentumseinheit) {
                    $data = $teileigentumseinheit->attributes;
                    $results[] = $data;
                }
            }

            echo Json::encode($results);
            return;
        }

        echo Json::encode($results);
    }


    /**
     * Finds the Teileigentumseinheit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Teileigentumseinheit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Teileigentumseinheit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
