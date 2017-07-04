<?php

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;
use \app\models\ProjektSearch;
use app\models\Einheitstyp;
use app\models\Projekt;


class ProjectDashboard extends Widget
{
    public $projectId;
    public $userId;

    public function init() {
        parent::init();

    }

    public function run() {

        $projectDashboardData = ProjektSearch::getAllProjectsInfo(
            $this->userId,
            $this->projectId
        );


        $verkaufsentwicklungData = [];
        $verkaufsentwicklungDataProProjekt = [];
        foreach ($projectDashboardData as $data) {

            $verkaufsentwicklungData[] = [
                'name'      => $data['name'],
                'y'         => (float)$data['wohnflaechensumme'],
            ];

            $verkaufsentwicklungDataProProjekt[] =
                [
                    'name'      => 'Frei',
                    'y'         => (float)$data['wohnflaechensummeFrei'],
                ];
            $verkaufsentwicklungDataProProjekt[] =
                [
                    'name'      => 'Reserviert',
                    'y'         => (float)$data['wohnflaechensummeReserviert'],
                ];
            $verkaufsentwicklungDataProProjekt[] =
                [
                    'name'      => 'Verkauft',
                    'y'         => (float)$data['wohnflaechensummeVerkauft'],
                ];

        }

        if (!\Yii::$app->user->isSuperadmin) {
            return '';
        }

        return $this->render('projectDashboard', array(
            "projectDashboardData" => $projectDashboardData,
            "verkaufsentwicklungData" => $verkaufsentwicklungData,
            "verkaufsentwicklungDataProProjekt" => $verkaufsentwicklungDataProProjekt,
        ));
    }
}