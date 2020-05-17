<?php

namespace app\controllers;

use app\models\Artikel;
use app\models\Hersteller;
use app\models\Kunde;
use app\models\Lieferant;
use app\models\Rechnung;
use app\models\Warenart;
use Yii;
use app\models\RechnungItem;
use app\models\RechnungItemSearch;
use yii\db\Exception;
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
        $rechnungItemsZuSpeichern = [];

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

                echo "<pre>";
//                echo "<pre>";
//                print_r($sheet->toArray());

                $cnt = 0;
                $itemCnt = 0;
                for ($row = 1; $row <= $highestRow; $row++) {

                    $lieferantName = strval($sheet->getCellByColumnAndRow(0, $row)->getValue());
                    $rechnungsDatum = \DateTime::createFromFormat('m-d-y', strval($sheet->getCellByColumnAndRow(1, $row)->getFormattedValue()));
                    $lieferantRechnungsnr = strval($sheet->getCellByColumnAndRow(2, $row)->getValue());
                    $artikelNr = strval($sheet->getCellByColumnAndRow(3, $row)->getValue());
                    $herstellerName = strval($sheet->getCellByColumnAndRow(4, $row)->getValue());
                    $herstellerArtikelNr = strval($sheet->getCellByColumnAndRow(5, $row)->getValue());
                    $anzahl = strval($sheet->getCellByColumnAndRow(6, $row)->getValue());
                    $artikelBezeichnung = strval($sheet->getCellByColumnAndRow(7, $row)->getValue());
                    $seriennummer = strval($sheet->getCellByColumnAndRow(8, $row)->getValue());
                    $warenartName = strval($sheet->getCellByColumnAndRow(9, $row)->getValue());
                    $betrag = strval($sheet->getCellByColumnAndRow(10, $row)->getValue());
                    $kundenname = strval($sheet->getCellByColumnAndRow(11, $row)->getValue());
                    $kundenRechnungsNr = strval($sheet->getCellByColumnAndRow(12, $row)->getValue());
                    $bemerkung = strval($sheet->getCellByColumnAndRow(13, $row)->getValue());
                    $benutzerNr = strval($sheet->getCellByColumnAndRow(14, $row)->getValue());

//                    print_r([
//                        '$lieferantName' => $lieferantName,
//                        '$rechnungsDatum' => $rechnungsDatum,
//                        '$lieferantRechnungsnr' => $lieferantRechnungsnr,
//                        '$artikelNr' => $artikelNr,
//                        '$herstellerName' => $herstellerName,
//                        '$herstellerArtikelNr' => $herstellerArtikelNr,
//                        '$anzahl' => $anzahl,
//                        '$artikelBezeichnung' => $artikelBezeichnung,
//                        '$seriennummer' => $seriennummer,
//                        '$warenartName' => $warenartName,
//                        '$betrag' => $betrag,
//                        '$kundenname' => $kundenname,
//                        '$kundenRechnungsNr' => $kundenRechnungsNr,
//                        '$bemerkung' => $bemerkung,
//                        '$benutzerNr' => $benutzerNr,
//                    ]);

                    if (!$rechnungsDatum || !$artikelNr || !$lieferantRechnungsnr) {
                        continue;
                    }

                    $cnt++;

                    $rechnungsDatum->setTime(0, 0 ,0);


                    // Lieferant
                    $lieferant = Lieferant::findOne(['name' => $lieferantName]);
                    if (!$lieferant) {
                        $lieferant = new Lieferant(['name' => $lieferantName]);
                        if (!$lieferant->save()) {
                            throw new Exception('Lieferant ist nicht valid');
                        }
                    }

                    // Hersteller
                    $hersteller = Hersteller::findOne(['name' => $herstellerName]);
                    if (!$hersteller) {
                        $hersteller = new Hersteller(['name' => $herstellerName]);
                        if (!$hersteller->save()) {
                            throw new Exception('Hersteller ist nicht valid');
                        }
                    }

                    // Warenart
                    $warenart = Warenart::findOne(['name' => $warenartName]);
                    if (!$warenart) {
                        $warenart = new Warenart(['name' => $warenartName]);
                        if (!$warenart->save()) {
                            throw new Exception('Warenart ist nicht valid');
                        }
                    }

                    // Kunde
                    $kunde = Kunde::findOne(['name' => $kundenname]);
                    if (!$kunde) {
                        $kunde = new Kunde(['name' => $kundenname]);
                        if (!$kunde->save()) {
                            throw new Exception('Kunde ist nicht valid');
                        }
                    }

                    // Artikel
                    $artikel = Artikel::findOne(['nummer' => $artikelNr]);
                    if (!$artikel) {
                        $artikel = new Artikel([
                            'nummer' => $artikelNr,
                            'bezeichnung' => $artikelBezeichnung,
                            'seriennummer' => $seriennummer,
                            'hersteller_artikelnr' => $herstellerArtikelNr,
                            'hersteller_id' => $hersteller->id,
                            'warenart_id' => $warenart->id,
                        ]);
                        if (!$artikel->save()) {
                            throw new Exception('Artikel ist nicht valid');
                        }
                    }

                    // Rechnung
                    $rechnung = Rechnung::findOne([
                        'nummer' => $lieferantRechnungsnr,
                        'datum' => $rechnungsDatum->format('Y-m-d H:i:s'),
                        'lieferant_id' => $lieferant->id
                    ]);
                    if (!$rechnung) {
                        $rechnung = new Rechnung([
                            'nummer' => $lieferantRechnungsnr,
                            'datum' => $rechnungsDatum->format('Y-m-d H:i:s'),
                            'lieferant_id' => $lieferant->id
                        ]);
                        if (!$rechnung->save()) {
                            throw new Exception('Rechnung ist nicht valid', print_r($rechnung->errors, 1));
                        }
                    }

                    // Rechnung.Item
                    $rechnungItem = RechnungItem::findOne([
                        'rechnung_id' => $rechnung->id,
                        'anzahl' => $anzahl,
                        'netto_einzel_betrag' => $betrag,
                        'kunde_rechnungsnr' => $kundenRechnungsNr,
                        'bemerkung' => $bemerkung,
                        'benutzernummer' => $benutzerNr,
                        'kunde_id' => $kunde->id,
                        'artikel_id' => $artikel->id,
                    ]);
                    if (!$rechnungItem) {
                        $rechnungItem = new RechnungItem([
                            'rechnung_id' => $rechnung->id,
                            'anzahl' => $anzahl,
                            'netto_einzel_betrag' => $betrag,
                            'kunde_rechnungsnr' => $kundenRechnungsNr,
                            'bemerkung' => $bemerkung,
                            'benutzernummer' => $benutzerNr,
                            'kunde_id' => $kunde->id,
                            'artikel_id' => $artikel->id,
                        ]);
                        if (!$rechnungItem->save()) {
                            throw new Exception('RechnungItem ist nicht valid');
                        }
                    } else {
                        $itemCnt++;

                    print_r([
                        '$lieferantName' => $lieferantName,
                        '$rechnungsDatum' => $rechnungsDatum,
                        '$lieferantRechnungsnr' => $lieferantRechnungsnr,
                        '$artikelNr' => $artikelNr,
                        '$herstellerName' => $herstellerName,
                        '$herstellerArtikelNr' => $herstellerArtikelNr,
                        '$anzahl' => $anzahl,
                        '$artikelBezeichnung' => $artikelBezeichnung,
                        '$seriennummer' => $seriennummer,
                        '$warenartName' => $warenartName,
                        '$betrag' => $betrag,
                        '$kundenname' => $kundenname,
                        '$kundenRechnungsNr' => $kundenRechnungsNr,
                        '$bemerkung' => $bemerkung,
                        '$benutzerNr' => $benutzerNr,
                    ]);
                    }
                }

            }

//            if (count($errors) + count($fehlgeschlageneTeileigentumseinheiten) == 0) {
//                foreach ($rechnungItemsZuSpeichern as $te) {
//                    $te->save();
//                }

            echo "cnt: " . $cnt;
            echo "itemCnt: " . $itemCnt;
            die;
                return $this->redirect(['rechnung-item/index', []]);
//            }
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
