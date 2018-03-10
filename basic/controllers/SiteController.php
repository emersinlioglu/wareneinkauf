<?php

namespace app\controllers;

use app\models\Einheitstyp;
use app\models\Projekt;
use app\models\TeileigentumseinheitSearch;
use miloschuman\highcharts\Highcharts;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{


    public function behaviors()
    {
        return [
            /*
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            */
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $einheitstypModel = new Einheitstyp();
        $projektModel     = new Projekt();

//        $verkaufsentwicklungData = [];
//        $verkaufsentwicklungDataProProjekt = [];
//
//        foreach ($projektModel->getWohnflaeschenDataFuerAlleProjekte() as $key => $row) {
//            $verkaufsentwicklungData[] = [
//                'name'      => $row['name'],
//                'y'         => (float) $row['summeWohnflaeche'],
//            ];
//
//            $projektData = $einheitstypModel->getProjektVerkaufsentwicklungData($row['projektId']);
//            foreach ($projektData as $pKey => $pData) {
//                $verkaufsentwicklungDataProProjekt[] = [
//                    'name'      => $pData['projektName'],
//                    'y'         => (float) $pData['summeWohnflaeche'],
//                ];
//            }
//        }

        return $this->render('index', [
//            'verkaufsentwicklungData'           => $verkaufsentwicklungData,
//            'verkaufsentwicklungDataProProjekt' => $verkaufsentwicklungDataProProjekt
        ]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionProjectAccessError() {
        return $this->render('projectAccessError');
    }
}
