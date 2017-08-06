<?php

namespace app\controllers;

use kartik\mpdf\Pdf;
use Yii;
use app\models\Projekt;
use app\models\ProjektSearch;
use webvimark\modules\UserManagement\models\search\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjektController implements the CRUD actions for Projekt model.
 */
class ProjektController extends Controller
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
     * Lists all Projekt models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjektSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
     * Creates a new Projekt model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Projekt();
        $model->creator_user_id = Yii::$app->user->getId();
        $data = Yii::$app->request->post();

        if ($model->load($data) && !$model->isProjektExistingForFirma() && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Projekt model.
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

    public function actionProjektattributes($id) {

        $model = $this->findModel($id);

        \Yii::$app->response->format = 'json';
        return $model->attributes;
    }

    /**
     * Deletes an existing Projekt model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSearchusers() {

        $searchTerm = Yii::$app->request->get('term');

        //$userSearchModel = new UserSearch();
        $users = UserSearch::find()
            ->where('superadmin = 0 AND status = 1 AND username like :searchTerm', [
                'searchTerm' => "%$searchTerm%"
            ])
            ->all();

        $data = array();
        foreach ($users as $user) {
            
            $data[] = array(
                'id' => $user->id,
                'label' => $user->username,
                'value' => $user->username
            );
        }

        return json_encode($data);
    }

    public function actionAdduserassignment($id) {

        $model = $this->findModel($id);

        $userId = Yii::$app->request->post('userId');
        $user = UserSearch::findOne($userId);

        if ($user) {

            
            $command = Yii::$app->db->createCommand('SELECT COUNT(*) FROM projekt_user WHERE projekt_id=:projektId and user_id=:userId');
            $cnt = $command
                ->bindValue(':projektId', $model->id)
                ->bindValue(':userId', $user->id)
                ->queryScalar();
            
            if (!$cnt) {
                //add
                Yii::$app->db->createCommand()->insert('projekt_user', [
                    'projekt_id' => $model->id,
                    'user_id' => $user->id,
                ])->execute();
            }

        }

        return '';
    }

    public function actionRemoveuserassignment($projektId, $userId) {

        $model = $this->findModel($projektId);
        $user = UserSearch::findOne($userId);

        if ($user) {
            //remove
            Yii::$app->db->createCommand()->delete('projekt_user', "projekt_id={$model->id} and user_id={$user->id}")->execute();
        }

        return '';
    }

    public function actionPdf($id) {

        $projekt = Projekt::findOne($id);

        $projectDashboardData = ProjektSearch::getAllProjectsInfo(
            null,
            $projekt->id
        );

        $content = $this->renderPartial('pdf', ['projectDashboardData' => $projectDashboardData]);

        //get your html raw content without layouts
        // $content = $this->renderPartial('view');
        //set up the kartik\mpdf\Pdf component
        $pdf = new Pdf([
            'content' => $content,

            //'mode'=> Pdf::MODE_CORE,
            'mode' => Pdf::MODE_BLANK,
            'format' => Pdf::FORMAT_A4,
            'defaultFontSize' => 10.0,
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'destination' => Pdf::DEST_BROWSER,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '
                *, body, p {
                  font-family: \'calibri\',\'serif\',\'couriernew\' !important;
                }
//                tr:nth-child(odd) {background: #fff;} tr:nth-child(even) {background: #eee;} table{width:100%}
                
                .projects thead tr th {
                    text-align: center;
                }
                .projects tbody tr td:not(:first-child) {
                    text-align: right;
                    white-space: nowrap;
                }
                .projects tbody tr.projekt {
                    cursor: pointer;
                }
                
                
                .projects tr th:nth-child(n+2),
                .projects tr td:nth-child(n+2)
                {
                    background-color: #f2f2f2;
                }
                
                .projects tr th:nth-child(n+5), 
                .projects tr td:nth-child(n+5)
                {
                    background-color: #d9d9d9;
                }
                
                .projects tr th:nth-child(n+7), 
                .projects tr td:nth-child(n+7)
                {
                    background-color: #c4d89b;
                }
                
                .projects tr th:nth-child(n+9), 
                .projects tr td:nth-child(n+9)
                {
                    background-color: #ffff00;
                }
                
                .projects tr.projekt td {
                    background-color: #cecece; 
                    font-weight: bold;
                }
            ',
            //'options'=> ['title'=> 'Datenblatt'],
            'marginTop' => '40',
            'marginBottom' => '40',
            'methods' => [
                'setHeader' => [$this->renderPartial('_pdf_header', ['pdfLogo' => $projekt->getPdfLogoName()])],
                'setFooter' => ['Erstellt am: ' . date("d.m.Y") . '| |' . 'Seite {PAGENO} / {nb}'],
            ]
        ]);

        return $pdf->render();
    }

    /**
     * Finds the Projekt model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Projekt the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Projekt::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

