<?php

namespace app\controllers;

use app\models\AbschlagMeilenstein;
use app\models\Haus;
use app\models\Kunde;
use app\models\Meilenstein;
use app\models\Teileigentumseinheit;
use app\models\Zinsverzug;
use Yii;
use yii\data\ActiveDataProvider;
use app\models\Datenblatt;
use app\models\DatenblattSearch;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

use app\models\DynamicForm;
use app\models\Nachlass;
use app\models\Zahlung;
use app\models\Kaeufer;
use app\models\Sonderwunsch;
use app\models\Abschlag;
use yii\widgets\ActiveForm;
use kartik\mpdf\Pdf;
use webvimark\modules\UserManagement\models\User;

use kartik\dynagrid\DynaGridStore;


/**
 * DatenblattController implements the CRUD actions for Datenblatt model.
 */
class DatenblattController extends Controller
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
     * Lists all Datenblatt models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DatenblattSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        $modelsToDelete = DatenblattSearch::findAll(['aktiv' => 0]);
        foreach ($modelsToDelete as $modelToDelete) {
            $modelToDelete->delete();
        }

        // max count of teileigentumseinheits of filtered datenblatts
        $models = $dataProvider->getModels();
        $maxCountTEEinheits = 0;
        foreach ($models as $datenblatt) {
            if ($datenblatt->haus) {
                $count = count($datenblatt->haus->teileigentumseinheits);
                $maxCountTEEinheits = max($maxCountTEEinheits, $count);
            }
        }

        // max count of sonderwuensche of filtered datenblatts
        $models = $dataProvider->getModels();    
        $maxCountSonderwunsches = 0;
        foreach ($models as $datenblatt) {
            $count = count($datenblatt->sonderwunsches);
            $maxCountSonderwunsches = max($maxCountSonderwunsches, $count);
        }

        // max count of abschlags of filtered datenblatts
        $models = $dataProvider->getModels();    
        $maxCountAbschlags = 0;
        foreach ($models as $datenblatt) {
            $count = count($datenblatt->abschlags);
            $maxCountAbschlags = max($maxCountAbschlags, $count);
        }

        // max count of nachlasses of filtered datenblatts
        $models = $dataProvider->getModels();    
        $maxCountNachlasses = 0;
        foreach ($models as $datenblatt) {
            $count = count($datenblatt->nachlasses);
            $maxCountNachlasses = max($maxCountNachlasses, $count);
        }

        $maxCountZinsverzugs = 0;
        foreach ($models as $datenblatt) {
            $count = count($datenblatt->zinsverzugs);
            $maxCountZinsverzugs = max($maxCountZinsverzugs, $count);
        }

        // max count of zahlungs of filtered datenblatts
        $models = $dataProvider->getModels();    
        $maxCountZahlungs = 0;
        foreach ($models as $datenblatt) {
            $count = count($datenblatt->zahlungs);
            $maxCountZahlungs = max($maxCountZahlungs, $count);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'maxCountTEEinheits' => $maxCountTEEinheits,
            'maxCountSonderwunsches' => $maxCountSonderwunsches,
            'maxCountAbschlags' => $maxCountAbschlags,
            'maxCountNachlasses' => $maxCountNachlasses,
            'maxCountZinsverzugs' => $maxCountZinsverzugs,
            'maxCountZahlungs' => $maxCountZahlungs,
        ]);
    }

    /**
     *
     */
    private function _calculatePreises(Datenblatt $modelDatenblatt)
    {
        // calculate kaufpreis
        $kaufpreisTotal = 0;
        /* @var $teileh app\models\Teileigentumseinheit */
        if ($modelDatenblatt->haus) {
            foreach ($modelDatenblatt->haus->teileigentumseinheits as $item) {
                $kaufpreisTotal += (float)$item->kaufpreis;
            }
        }

        // calculate sonderwünche
        $sonderwuenscheTotal = 0;
        /* @var $item app\models\Sonderwunsch */
        foreach ($modelDatenblatt->sonderwunsches as $item) {
            $sonderwuenscheTotal += (float)$item->rechnungsstellung_betrag;
        }

        // calculate abschlags
        /* @var $item \app\models\Abschlag */
        foreach ($modelDatenblatt->abschlags as $item) {

            $zeilenSumme = 0;
            if ($item->kaufvertrag_angefordert) {
                $zeilenSumme += ((float)$item->kaufvertrag_prozent * $kaufpreisTotal / 100);
            }
            if ($item->sonderwunsch_angefordert) {
                $zeilenSumme += ((float)$item->sonderwunsch_prozent * $sonderwuenscheTotal / 100);
            }
            $item->kaufvertrag_betrag = ((float)$item->kaufvertrag_prozent * $kaufpreisTotal / 100);
            $item->sonderwunsch_betrag = ((float)$item->sonderwunsch_prozent * $sonderwuenscheTotal / 100);

            $item->summe = $zeilenSumme;
        }
    }

    /**
     * Displays a single Datenblatt model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $modelDatenblatt = $this->findModel($id);

        $this->_calculatePreises($modelDatenblatt);

        return $this->render('view', [
            'model' => $modelDatenblatt,
        ]);
    }

    public function actionPdf($id)
    {
        $modelDatenblatt = $this->findModel($id);
        $this->_calculatePreises($modelDatenblatt);
		
        return $this->render('pdf', [
            'model' => $modelDatenblatt,
			
        ]);
    }

    /**
     * Creates a new Datenblatt model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Datenblatt;
        $model->creator_user_id = Yii::$app->user->getId();
        $model->save();

//        $abschlags = [
//            'Abschlag 1' => 25.0,
//            'Abschlag 2' => 28.0,
//            'Abschlag 3' => 16.8,
//            'Abschlag 4' => 8.4,
//            'Abschlag 5' => 18.3,
//            //  'Abschlag 6' => 0.0,
//            'Schlussrechnung' => 3.5
//        ];
//        foreach ($abschlags as $name => $percentage) {
//            $abschlag = new Abschlag();
//            $abschlag->datenblatt_id = $model->id;
//            $abschlag->name = $name;
//            $abschlag->kaufvertrag_prozent = $percentage;
//            $abschlag->save();
//        }

        $this->redirect(['datenblatt/update', 'id' => $model->id]);
    }

    /**
     * Updates an existing Datenblatt model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $preventPost = false)
    {
        $canEditBasicData = User::hasPermission('write_datasheets_basicdata');
        $modelDatenblatt = $this->findModel($id);
        $modelDatenblatt->aktiv = 1;

        $data = Yii::$app->request->post();

//        if ($preventPost && Yii::$app->request->isAjax) {
//            Yii::$app->response->format = 'json';
//            return ActiveForm::validateMultiple($modelDatenblatt->zahlungs);
//        }

//if (isset($data['Datenblatt']['kaeufer_id']) && (int)$data['Datenblatt']['kaeufer_id'] == 0) {
//    $data['Datenblatt']['kaeufer_id'] = 0;
//}

        $oldProjektId = $modelDatenblatt->projekt_id;

        if (!$preventPost && $modelDatenblatt->load($data) && $modelDatenblatt->save()) {

            $modelDatenblatt->updateInternDebitorNr();

            if (count($modelDatenblatt->abschlags) == 0 && !empty($modelDatenblatt->projekt_id)) {

                if ($modelDatenblatt->projekt && !$modelDatenblatt->istAngefordert()) {
                    foreach ($modelDatenblatt->projekt->projektAbschlags as $projektAbschlag) {
                        $abschlag = new Abschlag();
                        $abschlag->datenblatt_id = $modelDatenblatt->id;
                        $abschlag->name = $projektAbschlag->name;
                        $abschlag->kaufvertrag_prozent = $projektAbschlag->getKaufvertragProzentSumme();
                        $abschlag->save();

                        foreach ($projektAbschlag->meilensteins as $meilenstein) {
                            $abschlagMeilenstein = new AbschlagMeilenstein();
                            $abschlagMeilenstein->meilenstein_id = $meilenstein->id;
                            $abschlagMeilenstein->abschlag_id = $abschlag->id;
                            $abschlagMeilenstein->save();
                        }
                    }
                }
            }

            if ($modelDatenblatt->projekt_id && $oldProjektId != $modelDatenblatt->projekt_id) {
                $modelDatenblatt->updateAddresseVonProjekt();
            }

//            // Käufer
//            if ($modelKaeufer->load(Yii::$app->request->post())) {
//
//                $isEmpty = true;
//                foreach ($modelKaeufer->attributes as $attr => $value) {
//                    if (!empty($value)) {
//                        //error_log('not empty: ' . $attr . ' - ' . $value);
//                        $isEmpty = false;
//                        break;
//                    } else {
//                        //error_log('empty: ' . $attr . ' - ' . $value);
//                    }
//                }
//
//                // save
//                if (!$isEmpty) {
//                    $modelKaeufer->save();
//                }
//
//                // assign käufer
//                $modelDatenblatt->kaeufer_id = $modelKaeufer->id;
//                $modelDatenblatt->save();
//
//
//                // add new kunde
//                if (!Kunde::find()
//                    ->where( [ 'debitor_nr' => $modelKaeufer->debitor_nr] )
//                    ->exists()) {
//
//                    $modelKunde = new Kunde();
////                    * @property string $debitor_nr
////                    * @property integer $anrede
////                    * @property string $titel
////                    * @property string $vorname
////                    * @property string $nachname
////                    * @property string $email
////                    * @property string $strasse
////                    * @property string $hausnr
////                    * @property string $plz
////                    * @property string $ort
////                    * @property string $festnetz
////                    * @property string $handy
//
//                    $kundeData = [
//                        'debitor_nr' => $modelKaeufer->debitor_nr,
//                        'anrede' => $modelKaeufer->anrede,
//                        'titel' => $modelKaeufer->titel,
//                        'vorname' => $modelKaeufer->vorname,
//                        'nachname' => $modelKaeufer->nachname,
//                        'email' => $modelKaeufer->email,
//                        'strasse' => $modelKaeufer->strasse,
//                        'hausnr' => $modelKaeufer->hausnr,
//                        'plz' => $modelKaeufer->plz,
//                        'ort' => $modelKaeufer->ort,
//                        'festnetz' => $modelKaeufer->festnetz,
//                        'handy' => $modelKaeufer->handy,
//                    ];
//                    $modelKunde->load(['Kunde' => $kundeData]);
//                    $modelKunde->save();
//                }
//            }

            // Sonderwünsche
            if (Sonderwunsch::loadMultiple($modelDatenblatt->sonderwunsches, $data)) {
                foreach ($modelDatenblatt->sonderwunsches as $item) {
                    $item->save();
                }
            }

            // Abschläge
            if ($modelsAbschlag = Abschlag::loadMultiple($modelDatenblatt->abschlags, $data)) {
                foreach ($modelDatenblatt->abschlags as $item) {
                    $item->save();
                }
            }

            // Nachlass
            if (Nachlass::loadMultiple($modelDatenblatt->nachlasses, $data)) {
                foreach ($modelDatenblatt->nachlasses as $item) {
                    $item->save();
                }
            }

            // Zinsverzug
            if (Zinsverzug::loadMultiple($modelDatenblatt->zinsverzugs, $data)) {
                foreach ($modelDatenblatt->zinsverzugs as $item) {
                    $item->save();
                }
            }

            // Zahlung
            if (Zahlung::loadMultiple($modelDatenblatt->zahlungs, $data)) {
                foreach ($modelDatenblatt->zahlungs as $item) {
                    $item->validate();
                    $item->save();
                }

//                $isVal = Zahlung::validateMultiple($modelDatenblatt->zahlungs);
//                error_log('result: ' . ($isVal ? 'ja' : 'nein'));
            }

//            // reload models
//            $modelDatenblatt = $this->findModel($id);
//            $modelKaeufer = new Kaeufer();
//            if ($modelDatenblatt->kaeufer) {
//                $modelKaeufer = $modelDatenblatt->kaeufer;
//            }

//            $this->redirect(['update', 'id' => $id]);

//            $modelDatenblatt = $this->findModel($modelDatenblatt->id);
//            $modelKaeufer = $modelDatenblatt->kaeufer;

            $modelDatenblatt->refresh();
        }

        $modelKaeufer = new Kaeufer();
        if ($modelDatenblatt->kaeufer) {
            $modelKaeufer = $modelDatenblatt->kaeufer;
        }

        // calculate kaufpreis
        $kaufpreisTotal = 0;
        /* @var $teileh Teileigentumseinheit */
        if ($modelDatenblatt->haus) {
            foreach ($modelDatenblatt->haus->teileigentumseinheits as $item) {
                $kaufpreisTotal += (float)$item->kaufpreis;
            }
        }

        // calculate sonderwünche
        $sonderwuenscheTotal = 0;
        /* @var $item Sonderwunsch */
        foreach ($modelDatenblatt->sonderwunsches as $item) {
            $sonderwuenscheTotal += (float)$item->rechnungsstellung_betrag;
        }

        // calculate abschlags
        /* @var $item \app\models\Abschlag */
        foreach ($modelDatenblatt->abschlags as $item) {

            $zeilenSumme = 0;
            if ($item->kaufvertrag_angefordert) {
                $zeilenSumme += ((float)$item->kaufvertrag_prozent * $kaufpreisTotal / 100);
            }
            if ($item->sonderwunsch_angefordert) {
                $zeilenSumme += ((float)$item->sonderwunsch_prozent * $sonderwuenscheTotal / 100);
            }
            $item->kaufvertrag_betrag = ((float)$item->kaufvertrag_prozent * $kaufpreisTotal / 100);
            $item->sonderwunsch_betrag = ((float)$item->sonderwunsch_prozent * $sonderwuenscheTotal / 100);

            $item->summe = $zeilenSumme;
        }

        return $this->render('update', [
            'modelDatenblatt' => $modelDatenblatt,
            //'modelsZahlungs' => $modelDatenblatt->zahlungs,
            'modelKaeufer' => $modelKaeufer,

            'kaufpreisTotal' => $kaufpreisTotal,
            'sonderwuenscheTotal' => $sonderwuenscheTotal,
            'canEditBasicData' => $canEditBasicData,
        ]);
    }

    public function actionKonfiguration($id) {
        $datenblatt = $this->findModel($id);

        if (Yii::$app->request->isPost) {

            // ProjektAbschlag
            $projektAbschlagData = Yii::$app->request->post('Abschlag', []);
            foreach ($projektAbschlagData as $data) {
                $projektAbschlag = Abschlag::findOne($data['id']);
                $projektAbschlag->load($data, '');
                $projektAbschlag->save();
            }

            // Meilenstein Zuordnungen
            $abschlagMeilensteinZuordnungData = Yii::$app->request->post('AbschlagMeilensteinZuordnung', []);
            foreach ($abschlagMeilensteinZuordnungData as $abschlagId => $meilensteinIdsAsString) {

                /** @var Abschlag $abschlag */
                $abschlag = Abschlag::findOne($abschlagId);

                if ($abschlag->isDeletable()) {

                    foreach ($abschlag->abschlagMeilensteins as $abschlagMeilenstein) {
                        $abschlagMeilenstein->delete();
                    }

                    $meilensteinIds = explode(',', $meilensteinIdsAsString);
                    foreach ($meilensteinIds as $meilensteinId) {
                        if ($meilenstein = Meilenstein::findOne($meilensteinId)) {
                            $abschlagMeilenstein = new AbschlagMeilenstein();
                            $abschlagMeilenstein->abschlag_id = $abschlag->id;
                            $abschlagMeilenstein->meilenstein_id = $meilenstein->id;
                            $abschlagMeilenstein->save();
                        }
                    }

                    $abschlag->refresh();
                    $abschlag->updateKaufvertragProzent();
                }

            }

            $datenblatt->refresh();
        }

        return $this->render('konfiguration', [
            'datenblatt' => $datenblatt,
            'projekt' => $datenblatt->projekt,
            'angeforderteProzentSumme' => $datenblatt->getAngeforderteAbschlagProzentSumme(),
        ]);
    }

    public function actionAbschlagMassenbearbeitung($ids) {

        $selectedDatenblatts = Datenblatt::find()->where(['in', 'id', explode(',', $ids)])->all();
        $datenblatts = $this->_getDatenblattsZumBearbeiten($selectedDatenblatts);
        $valideDatenblattIds = [];
        foreach ($datenblatts as $key => $datenblatt) {
            $valideDatenblattIds[] = $datenblatt->id;
        }
        $ignorierteDatenblattIds = [];
        foreach ($selectedDatenblatts as $key => $datenblatt) {
            if (!in_array($datenblatt->id, $valideDatenblattIds)) {
                $ignorierteDatenblattIds[] = $datenblatt->id;
            }
        }

        /** @var Datenblatt $datenblatt */
        $angeforderteAbschlagNamen = $angeforderteMeilensteine = [];
        foreach ($datenblatts as $datenblatt) {
            $angeforderteMeilensteine += $datenblatt->getAngeforderteMeilensteine();
            $angeforderteAbschlagNamen += $datenblatt->getAngeforderteAbschlagNamen();
        }

        $existingAbschlagCount = count($angeforderteAbschlagNamen);
        $maxAbschlagCount = $this->_getMaxCountAbschlag($datenblatts);
        $abschlags = [];
        for ($i = $existingAbschlagCount + 1; $i <= $maxAbschlagCount; $i++) {
            $abschlag = new Abschlag();
            if ($i == $maxAbschlagCount) {
                $abschlag->name = "Schlussrechnung";
            } else {
                $abschlag->name = "Abschlag " . $i;
            }
            $abschlag->id = $i;

            $abschlags[] = $abschlag;
        }

        if (Yii::$app->request->isPost) {

            $datenblattUrls = [];

//            print_r(Yii::$app->request->post('Abschlag', []));
//            print_r(Yii::$app->request->post('AbschlagMeilensteinZuordnung', []));

            $abschlagsData = Yii::$app->request->post('Abschlag', []);
            $abschlagMeilensteinsData = Yii::$app->request->post('AbschlagMeilensteinZuordnung', []);

            /** @var Datenblatt $datenblatt */
            foreach ($datenblatts as $datenblatt) {

                // Alle Abschlags mit Zuordnungen löschen, die nicht angefordert sind
                foreach ($datenblatt->abschlags as $abschlag) {
                    if ($abschlag->isDeletable()) {
                        foreach ($abschlag->abschlagMeilensteins as $abschlagMeilenstein) {
                            $abschlagMeilenstein->delete();
                        }
                        $abschlag->delete();
                    }
                }

                foreach ($abschlagsData as $abschlagIndex => $abschlagData) {
                    $abschlagMeilensteinData = $abschlagMeilensteinsData[$abschlagIndex];

                    $abschlag = new Abschlag();
                    $abschlag->datenblatt_id = $datenblatt->id;
                    $abschlag->name = $abschlagData['name'];
                    $abschlag->save();

                    if ($abschlagMeilensteinData) {
                        foreach (explode(',', $abschlagMeilensteinData) as $meilensteinId) {
                            $abschlagMeilenstein = new AbschlagMeilenstein();
                            $abschlagMeilenstein->abschlag_id = $abschlag->id;
                            $abschlagMeilenstein->meilenstein_id = $meilensteinId;
                            $abschlagMeilenstein->save();
                        }
                        $abschlag->updateKaufvertragProzent();
                    }
                }

                $datenblattUrls[$datenblatt->id] = Yii::$app->urlManager->createUrl(["datenblatt/update", 'id' => $datenblatt->id]);
            }

            return Json::encode(['result' => 'ok', 'datenblattUrls' => $datenblattUrls]);
        }

        $angeforderteProzentSumme = Meilenstein::getProzentSumme(array_keys($angeforderteMeilensteine));

        return $this->render('abschlag-massenbearbeitung', [
            'datenblatts' => $datenblatts,
            'valideDatenblattIds' => $valideDatenblattIds,
            'ignorierteDatenblattIds' => $ignorierteDatenblattIds,
            'abschlags' => $abschlags,
            'projekt' => $datenblatts[0]->projekt,
            'angeforderteAbschlagNamen' => $angeforderteAbschlagNamen,
            'angeforderteMeilensteine' => $angeforderteMeilensteine,
            'existingAbschlagCount' => $existingAbschlagCount,
            'selectedDatenblatts' => $selectedDatenblatts,
            'angeforderteProzentSumme' => $angeforderteProzentSumme,
        ]);
    }

    /**
     * Returns Datenblätter, die zum gleichen Projekt gehören und gleiche Anzahl von angeforderten Meilensteine haben.
     * @param $datenblatts
     * @return mixed
     */
    private function _getDatenblattsZumBearbeiten($datenblatts) {
        $datenblattsZumBearbeiten = [];
        /** @var Datenblatt $datenblatt */
        foreach ($datenblatts as $datenblatt) {
            $datenblattsZumBearbeiten[$datenblatt->projekt_id][count($datenblatt->getAngeforderteAbschlagIds())][] = $datenblatt;
        }

//        foreach ($datenblatts as $datenblatt) {
//            $datenblattsZumBearbeiten[$datenblatt->projekt_id][count($datenblatt->getAngeforderteAbschlagIds())][] = $datenblatt->id;
//        }
//        echo "<pre>";
//        print_r($datenblattsZumBearbeiten);
//        exit();

        return array_shift(array_shift($datenblattsZumBearbeiten));
    }

    private function _getMaxCountAbschlag($datenblatts) {
        $cnt = 0;
        /** @var Datenblatt $datenblatt */
        foreach ($datenblatts as $datenblatt) {
            $cnt = max(count($datenblatt->abschlags), $cnt);
        }
        return $cnt;
    }

    /**
     * Add new datenblatt
     * @param int $datenblattId
     */
    public function actionAddsonderwunsch($datenblattId)
    {
        $new = new Sonderwunsch();
        $new->datenblatt_id = $datenblattId;
        $new->save();

        return $this->actionUpdate($datenblattId);
//        $this->redirect(['update', 'id' => $datenblattId]);
    }

    /**
     * Add new abschlag
     * @param int $datenblattId
     */
    public function actionAddabschlag($datenblattId)
    {
        $new = new Abschlag();
        $new->datenblatt_id = $datenblattId;
        $new->save();

        //return $this->actionUpdate($datenblattId);
        $this->redirect(['konfiguration', 'id' => $datenblattId]);
    }

    /**
     * Add new zahlung
     * @param int $datenblattId
     */
    public function actionAddzahlung($datenblattId)
    {
        $new = new Zahlung();
        $new->datenblatt_id = $datenblattId;
        $new->save();

//        // Zahlung
//        $modelDatenblatt = $this->findModel($datenblattId);
//        if (Zahlung::loadMultiple($modelDatenblatt->zahlungs, Yii::$app->request->post())) {
//            /* @var $item Zahlung */
//            foreach ($modelDatenblatt->zahlungs as $item) {
//                $item->validate();
//                $item->save();
//            }
//
//        }
//
//        return $this->renderPartial('_zahlung', [
//            'modelDatenblatt' => $modelDatenblatt
//        ]);

        return $this->actionUpdate($datenblattId);
//        $this->redirect(['update', 'id' => $datenblattId]);
    }

    /**
     * Add new nachlass
     * @param int $datenblattId
     */
    public function actionAddnachlass($datenblattId)
    {

        $new = new Nachlass();
        $new->datenblatt_id = $datenblattId;
        $new->save();

        return $this->actionUpdate($datenblattId);
//        $this->redirect(['update', 'id' => $datenblattId]);
    }

    /**
     * Add new zinsverzug
     * @param int $datenblattId
     */
    public function actionAddzinsverzug($datenblattId)
    {

        $new = new Zinsverzug();
        $new->datenblatt_id = $datenblattId;
        $new->save();

        return $this->actionUpdate($datenblattId);
//        $this->redirect(['update', 'id' => $datenblattId]);
    }


    /**
     * Deletes an existing Datenblatt model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $name = $model->id;

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Record  <strong>"' . $name . '"</strong> deleted successfully.');
        }

        return $this->redirect(['index']);
    }


    /**
     * Deletes sonderwunsch
     * @param integer $id
     * @return mixed
     */
    public function actionDeletesonderwunsch($datenblattId, $sonderwunschId)
    {
        $this->actionUpdate($datenblattId);

        $model = $this->findModel($datenblattId);
        if ($modelSonderwunsch = Sonderwunsch::findOne($sonderwunschId)) {
            $modelSonderwunsch->delete();
        }

        return $this->actionUpdate($datenblattId, true);
    }

    /**
     * Deletes abschlag
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteabschlag($datenblattId, $abschlagId)
    {
        //$this->actionUpdate($datenblattId);

        $model = $this->findModel($datenblattId);
        $modelAbschlag = Abschlag::findOne($abschlagId);
        if ($modelAbschlag && $modelAbschlag->isDeletable()) {
            $modelAbschlag->delete();
        }

        //return $this->actionUpdate($datenblattId, true);
        return $this->redirect(['konfiguration', 'id' => $model->id]);
    }

    /**
     * Deletes nachlass
     *
     * @param int $datenblattId
     * @param int $nachlassId
     * @return void
     */
    public function actionDeletenachlass($datenblattId, $nachlassId)
    {
        $this->actionUpdate($datenblattId);

        $model = $this->findModel($datenblattId);
        if ($modelNachlass = Nachlass::findOne($nachlassId)) {
            $modelNachlass->delete();
        }

        return $this->actionUpdate($datenblattId, true);
//        return $this->redirect(['update', 'id' => $datenblattId]);
    }

    /**
     * Deletes zinsverzug
     *
     * @param int $datenblattId
     * @param int $zinsverzugId
     * @return void
     */
    public function actionDeletezinsverzug($datenblattId, $zinsverzugId)
    {
        $this->actionUpdate($datenblattId);

        $model = $this->findModel($datenblattId);
        if ($modelZinsverzug = Zinsverzug::findOne($zinsverzugId)) {
            $modelZinsverzug->delete();
        }

        return $this->actionUpdate($datenblattId, true);
//        return $this->redirect(['update', 'id' => $datenblattId]);
    }

    /**
     * Deletes zahlung
     * @param int $datenblattId
     * @param int $zahlungId
     * @return void
     */
    public function actionDeletezahlung($datenblattId, $zahlungId)
    {
        $this->actionUpdate($datenblattId);

        $model = $this->findModel($datenblattId);
        if ($item = Zahlung::findOne($zahlungId)) {
            $item->delete();
        }

        return $this->actionUpdate($datenblattId, true);
//        return $this->redirect(['update', 'id' => $datenblattId]);
    }

    public function actionSubcat()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $firma_id = $parents[0];
                $out = self::getSubCatList($firma_id);
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionAutocompletekunden()
    {

        $out = [];
        if (isset($_GET['term'])) {

//        die($_GET['term']);
//            $kunden = Kunde::findAll(['debitor_nr like "%' . $_GET['term'] . '%"']);
            $kaeufers = Kaeufer::find()
                ->where(['like', 'debitor_nr', $_GET['term']])
                ->orWhere(['like', 'vorname', $_GET['term']])
                ->orWhere(['like', 'nachname', $_GET['term']])
                ->all();
//die('bbbb');
//            $query = new Query;
//
//            $query->select('name')
//                ->from('country')
//                ->where('name LIKE "%' . $q .'%"')
//                ->orderBy('name');
//            $command = $query->createCommand();
//            $data = $command->queryAll();
//            $out = [];
//            foreach ($data as $d) {
//                $out[] = ['value' => $d['name']];
//            }
//            echo Json::encode($out);

//            var_dump(count($kunden));


            $labelColumns = array(
                'debitor_nr' => array('title' => 'Debitor-Nr.'),
                'vorname' => array('title' => 'Vorname'),
                'nachname' => array('title' => 'Nachname'),
            );
            $results = array();

//            '<span style="width: 100px; display: inline-block;">' . $settings['title'] . '</span>';

            $row = '';
            foreach ($labelColumns as $columnName => $settings) {
                $row .= '<span style="width: 100px; display: inline-block;">' . $settings['title'] . '</span>';
            }
            $results[] = array(
                'id' => 0,
                'value' => '',
//                'label' => $row
                'label' => '',
                'debitor_nr' => 'Debitor-Nr.',
                'vorname' => 'Vorname',
                'nachname' => 'Nachname'
            );

            foreach ($kaeufers as $kaeufer) {

//                $productName = $kunde->getCurrentTranslation()->getName();

                $data = $kaeufer->attributes;
                $data['value'] = '1';

//                $row = '';
//                foreach ($labelColumns as $columnName => $settings) {
//                    $row .= '<span style="width: 100px; display: inline-block;">' . $kaeufer->{$columnName} . '</span>';
//                }
//                $data['label'] = $row;
                $data['label'] = '';

                $results[] = $data;

//                $results[] = array(
//                    'id' => $kaeufer->debitor_nr,
//                    'label' => $kaeufer->debitor_nr,
//                    'value' => $kaeufer->debitor_nr,
//                    'anrede' => $kaeufer->anrede,
//                    'titel' => $kaeufer->titel,
//                    'vorname' => $kaeufer->vorname,
//                    'nachname' => $kaeufer->nachname,
//                    'email' => $kaeufer->email,
//                    'strasse' => $kaeufer->strasse,
//                    'hausnr' => $kaeufer->hausnr,
//                    'plz' => $kaeufer->plz,
//                    'ort' => $kaeufer->ort,
//                    'festnetz' => $kaeufer->festnetz,
//                    'handy' => $kaeufer->handy,
//                );
            }

//            if (count($results) == 0) {
//                $results[] = array(
//                    "id" => '',
//                    "label" => '',
//                    "value" => ''
//                );
//            }


            echo Json::encode($results);
            return;
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }


    public function actionReport($id)
    {

        $modelDatenblatt = $this->findModel($id);
        $this->_calculatePreises($modelDatenblatt);
		
		$pdfLogo = '';
		if ($modelDatenblatt->projekt) {
			$pdfLogo = $modelDatenblatt->projekt->getPdfLogoName();
		}
		
        $headerHtml = $this->renderPartial('_pdf_header', ['model' => $modelDatenblatt, 'pdfLogo' => $pdfLogo]);

        //get your html raw content without layouts
        // $content = $this->renderPartial('view');
        //set up the kartik\mpdf\Pdf component
        $pdf = new Pdf([
            'content' => $this->renderPartial('pdf', ['model' => $modelDatenblatt,]),

            //'mode'=> Pdf::MODE_CORE,
            'mode' => Pdf::MODE_BLANK,
            'format' => Pdf::FORMAT_A4,
            'defaultFontSize' => 10.0,
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'destination' => Pdf::DEST_BROWSER,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => ' tr:nth-child(odd) {background: #fff;} tr:nth-child(even) {background: #eee;} table{width:100%}',
            //'options'=> ['title'=> 'Datenblatt'],
            'marginTop' => '40',
            'methods' => [
                //'setHeader' => ['Erstellt am: ' . date("d.m.Y")],
                'setHeader' => [$headerHtml],
                'setFooter' => ['Erstellt am :' . date("d.m.Y") . '| |' . 'Seite {PAGENO} / {nb}'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionAddTeileigentumseinheit($datenblattId, $teId) {

        /** @var Datenblatt $model */
        $model = $this->findModel($datenblattId);

        if (!$model->haus_id) {
            $haus = new Haus();
            $haus->projekt_id = $model->projekt_id;
            $haus->firma_id = $model->firma_id;
            $haus->creator_user_id = User::getCurrentUser()->id;
            $haus->save();

            $model->haus_id = $haus->id;
            $model->save();
        }

        if (!$model->haus->strasse) {
            $model->refresh();
            $model->updateAddresseVonProjekt();
        }

        if (!$model->isAbschlagAngefordert()) {

            $te = Teileigentumseinheit::findOne($teId);
            $te->haus_id = $model->haus_id;
            $te->save();

            $model->refresh();
        }

        return $this->renderPartial('_teileigentumseinheiten', ['modelDatenblatt' => $model]);
    }

    public function actionRemoveTeileigentumseinheit($datenblattId, $teId) {

        $model = $this->findModel($datenblattId);

        if (!$model->isAbschlagAngefordert()) {

            $te = Teileigentumseinheit::findOne($teId);
            $te->haus_id = null;
            $te->save();

            $model->refresh();
        }

        return $this->renderPartial('_teileigentumseinheiten', ['modelDatenblatt' => $model]);
    }

    /**
     * Finds the Datenblatt model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Datenblatt the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Datenblatt::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpdatedebitorennummer() {
        $datenblatts = Datenblatt::find()->all();
        /** @var Datenblatt $datenblatt */
        foreach ($datenblatts as $datenblatt) {

            if ($datenblatt->kaeufer) {
                $debitorNr = $datenblatt->kaeufer->debitor_nr;
                $datenblatt->sap_debitor_nr = $debitorNr;
            }
            $datenblatt->updateInternDebitorNr();

            echo $datenblatt->sap_debitor_nr . ' - ' . $datenblatt->intern_debitor_nr . "<br>";
        }

        return 'Aktualisiert';
    }

    public function actionMassenbearbeitung() {

        return $this->render('massenbearbeitung', []);
    }

}
