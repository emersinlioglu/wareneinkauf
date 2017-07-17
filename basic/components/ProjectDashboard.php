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
        $verkaufsentwicklungDataProProjektStatus = [];
        foreach ($projectDashboardData as $data) {

            foreach (Einheitstyp::find()->all() as $einheitstyp) {

                $einheitstypData = ProjektSearch::getInfoForEinheitstyp(
                    $data['projektId'],
                    $einheitstyp->id
                );

                if ($einheitstypData['einheitenGesamt'] > 0) {
                    $verkaufsentwicklungDataProProjekt[] =
                    [
                        'name'      => $einheitstyp->name,
                        'y'         => (float)$einheitstypData['einheitenGesamt'],
                    ];
                }


                if ($einheitstypData['einheitenFreiStück'] > 0) {
                    $verkaufsentwicklungDataProProjektStatus[] =
                    [
                        'name'      => 'Frei',
                        'y'         => (float)$einheitstypData['einheitenFreiStück'],
                    ];
                }
                if ($einheitstypData['einheitenReserviertStück'] > 0) {
                    $verkaufsentwicklungDataProProjektStatus[] =
                    [
                        'name'      => 'Reserviert',
                        'y'         => (float)$einheitstypData['einheitenReserviertStück'],
                    ];
                }
                if ($einheitstypData['einheitenVerkauftStück'] > 0) {
                    $verkaufsentwicklungDataProProjektStatus[] =
                    [
                        'name'      => 'Verkauft',
                        'y'         => (float)$einheitstypData['einheitenVerkauftStück'],
                    ];
                }

            }

            $verkaufsentwicklungData[] = [
                'name'      => $data['name'],
                'y'         => (float)$data['einheitenGesamt'],
            ];

//            $verkaufsentwicklungDataProProjekt[] =
//                [
//                    'name'      => 'Frei',
//                    'y'         => (float)$data['wohnflaechensummeFrei'],
//                ];
//            $verkaufsentwicklungDataProProjekt[] =
//                [
//                    'name'      => 'Reserviert',
//                    'y'         => (float)$data['wohnflaechensummeReserviert'],
//                ];
//            $verkaufsentwicklungDataProProjekt[] =
//                [
//                    'name'      => 'Verkauft',
//                    'y'         => (float)$data['wohnflaechensummeVerkauft'],
//                ];

        }

        if (!\Yii::$app->user->isSuperadmin) {
            return '';
        }

        return $this->render('projectDashboard', array(
            "projectDashboardData" => $projectDashboardData,
            "verkaufsentwicklungData" => $verkaufsentwicklungData,
            "verkaufsentwicklungDataProProjekt" => $verkaufsentwicklungDataProProjekt,
            "verkaufsentwicklungDataProProjektStatus" => $verkaufsentwicklungDataProProjektStatus,
        ));
    }
}