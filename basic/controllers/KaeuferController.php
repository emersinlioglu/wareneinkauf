<?php

namespace app\controllers;

use app\models\Datenblatt;
use app\models\KaeuferProjekt;
use app\models\Teileigentumseinheit;
use app\models\User;
use Yii;
use app\models\Kaeufer;
use app\models\KaeuferSearch;
use yii\helpers\ArrayHelper;
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
        $model->user_id = User::getCurrentUser()->id;

        $projektZuweisungFehlt = false;
        $kaeuferProjektIds = Yii::$app->request->post('KaeuferProjekt');
        if (Yii::$app->request->isPost && $kaeuferProjektIds == null) {
            $model->addError('kaeuferProjekts', 'Käufer muss mindestens zu einem Projekt zugewiesen werden!');
            $projektZuweisungFehlt = true;
        }

        if ($model->load(Yii::$app->request->post()) && !$projektZuweisungFehlt && $model->save()) {

            $kaeuferProjekts = Yii::$app->request->post('KaeuferProjekt');
            $this->saveKaeuferProdukts($model, $kaeuferProjekts);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
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

        $projektZuweisungFehlt = false;
        $kaeuferProjektIds = Yii::$app->request->post('KaeuferProjekt');
        if (Yii::$app->request->isPost && $kaeuferProjektIds == null) {
            $model->addError('kaeuferProjekts', 'Käufer muss mindestens zu einem Projekt zugewiesen werden!');
            $projektZuweisungFehlt = true;
        }

        if ($model->load(Yii::$app->request->post()) && !$projektZuweisungFehlt && $model->save()) {

            $result = $this->saveKaeuferProdukts($model, $kaeuferProjektIds);

            if ($result) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionAssignTeileigentumseinheit($kaeuferId, $teId) {

        /** @var $kaeufer Kaeufer */
        $kaeufer = Kaeufer::findOne($kaeuferId);
        /** @var $te Teileigentumseinheit  */
        $te = Teileigentumseinheit::findOne($teId);

        if ($kaeufer && $te) {
            $te->kaeufer_id = $kaeufer->id;
            if ($te->status != Teileigentumseinheit::STATUS_VERKAUFT) {
                $te->status = Teileigentumseinheit::STATUS_RESERVIERT;
            }
            $te->save();
        }

        return $this->redirect(['update', 'id' => $kaeufer->id]);
    }

    public function actionUnassignTeileigentumseinheit($kaeuferId, $teId) {

        /** @var $kaeufer Kaeufer */
        $kaeufer = Kaeufer::findOne($kaeuferId);
        /** @var $te Teileigentumseinheit  */
        $te = Teileigentumseinheit::findOne($teId);

        if ($kaeufer && $te && $te->kaeufer_id == $kaeufer->id) {
            $te->kaeufer_id = null;
            if ($te->status != Teileigentumseinheit::STATUS_VERKAUFT) {
                $te->status = Teileigentumseinheit::STATUS_FREI;
            }
            $te->save();
        }

        return $this->redirect(['update', 'id' => $kaeufer->id]);
    }

    private function saveKaeuferProdukts($model, $kaeuferProjektIds = array()) {

        if ($kaeuferProjektIds == null) {
            $model->addError('kaeuferProjekts', 'Käufer muss mindestens zu einem Projekt zugewiesen werden!');
            return false;
        }

        $existingProjektIds = [];
        $accesableProjektIds = User::getAccessableProjektIds();

        // delete not existing assignments
        foreach ($model->kaeuferProjekts as $kaeuferProjekt) {
            if (!in_array($kaeuferProjekt->projekt_id, $kaeuferProjektIds) && in_array($kaeuferProjekt->projekt_id, $accesableProjektIds)) {
                $kaeuferProjekt->delete();
            } else {
                $existingProjektIds[] = $kaeuferProjekt->projekt_id;
            }
        }

        // add new assignments
        foreach ($kaeuferProjektIds as $projektId) {
            if (!in_array($projektId, $existingProjektIds)) {
                $kaeuferProjekt = new KaeuferProjekt();
                $kaeuferProjekt->projekt_id = $projektId;
                $kaeuferProjekt->kaeufer_id = $model->id;
                $kaeuferProjekt->save();
            }
        }

        return true;
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
