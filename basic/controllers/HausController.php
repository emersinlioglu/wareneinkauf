<?php

namespace app\controllers;

use Yii;
use app\models\Haus;
use app\models\Firma;
use app\models\HausSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Teileigentumseinheit;
use app\models\Zaehlerstand;
use yii\data\ActiveDataProvider;

/**
 * HausController implements the CRUD actions for Haus model.
 */
class HausController extends Controller
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
     * Lists all Haus models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HausSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Haus model.
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
     * Creates a new Haus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Haus();

        $model->creator_user_id = Yii::$app->user->getId();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionProjekte($firmaId) {
        
        $items = array();

        if (($firma = Firma::findOne($firmaId)) !== null) {

            foreach ($firma->projekts as $projekt) {
                $items[] = array(
                    'text' => $projekt->name,
                    'value' => $projekt->id
                );
            }
        }


        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $items;
    }

    /**
     * Updates an existing Haus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
     public function actionUpdate($id, $preventPost = false)
    {
        $model = $this->findModel($id);

        $data = Yii::$app->request->post();

        if (!$preventPost && $model->load($data) && $model->save()) {

            if (Teileigentumseinheit::loadMultiple($model->teileigentumseinheits, $data, 'Teileigentumseinheiten')
                && Teileigentumseinheit::validateMultiple($model->teileigentumseinheits)) {

                foreach ($model->teileigentumseinheits as $item) {
                    $item->save();
                }
            }

            if (Zaehlerstand::loadMultiple($model->zaehlerstands, $data)) {
                foreach ($model->zaehlerstands as $item) {
                    $item->save();
                }
            }

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    /**
     * Add new 
     * @param int $datenblattId
     */
    public function actionAddteileigentumseinheit($hausId) {
        
        $new = new Teileigentumseinheit();
        $new->haus_id = $hausId;
        $new->einheitstyp_id = 1;
        $new->save(false);

        $this->actionUpdate($hausId);
        return $this->redirect(['update', 'id' => $hausId]);
    }
    
    /**
     * Add new
     * @param int $datenblattId
     */
    public function actionAddzaehlerstand($hausId) {
        
        $new = new Zaehlerstand();
        $new->haus_id = $hausId;
        $new->save();

        return $this->actionUpdate($hausId);
//        $this->redirect(['update', 'id' => $datenblattId]);
    }

    /**
     * Deletes an existing Haus model.
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
     * Deletes an existing Teileigentumseinheit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDeleteteileigentumseinheit($hausId, $teileigentumseinheitId)
    {

        $this->actionUpdate($hausId);
         
        $teileigentumseinheit = Teileigentumseinheit::findOne($teileigentumseinheitId);
        if ($teileigentumseinheit) {
            $teileigentumseinheit->delete();
        }
        
        $this->actionUpdate($hausId, true);
        return $this->redirect(['update', 'id' => $hausId]);
    }
    
    /**
     * Deletes an existing Teileigentumseinheit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDeletezaehlerstand($hausId, $zaehlerstandId)
    {
        $this->actionUpdate($hausId);
        
        if ($zaehlerstand = Zaehlerstand::findOne($zaehlerstandId)) {
            $zaehlerstand->delete();
        }
        
        return $this->actionUpdate($hausId, true);
        //return $this->redirect(['update', 'id' => $hausId]);
    }








    /**
     * Finds the Haus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Haus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Haus::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
