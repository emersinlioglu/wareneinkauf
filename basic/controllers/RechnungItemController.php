<?php

namespace app\controllers;

use app\models\Hersteller;
use app\models\Lieferant;
use Yii;
use app\models\RechnungItem;
use app\models\RechnungItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RechnungItemController implements the CRUD actions for RechnungItem model.
 */
class RechnungItemController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all RechnungItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RechnungItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RechnungItem model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RechnungItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RechnungItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RechnungItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
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
     * Deletes an existing RechnungItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
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
        $teileigentumseinheitenZumSpeichern = [];

        if (Yii::$app->request->isPost) {

            // import card numbers file
            if (isset($_FILES['file']) && !empty($_FILES['file']['tmp_name'])) {
                $tmpName = $_FILES['file']['tmp_name'];

                try {
                    $inputFileType = \PHPExcel_IOFactory::identify($tmpName);
                    $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($tmpName);
                } catch (Exception $e) {
                    die('Error loading file "' . pathinfo($tmpName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
                }
                $sheet = $objPHPExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow();

//                echo "<pre>";
//                print_r($sheet->toArray());

                for ($row = 1; $row <= $highestRow; $row++) {

                    $lieferantName = strval($sheet->getCellByColumnAndRow(0, $row)->getValue());
                    $rechnungsDatum = strval($sheet->getCellByColumnAndRow(1, $row)->getValue());
                    $lieferantRechnungsnr = strval($sheet->getCellByColumnAndRow(2, $row)->getValue());
                    $artikelNr = strval($sheet->getCellByColumnAndRow(3, $row)->getValue());
                    $herstellerName = strval($sheet->getCellByColumnAndRow(4, $row)->getValue());
                    $herstellerArtikelNr = strval($sheet->getCellByColumnAndRow(5, $row)->getValue());
                    $anzahl = strval($sheet->getCellByColumnAndRow(6, $row)->getValue());
                    $artikelBezeichnung = strval($sheet->getCellByColumnAndRow(7, $row)->getValue());
                    $seriennummer = strval($sheet->getCellByColumnAndRow(8, $row)->getValue());
                    $warenartNr = strval($sheet->getCellByColumnAndRow(9, $row)->getValue());
                    $betrag = strval($sheet->getCellByColumnAndRow(10, $row)->getValue());
                    $kunde = strval($sheet->getCellByColumnAndRow(11, $row)->getValue());
                    $rechnungsNr = strval($sheet->getCellByColumnAndRow(12, $row)->getValue());
                    $bemerkung = strval($sheet->getCellByColumnAndRow(13, $row)->getValue());
                    $benutzerNr = strval($sheet->getCellByColumnAndRow(14, $row)->getValue());

                    // Lieferant
                    $lieferant = Lieferant::findOne(['name' => $lieferantName]);
                    if (!$lieferant) {
                        $lieferant = new Lieferant(['name' => $lieferantName]);
                        $lieferant->save();
                    }

                    // Hersteller
                    $hersteller = Hersteller::findOne(['name' => $lieferantName]);
                    if (!$hersteller) {
                        $hersteller = new Hersteller(['name' => $herstellerName]);
                        $hersteller->save();
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
            'fehlgeschlageneTeileigentumseinheiten' => $fehlgeschlageneTeileigentumseinheiten,
        ]);
    }

    /**
     * Finds the RechnungItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RechnungItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RechnungItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
