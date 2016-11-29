<?php

namespace app\controllers;

use app\models\Datenblatt;
use Yii;
use app\models\Kaeufer;
use app\models\KaeuferSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KaeuferController implements the CRUD actions for Kaeufer model.
 */
class KaeuferController extends Controller
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
     * Lists all Kaeufer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KaeuferSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kaeufer model.
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
     * Creates a new Kaeufer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kaeufer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Kaeufer model.
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

    public function actionUpdatedates()
    {
        $columns = [
            'beurkundung_am',
            'verbindliche_fertigstellung',
            'uebergang_bnl',
            'abnahme_se',
            'abnahme_ge',
            'auflassung'
        ];

        $cnt = 0;
        $datenblatts = Datenblatt::find()->all();
        foreach ($datenblatts as $datenblatt) {
            $kaeufer = $datenblatt->kaeufer;
            if ($kaeufer) {
                $cnt++;
                foreach ($columns as $column) {
                    $datenblatt->{$column} = $kaeufer->{$column};
                }

                echo "dbid: " . $datenblatt->id . "<br>";
                $datenblatt->save();
            }


        }

        return 'updated: ' . $cnt;
    }

    /**
     * Deletes an existing Kaeufer model.
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
     * Finds the Kaeufer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Kaeufer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kaeufer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
