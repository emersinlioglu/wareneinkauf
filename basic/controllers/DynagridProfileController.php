<?php

namespace app\controllers;

use app\models\User;
use Yii;
use app\models\DynagridProfile;
use app\models\DynagridProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DynagridProfileController implements the CRUD actions for DynagridProfile model.
 */
class DynagridProfileController extends Controller
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
     * Lists all DynagridProfile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DynagridProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DynagridProfile model.
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
     * Creates a new DynagridProfile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DynagridProfile();
        $model->user_id = User::getCurrentUser()->id;
        $model->aktive = true;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            foreach ($model->user->dynagridProfiles as $profile) {
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
     * Updates an existing DynagridProfile model.
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
     * Deletes an existing DynagridProfile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $profile = $this->findModel($id);
        $user = $profile->user;
        $profile->delete();

        if (count($user->dynagridProfiles) > 0) {
            $newAktiveProfile = $user->dynagridProfiles[0];
            $newAktiveProfile->aktive = 1;
            $newAktiveProfile->save();
        }

        return $this->redirect($_SERVER['HTTP_REFERER']);
    }

    public function actionSetActive($id)
    {
        $model = $this->findModel($id);

        foreach ($model->user->dynagridProfiles as $profile) {
            $profile->aktive = 0;
            $profile->save();
        }
        $model->aktive = 1;
        $model->save();

        return $this->redirect($_SERVER['HTTP_REFERER']);
    }

    /**
     * Finds the DynagridProfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DynagridProfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DynagridProfile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
