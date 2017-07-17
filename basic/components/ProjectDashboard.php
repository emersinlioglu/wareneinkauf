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

        $veData = [];
        $veDataProProjekt = [];
        $veDataProProjektStatus = [];
        foreach ($projectDashboardData as $data) {

            $frei = $reserviert = $verkauft = .0;

            foreach (Einheitstyp::find()->all() as $einheitstyp) {

                $einheitstypData = ProjektSearch::getInfoForEinheitstyp(
                    $data['projektId'],
                    $einheitstyp->id
                );

                if ($einheitstyp->einheit == 'm2') {

                    if ($einheitstypData['wohnflaechensummeFrei'] > 0) {
                        $frei += (float)$einheitstypData['wohnflaechensummeFrei'];
                        $veDataProProjektStatus[] =
                        [
                            'name'      => 'Frei',
                            'y'         => (float)$einheitstypData['wohnflaechensummeFrei'],
                        ];
                    }
                    if ($einheitstypData['wohnflaechensummeReserviert'] > 0) {
                        $reserviert += (float)$einheitstypData['wohnflaechensummeReserviert'];
                        $veDataProProjektStatus[] =
                        [
                            'name'      => 'Reserviert',
                            'y'         => (float)$einheitstypData['wohnflaechensummeReserviert'],
                        ];
                    }
                    if ($einheitstypData['wohnflaechensummeVerkauft'] > 0) {
                        $verkauft += (float)$einheitstypData['wohnflaechensummeVerkauft'];
                        $veDataProProjektStatus[] =
                        [
                            'name'      => 'Verkauft',
                            'y'         => (float)$einheitstypData['wohnflaechensummeVerkauft'],
                        ];
                    }

                }

                // Diagramm 2
                if ($einheitstyp->einheit == 'm2') {
                    if ($frei > 0) {
                        $veDataProProjekt[] =
                            [
                                'name'      => $einheitstyp->name,
                                'y'         => (float)$frei,
                            ];
                    }
                    if ($reserviert > 0) {
                        $veDataProProjekt[] =
                            [
                                'name'      => $einheitstyp->name,
                                'y'         => (float)$reserviert,
                            ];
                    }
                    if ($verkauft > 0) {
                        $veDataProProjekt[] =
                            [
                                'name'      => $einheitstyp->name,
                                'y'         => (float)$verkauft,
                            ];
                    }
                }


                // Diagramm 1
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

            $proProjektFläche = ($frei + $reserviert + $verkauft);
            $veData[] =
                [
                    'name'      => $data['name'],
                    'y'         => (float)$proProjektFläche,
                ];

            $verkaufsentwicklungData[] = [
                'name'      => $data['name'],
                'y'         => (float)$data['einheitenGesamt'],
            ];

        }

        if (!\Yii::$app->user->isSuperadmin) {
            return '';
        }

        return $this->render('projectDashboard', array(
            "projectDashboardData" => $projectDashboardData,
            "verkaufsentwicklungData" => $verkaufsentwicklungData,
            "verkaufsentwicklungDataProProjekt" => $verkaufsentwicklungDataProProjekt,
            "verkaufsentwicklungDataProProjektStatus" => $verkaufsentwicklungDataProProjektStatus,

            "veData" => $veData,
            "veDataProProjekt" => $veDataProProjekt,
            "veDataProProjektStatus" => $veDataProProjektStatus,
        ));
    }
}