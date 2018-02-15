<?php

namespace app\controllers;

use app\models\Datenblatt;
use app\models\Einheitstyp;
use app\models\Projekt;
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
        ]);
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

        if (Yii::$app->request->isPost) {

            $einheitstyp = Einheitstyp::findOne($einheitstyp_id);
            $projekt = Projekt::findOne($projekt_id);

//            if (!$einheitstyp) {
//                $errors[] = 'Bitte einen Einheitstyp auswählen';
//            }
            if (!$projekt) {
                $errors[] = 'Bitte ein Projekt auswählen';
            }

//            if ($einheitstyp && $projekt) {
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

                    $teileigentumseinheitenZumSpeichern = [];

                    for ($row = 2; $row <= $highestRow; $row++){

                        //* @property integer $haus_id
                        //* @property integer $einheitstyp_id
                        //* @property string $te_nummer
                        //* @property integer $gefoerdert
                        //* @property string $geschoss
                        //* @property string $zimmer
                        //* @property string $me_anteil
                        //* @property double $wohnflaeche
                        //* @property double $kaufpreis
                        //* @property double $kp_einheit
                        //* @property double $forecast_preis
                        //* @property double $verkaufspreis
                        //* @property string $verkaufspreis_begruendung

                        $teNummer = trim(strval($sheet->getCellByColumnAndRow(1, $row)->getValue()));
                        $teileigentumseinheit = Teileigentumseinheit::findOne([
                            'te_nummer' => $teNummer
                        ]);

                        if (!$teileigentumseinheit) {
                            $teileigentumseinheit = new Teileigentumseinheit();
                        }

                        if ($teileigentumseinheit->haus && $teileigentumseinheit->haus->hatDatenblattMitAngefodertemAbschlag()) {
                            //$fehlgeschlageneTeileigentumseinheiten[] = $teileigentumseinheit;
                            continue;
                        }

                        $einheitstyp = Einheitstyp::findOne([
                            'name' => strval($sheet->getCellByColumnAndRow(2, $row)->getValue())
                        ]);

                        switch($sheet->getCellByColumnAndRow($row, 3)->getValue()) {
                            case 'JA':
                                $teileigentumseinheit->gefoerdert = 1;
                                break;
                            case 'NEIN':
                                $teileigentumseinheit->gefoerdert = 0;
                                break;
                        }

                        $teileigentumseinheit->einheitstyp_id = $einheitstyp ? $einheitstyp->id : null;

                        $newHausnr = trim(strval($sheet->getCellByColumnAndRow(0, $row)->getValue()));
                        if (strlen($newHausnr) > 0) {
                            $hausnr = $newHausnr;
                        }
                        $teileigentumseinheit->hausnr = (string) $hausnr;

                        $teileigentumseinheit->projekt_id = $projekt->id;
                        $teileigentumseinheit->te_nummer = $teNummer;
                        $teileigentumseinheit->geschoss = strval($sheet->getCellByColumnAndRow(4, $row)->getValue());
                        $teileigentumseinheit->zimmer = strval($sheet->getCellByColumnAndRow(5, $row)->getValue());
                        $wohflaeche = $sheet->getCellByColumnAndRow(6, $row)->getValue();
                        $teileigentumseinheit->wohnflaeche = floatval($wohflaeche);

                        $kpEinheit = floatval(str_replace(',', '.', strval($sheet->getCellByColumnAndRow(7, $row)->getValue())));
                        $teileigentumseinheit->kp_einheit = round($kpEinheit, 2);

                        $teileigentumseinheit->kaufpreis =
                            $teileigentumseinheit->verkaufspreis =
                            $teileigentumseinheit->forecast_preis = round(floatval($sheet->getCellByColumnAndRow(8, $row)->getCalculatedValue()), 2);

                        $meAnteil = floatval(str_replace(',', '.', strval($sheet->getCellByColumnAndRow(9, $row)->getValue())));
                        $teileigentumseinheit->me_anteil = round($meAnteil, 2);

                        $teileigentumseinheitenZumSpeichern[] = $teileigentumseinheit;

                        if (!$teileigentumseinheit->validate()) {
                            $fehlgeschlageneTeileigentumseinheiten[] = $teileigentumseinheit;
                        }
                    }
                }

            }

            if (count($errors) + count($fehlgeschlageneTeileigentumseinheiten) == 0) {
                foreach ($teileigentumseinheitenZumSpeichern as $te) {
                    $te->save();
                }
                return $this->redirect(['haus/index']);
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

//            var_dump($datenblattId);

            $datenblatt = Datenblatt::findOne($datenblattId);

            if ($datenblatt && $datenblatt->projekt) {

                $kaeufers = Teileigentumseinheit::find()
                    ->where(['like', 'te_nummer', $_GET['term']])
                    ->andWhere("(haus_id IS NULL OR haus_id = '')")
                    ->andWhere("projekt_id = " . $datenblatt->projekt->id)
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

                foreach ($kaeufers as $kaeufer) {
                    $data = $kaeufer->attributes;
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
