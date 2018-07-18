<?php

namespace app\controllers;

use kartik\mpdf\Pdf;
use Yii;
use app\models\Vorlage;
use app\models\VorlageSearch;
use app\models\User;
use app\models\QueryBuilderProfile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * VorlageController implements the CRUD actions for Vorlage model.
 */
class VorlageController extends Controller
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
     * Lists all Vorlage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VorlageSearch();

        $projektId = User::getActiveProjekt() ? User::getActiveProjekt()->id : null;

        if (!User::hasAccessToProject()) {
            return $this->redirect(['site/project-access-error']);
        }

        // new dataprovider
        $rules = Json::decode(QueryBuilderProfile::getActiveFilterRules());
        $dataProvider = $searchModel->searchByQueryBuilder($rules, $projektId, Yii::$app->request->queryParams);


    //   $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vorlage model.
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
     * Creates a new Vorlage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vorlage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Vorlage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        //Feld für Projektzuordnung anlegen
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
     * Deletes an existing Vorlage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->deleted = date('Y-m-d H:i:s');
        $model->save();

        return $this->redirect(['index']);
    }


    public function actionReport($id)
    {
        $model = $this->findModel($id);

        \yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        \yii::$app->response->headers->add('Content-Type', 'application/pdf');

        //get your html raw content without layouts
        // $content = $this->renderPartial('view');
        //set up the kartik\mpdf\Pdf component
        $pdf = new Pdf([
            'content' => $this->renderPartial('pdf', ['model' => $model]),

            //'mode'=> Pdf::MODE_CORE,
            'mode' => Pdf::MODE_BLANK,
            'filename' => $model->name,
            'format' => Pdf::FORMAT_A4,
            'defaultFontSize' => 10.0,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => ' tr:nth-child(odd) {background: #fff;} tr:nth-child(even) {background: #eee;} table{width:100%}',
            'options'=> ['title'=> $model->name],
            'marginTop' => '10',
            'methods' => [
               // 'setHeader' => ['Erstellt am: ' . date("d.m.Y")],
               // 'setHeader' => [$headerHtml],
               // 'setFooter' => ['Erstellt am :' . date("d.m.Y") . '| |' . 'Seite {PAGENO} / {nb}'],
            ]
        ]);

        return $pdf->render();
    }


    /**
     * Finds the Vorlage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vorlage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vorlage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
