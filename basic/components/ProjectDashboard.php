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

//        echo "<pre>";
//        print_r($verkaufsentwicklungData);
//        print_r($verkaufsentwicklungDataProProjekt);


//        $einheitstypModel = new Einheitstyp();
//        $projektModel     = new Projekt();

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

        return $this->render('projectDashboard', array(
            "projectDashboardData" => $projectDashboardData,
            "verkaufsentwicklungData" => $verkaufsentwicklungData,
            "verkaufsentwicklungDataProProjekt" => $verkaufsentwicklungDataProProjekt,
        ));
    }
}