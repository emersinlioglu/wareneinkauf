<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

//use \yii\base\Model;
//use yii\web\Response;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\DynamicForm;
use app\models\Datenblatt;
use app\models\Nachlass;
use app\models\Zahlung;
use app\models\Kaeufer;
use app\models\Sonderwunsch;

/**
 * DatenblattController implements the CRUD actions for Datenblatt model.
 */
class DatenblattController extends Controller
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
     * Creates a new Person model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelDatenblatt = new Datenblatt;
        $modelsNachlass = [new Nachlass];
        $modelsZahlung = [new Zahlung];
//        $modelsRoom = [[new Zahlung]];

        if ($modelDatenblatt->load(Yii::$app->request->post())) {

//            $modelsNachlass = DynamicForm::createMultiple(Nachlass::classname());
//            DynamicForm::loadMultiple($modelsNachlass, Yii::$app->request->post());
//var_dump($modelDatenblatt);
//            die('da1');            
            $modelsZahlung = DynamicForm::createMultiple(Zahlung::classname());
            DynamicForm::loadMultiple($modelsZahlung, Yii::$app->request->post());

            // validate person and houses models
            $valid = $modelDatenblatt->validate();
//var_dump($modelsZahlung);
//            $valid = DynamicForm::validateMultiple($modelsNachlass) && $valid;
            $valid = DynamicForm::validateMultiple($modelsZahlung, ['betrag']) && $valid;
//var_dump($valid);
//die;
//            if (isset($_POST['Room'][0][0])) {
//                foreach ($_POST['Room'] as $indexNachlass => $rooms) {
//                    foreach ($rooms as $indexRoom => $room) {
//                        $data['Room'] = $room;
//                        $modelRoom = new Room;
//                        $modelRoom->load($data);
//                        $modelsRoom[$indexNachlass][$indexRoom] = $modelRoom;
//                        $valid = $modelRoom->validate();
//                    }
//                }
//            }

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelDatenblatt->save(false)) {
                        foreach ($modelsNachlass as $indexNachlass => $modelNachlass) {

                            if ($flag === false) {
                                break;
                            }

                            $modelNachlass->datenblatt_id = $modelDatenblatt->id;

                            if (!($flag = $modelNachlass->save(false))) {
                                break;
                            }

//                            if (isset($modelsRoom[$indexNachlass]) && is_array($modelsRoom[$indexNachlass])) {
//                                foreach ($modelsRoom[$indexNachlass] as $indexRoom => $modelRoom) {
//                                    $modelRoom->house_id = $modelNachlass->id;
//                                    if (!($flag = $modelRoom->save(false))) {
//                                        break;
//                                    }
//                                }
//                            }
                        }
                        
                        // save zahlungs
                        foreach ($modelsZahlung as $indexZahlung => $modelZahlung) {

                            if ($flag === false) {
                                break;
                            }

                            $modelZahlung->datenblatt_id = $modelDatenblatt->id;

                            if (!($flag = $modelZahlung->save(false))) {
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelDatenblatt->id]);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'modelDatenblatt' => $modelDatenblatt,
            'modelsZahlung' => (empty($modelsZahlung)) ? [new Zahlung] : $modelsZahlung,
            'modelsNachlass' => (empty($modelsNachlass)) ? [new Nachlass] : $modelsNachlass,
//            'modelsRoom' => (empty($modelsRoom)) ? [[new Room]] : $modelsRoom,
        ]);
    }

    /**
     * Updates an existing Person model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelDatenblatt = $this->findModel($id);
        
        $data = Yii::$app->request->post();
        
        if ($modelDatenblatt->load($data) && $modelDatenblatt->save()) {
            
            // Käufer
            $modelKaeufer = $modelDatenblatt->kaeufer;
            if (!$modelKaeufer) {
                $modelKaeufer = new Kaeufer();
            }
            if ($modelKaeufer->load(Yii::$app->request->post())) {

                $datumFelder = ['beurkundung_am', 'verbindliche_fertigstellung', 'uebergang_bnl', 'abnahme_se', 'abnahme_ge'];
                foreach($datumFelder as $feld) {
                    $datum = \DateTime::createFromFormat('d.m.Y', $modelKaeufer->{$feld}); 
                    if ($datum) {
                        $datum->setTime(0, 0, 0);
                        $modelKaeufer->{$feld} = $datum->format('Y-m-d H:i:s');
                    } else {
                        $modelKaeufer->{$feld} = '';
                    }
                }
                // save
                $modelKaeufer->save();
                // assign käufer
                $modelDatenblatt->kaeufer_id = $modelKaeufer->id;
                $modelDatenblatt->save();
            }

            // Sonderwünsche
            if ($modelsSonderwunsch = Sonderwunsch::loadMultiple($modelDatenblatt->sonderwunsches, $data)) {
                foreach ($modelDatenblatt->sonderwunsches as $item) {
                    $datumFelder = ['angebot_datum', 'beauftragt_datum', 'rechnungsstellung_datum'];
                    foreach($datumFelder as $feld) {
                        $datum = \DateTime::createFromFormat('d.m.Y', $item->{$feld}); 
                        if ($datum) {
                            $datum->setTime(0, 0, 0);
                            $item->{$feld} = $datum->format('Y-m-d H:i:s');
                        } else {
                            $item->{$feld} = '';
                        }
                    }

                    $item->save();
                }
            }
            
            $this->redirect(['update', 'id' => $id]);
        }

        return $this->render('update', [
            'modelDatenblatt' => $modelDatenblatt,
            'modelsZahlungs' => $modelDatenblatt->zahlungs,
            'modelKaeufer' => $modelDatenblatt->kaeufer ? $modelDatenblatt->kaeufer : new Kaeufer(),
        ]);
    }
    
    /**
     * Add new datenblatt
     * @param int $datenblattId
     */
    public function actionAddsonderwunsch($datenblattId) {
        
        $new = new Sonderwunsch();
        $new->datenblatt_id = $datenblattId;
        $new->save();
        
        $this->redirect(['update', 'id' => $datenblattId]);
    }

    /**
     * Deletes an existing Person model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $name = $model->first_name;

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
        $model = $this->findModel($datenblattId);

        if ($modelSonderwunsch = Sonderwunsch::findOne($sonderwunschId)) {
            $modelSonderwunsch->delete();
        }

        return $this->redirect(['update', 'id' => $datenblattId]);
    }
     
    /**
     * Displays a single Projekt model.
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
     * Lists all Projekt models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Datenblatt::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Person model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Person the loaded model
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
}
