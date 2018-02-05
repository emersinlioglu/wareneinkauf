<?php

namespace app\controllers;

use app\models\QueryBuilderProfile;
use app\models\QueryBuilderProfileSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\User;

/**
 * QueryBuilderProfileController implements the CRUD actions for QueryBuilderProfile model.
 */
class QueryBuilderProfileController extends Controller
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
     * Lists all QueryBuilderProfile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QueryBuilderProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single QueryBuilderProfile model.
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
     * Creates a new QueryBuilderProfile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new QueryBuilderProfile();
        $model->user_id = User::getCurrentUser()->id;
        $model->aktive = true;

//        var_dump($model->load(Yii::$app->request->post()));
//        var_dump($model->save());
//        var_dump($model->errors);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            foreach ($model->user->queryBuilderProfiles as $profile) {
                if ($model->id != $profile->id) {
                    $profile->aktive = 0;
                    $profile->save();
                }
            }

            return $this->redirect($_SERVER['HTTP_REFERER']);
        } else if (Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
                'model' => $model
            ]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing QueryBuilderProfile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        var_dump($model->load(Yii::$app->request->post()));
        var_dump($model->errors);
        var_dump($model->save());
        if (isset($_POST['reset'])) {
            QueryBuilderProfile::updateAll(['aktive' => 0]);
            return $this->redirect($_SERVER['HTTP_REFERER']);
        } else if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect($_SERVER['HTTP_REFERER']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing QueryBuilderProfile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $profile = $this->findModel($id);
        $user = $profile->user;
        $profile->delete();

        if (count($user->queryBuilderProfiles) > 0) {
            $newAktiveProfile = $user->queryBuilderProfiles[0];
            $newAktiveProfile->aktive = 1;
            $newAktiveProfile->save();
        }

        return $this->redirect($_SERVER['HTTP_REFERER']);
    }

    public function actionSetActive($id = '')
    {
        $model = QueryBuilderProfile::findOne($id);

        if ($model) {
            foreach ($model->user->queryBuilderProfiles as $profile) {
                $profile->aktive = 0;
                $profile->save();
            }
            $model->aktive = 1;
            $model->save();
        } else {
            QueryBuilderProfile::updateAll(['aktive' => 0]);
        }

        return $this->redirect($_SERVER['HTTP_REFERER']);
    }

    /**
     * Finds the QueryBuilderProfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return QueryBuilderProfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QueryBuilderProfile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
