<?php

namespace app\controllers;

use app\models\Datenblatt;
use Yii;
use app\models\Abschlag;
use app\models\AbschlagSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AbschlagController implements the CRUD actions for Abschlag model.
 */
class AbschlagController extends Controller
{
    public function behaviors()
    {
        return [
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

        $data = array();
        if (Yii::$app->request->isPost) {

            $submit = Yii::$app->request->post('submit', null);
            $datenblattIds = Yii::$app->request->post('datenblatts', []);

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
        for($i=1; $i <= $maxCountAbschlags; $i++) {
            $abschlagOptions[$i] = 'Abschlag ' . $i;
        }

        return $this->render('serienbrief', [
            'abschlagOptions' => $abschlagOptions,
            'datenblattIds' => $datenblattIds,
        ]);
    }

    public function actionUpdateAbschlagDatum()
    {
        $abschlagNr = Yii::$app->request->getQueryParam('abschlag', null);
        $datenblattIds = Yii::$app->request->getQueryParam('datenblatt', []);
        $datenblatts = Datenblatt::find()->where(['id' => $datenblattIds])->all();

        if (!$abschlagNr) {
            echo "Bitte wählen Sie einen Abschlag";
            return;
        }

        $data = [];
        /** @var Datenblatt $datenblatt */
        foreach ($datenblatts as $datenblatt) {

            /** @var Abschlag $abschlag */
            if (isset($datenblatt->abschlags[$abschlagNr-1])) {
                $abschlag = $datenblatt->abschlags[$abschlagNr-1];

                $abschlag->mail_datum = date('Y-m-d');
                if ($abschlag->save()) {
                    $data['success'][] = $datenblatt->id;
                } else {
                    $data['error'][] = $datenblatt->id;
                }
            } else {
                $data['missing'][] = $datenblatt->id;
            }
        }

        return $this->renderPartial('updateAbschlagDatum', [
            'data' => $data,
        ]);
    }

    public function actionSendAbschlagMails()
    {
//        $abschlagNr = Yii::$app->request->getQueryParam('abschlag', null);
//        $datenblattIds = Yii::$app->request->getQueryParam('datenblatt', []);
//        $datenblatts = Datenblatt::find()->where(['id' => $datenblattIds])->all();
//
//        if (!$abschlagNr) {
//            echo "Bitte wählen Sie einen Abschlag";
//            return;
//        }
//
//        $data = [];
//        /** @var Datenblatt $datenblatt */
//        foreach ($datenblatts as $datenblatt) {
//
//            /** @var Abschlag $abschlag */
//            if (isset($datenblatt->abschlags[$abschlagNr-1])) {
//                $abschlag = $datenblatt->abschlags[$abschlagNr-1];
//
//                $abschlag->mail_datum = date('Y-m-d');
//                if ($abschlag->save()) {
//                    $data['success'][] = $datenblatt->id;
//                } else {
//                    $data['error'][] = $datenblatt->id;
//                }
//            } else {
//                $data['missing'][] = $datenblatt->id;
//            }
//        }

        return $this->renderPartial('sendAbschlagMails', [
            'data' => $data,
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
