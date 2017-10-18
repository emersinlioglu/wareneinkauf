<?php

namespace app\controllers;

use app\models\Einheitstyp;
use Yii;
use app\models\Teileigentumseinheit;
use app\models\TeileigentumseinheitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Haus;
use yii\data\ActiveDataProvider;

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
        $einheitstyp_id = Yii::$app->request->post('einheitstyp_id');

        if (Yii::$app->request->isPost) {

            $einheitstyp = Einheitstyp::findOne($einheitstyp_id);

            if (!$einheitstyp) {
                $errors[] = 'Bitte einen Einheitstyp auswählen';
            }

            if ($einheitstyp) {

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

                        $teNummer = strval($sheet->getCellByColumnAndRow(0, $row)->getValue());
                        $teileigentumseinheit = Teileigentumseinheit::findOne([
                            'te_nummer' => $teNummer
                        ]);

                        if (!$teileigentumseinheit) {
                            $teileigentumseinheit = new Teileigentumseinheit();
                        }

                        //gefoerdert //$teileigentumseinheit->gefoerdert = $sheet->getCellByColumnAndRow($row, ???)->getValue();
                        //$teileigentumseinheit->verkuafpreis = $sheet->getCellByColumnAndRow($row, ????)->getValue();
                        //haus //$teileigentumseinheit->???? = $sheet->getCellByColumnAndRow($row, ????)->getValue();
                        $teileigentumseinheit->einheitstyp_id = $einheitstyp->id;
                        $teileigentumseinheit->te_nummer = $teNummer;
                        $teileigentumseinheit->geschoss = strval($sheet->getCellByColumnAndRow(2, $row)->getValue());
                        $teileigentumseinheit->zimmer = strval($sheet->getCellByColumnAndRow(3, $row)->getValue());
                        $teileigentumseinheit->wohnflaeche = strval($sheet->getCellByColumnAndRow(4, $row)->getValue());
                        $teileigentumseinheit->kaufpreis = strval($sheet->getCellByColumnAndRow(5, $row)->getValue());
                        $teileigentumseinheit->me_anteil = strval($sheet->getCellByColumnAndRow(7, $row)->getValue());

                        if (!$teileigentumseinheit->validate() || !$teileigentumseinheit->save()) {
                            $fehlgeschlageneTeileigentumseinheiten[] = $teileigentumseinheit;
                        }
                    }
                }

            }

            if (count($fehlgeschlageneTeileigentumseinheiten) == 0) {
                return $this->redirect(['haus/index']);
            }
        }

        return $this->render('import', [
            'errors' => $errors,
            'einheitstyp_id' => $einheitstyp_id,
            'fehlgeschlageneTeileigentumseinheiten' => $fehlgeschlageneTeileigentumseinheiten,
        ]);
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
