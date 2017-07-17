<style>
    .projects thead tr th {
        text-align: center;
    }
    /*.projects table thead tr th,*/
    /*.projects table tbody tr td {*/
        /*text-align: right;*/
    /*}*/

    .projects tbody tr td:not(:first-child) {
        text-align: right;
        white-space: nowrap;
    }
</style>

<?php
use miloschuman\highcharts\Highcharts;
use app\models\ProjektSearch;
use \app\models\Einheitstyp;

echo Highcharts::widget([
    'options' => [
        'title' => ['text' => 'Verkaufsentwicklung'],
//                'xAxis' => [
//                    'categories' => ['Apples', 'Bananas', 'Oranges']
//                ],
//                'yAxis' => [
//                    'title' => ['text' => 'Fruit eaten']
//                ],
//                'series' => [
//                    ['name' => 'Jane', 'data' => [1, 0, 4]],
//                    ['name' => 'John', 'data' => [5, 7, 3]]
//                ]
        'chart'=> [
            'plotBackgroundColor'=> null,
            'plotBorderWidth'=> null,
            'plotShadow'=> false,
            'type'=> 'pie'
        ],
        'tooltip'=> [
            'pointFormat'=> '{series.name}: <b>{point.percentage:.0f}%</b>'
        ],
        'plotOptions'=> [
            'pie'=> [
                'allowPointSelect'=> true,
                'cursor'=> 'pointer',
                'dataLabels'=> [
                    'enabled'=> true,
                    'format'=> '<b>{point.name}</b>: {point.y:.2f} m²',
                    'style'=> [
                        'color'=> "(Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'"
                    ],
                    'connectorColor'=> 'silver'
                ]
            ]
        ],
        'series'=> [
            [
                'name'=> 'Einheiten',
                'data'=> $verkaufsentwicklungDataProProjekt,
                'size'=> '75%',
                'innerSize'=> '50%',
                'dataLabels'=> [
                    'formatter'=> "function () {
                                // display only if larger than 1
                                return this.y > 1 ? '<b>' + this.point.name + ':</b> ' + this.y + '%' : null;
                            }"
                ]
            ],
            [
                'name'=> 'Projekte',
                'data'=> $verkaufsentwicklungData,
                'size'=> '50%',
                'dataLabels'=> [
                    'formatter'=> 'function () {
                                return this.y > 5 ? this.point.name : null;
                            }',
                    'color'=> '#ffffff',
                    'distance'=> -30
                ]
            ],

        ]
    ]
]);
?>


<div class="panel box box-primary">
    <div class="box-header with-border">
        <h4 class="box-title">
            <a data-toggle="collapse" data-parent="#collapse-sonderwunsch" href="#collapse-sonderwunsch"
               aria-expanded="true" class="">
                Verkaufsentwicklung:
            </a>
        </h4>
    </div>
    <div id="collapse-sonderwunsch" class="panel-collapse collapse in" aria-expanded="false">
        <div class="box-body" style="overflow-x: auto">

            <table class="table table-bordered projects">
                <thead>
                    <tr>
                        <th></th>
                        <th>Fläche/Plätze</th>
                        <th colspan="2">Verkaufspreis</th>
                        <th>Einheiten/Soll</th>
                        <th>Einheiten/Ist</th>
                        <th>Status Einheiten frei</th>
                        <th>Status Einheiten in %</th>
                        <th>Status € in %</th>
                        <th>Status €</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($projectDashboardData as $data): ?>
                    <tr style="background-color: #cecece; font-weight: bold">
                        <td><?= $data['name'] ?></td>
                        <td>
<!--                            --><?php //echo Yii::$app->formatter->format($data['wohnflaechensumme'], ['decimal', 2]) ?><!-- m²-->
                        </td>
                        <td>
<!--                            --><?php //echo Yii::$app->formatter->format($data['durchschnittlicherPreisProQuadradmeter'], ['decimal', 2]) ?><!-- €/m²-->
                        </td>
                        <td><?= Yii::$app->formatter->format($data['verkuafspreissumme'], ['decimal', 2]) ?> €</td>

                        <td><?= Yii::$app->formatter->format($data['einheitenGesamt'], ['decimal', 0]) ?></td>
                        <td><?= number_format($data['einheitenVerkauftStück'], 0) ?></td>

                        <td><?= number_format($data['einheitenFreiStück'], 0) ?></td>
                        <td><?= number_format($data['einheitenVerkauftProzent'], 2) ?> %</td>

                        <td><?= number_format($data['betragInProzentAngefordert'], 2) ?> %</td>
                        <td><?= Yii::$app->formatter->format((float)$data['betragInEuroAngefordert'], ['decimal', 2]) ?> €</td>

                    </tr>

                    <?php foreach(Einheitstyp::find()->all() as $einheitstyp):

                            $einheitstypData = ProjektSearch::getInfoForEinheitstyp(
                                $data['projektId'],
                                $einheitstyp->id
                            );

                            if(!is_array($einheitstypData)) continue;
                        ?>
                        <tr>
                            <td><?= $einheitstyp->name ?></td>
                            <?php
                                $decimal = in_array($einheitstyp->einheit,  ['Stück', 'Stck.']) ? 0 : 2;
                            ?>
                            <td><?= Yii::$app->formatter->format((float)$einheitstypData['wohnflaechensumme'], ['decimal', $decimal]) ?> <?= $einheitstyp->einheit ?></td>
                            <td><?= Yii::$app->formatter->format((float)$einheitstypData['durchschnittlicherPreisProQuadradmeter'], ['decimal', 2]) ?> €/<?= $einheitstyp->einheit ?></td>
                            <td><?= Yii::$app->formatter->format((float)$einheitstypData['verkuafspreissumme'], ['decimal', 2]) ?> €</td>

                            <td><?= Yii::$app->formatter->format($einheitstypData['einheitenGesamt'], ['decimal', 0]) ?></td>
                            <td><?= number_format($einheitstypData['einheitenVerkauftStück'], 0) ?></td>

                            <td><?= number_format($einheitstypData['einheitenFreiStück'], 0) ?></td>
                            <td><?= number_format($einheitstypData['einheitenVerkauftProzent'], 2) ?> %</td>

                            <td><?php echo number_format($einheitstypData['betragInProzentAngefordert'], 2) ?> %</td>
                            <td><?php echo Yii::$app->formatter->format((float)$einheitstypData['betragInEuroAngefordert'], ['decimal', 2]) ?> €</td>
                        </tr>
                    <?php endforeach; ?>

                <?php endforeach; ?>
                </tbody>
            </table>

        </div>

    </div>
</div>


<!--<div class="panel box box-primary">-->
<!--    <div class="box-header with-border">-->
<!--        <h4 class="box-title">-->
<!--            <a data-toggle="collapse" data-parent="#collapse-sonderwunsch" href="#collapse-sonderwunsch"-->
<!--               aria-expanded="true" class="">-->
<!--                Verkaufsentwicklung:-->
<!--            </a>-->
<!--        </h4>-->
<!--    </div>-->
<!--    <div id="collapse-sonderwunsch" class="panel-collapse collapse in" aria-expanded="false">-->
<!--        <div class="box-body" style="overflow-x: auto">-->
<!---->
<!--            <table class="table table-bordered projects">-->
<!--                <thead>-->
<!--                <tr>-->
<!--                    <th></th>-->
<!--                    <th></th>-->
<!--                    <th colspan="2">Verkaufspreis</th>-->
<!--                    <th></th>-->
<!--                    <th colspan="4">Einheiten Frei</th>-->
<!--                    <th colspan="4">Einheiten Reserviert</th>-->
<!--                    <th colspan="4">Einheiten Verkauft</th>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th>Projektname</th>-->
<!--                    <th>Fläche/Plätze Summe</th>-->
<!--                    <th>Durchschnittlicher Preis pro m2</th>-->
<!--                    <th>Summe</th>-->
<!--                    <th>Einheiten Gesamt</th>-->
<!--                    <th>X Stück</th>-->
<!--                    <th>Flächensumme</th>-->
<!--                    <th>in %</th>-->
<!--                    <th>Preis €</th>-->
<!--                    <th>X Stück</th>-->
<!--                    <th>Flächensumme</th>-->
<!--                    <th>in %</th>-->
<!--                    <th>Preis €</th>-->
<!--                    <th>X Stück</th>-->
<!--                    <th>Flächensumme</th>-->
<!--                    <th>in %</th>-->
<!--                    <th>Preis €</th>-->
<!--                </tr>-->
<!--                </thead>-->
<!--                <tbody>-->
<!--                --><?php //foreach ($projectDashboardData as $data): ?>
<!--                    <tr>-->
<!--                        <td>--><?php // echo $data['name'] ?><!--</td>-->
<!--                        <td>--><?php // echo Yii::$app->formatter->format($data['wohnflaechensumme'], ['decimal', 2]) ?><!-- m²</td>-->
<!--                        <td>--><?php // echo Yii::$app->formatter->format($data['durchschnittlicherPreisProQuadradmeter'], ['decimal', 2]) ?><!-- €</td>-->
<!--                        <td>--><?php // echo Yii::$app->formatter->format($data['verkuafspreissumme'], ['decimal', 2]) ?><!-- €</td>-->
<!--                        <td>--><?php // echo Yii::$app->formatter->format($data['einheitenGesamt'], ['decimal', 2]) ?><!--</td>-->
<!---->
<!--                        <td>--><?php // echo number_format($data['einheitenFreiStück'], 0) ?><!--</td>-->
<!--                        <td>--><?php // echo number_format($data['wohnflaechensummeFrei'], 2) ?><!--</td>-->
<!--                        <td>--><?php // echo number_format($data['einheitenFreiProzent'], 2) ?><!-- %</td>-->
<!--                        <td>--><?php // echo number_format($data['einheitenFreiPreisSumme'], 2) ?><!-- €</td>-->
<!---->
<!--                        <td>--><?php // echo number_format($data['einheitenReserviertStück'], 0) ?><!--</td>-->
<!--                        <td>--><?php // echo number_format($data['wohnflaechensummeReserviert'], 0) ?><!--</td>-->
<!--                        <td>--><?php // echo number_format($data['einheitenReserviertProzent'], 2) ?><!--%</td>-->
<!--                        <td>--><?php // echo number_format($data['einheitenReserviertPreisSumme'], 2) ?><!-- €</td>-->
<!---->
<!--                        <td>--><?php // echo number_format($data['einheitenVerkauftStück'], 0) ?><!--</td>-->
<!--                        <td>--><?php // echo number_format($data['wohnflaechensummeVerkauft'], 0) ?><!--</td>-->
<!--                        <td>--><?php // echo number_format($data['einheitenVerkauftProzent'], 2) ?><!--%</td>-->
<!--                        <td>--><?php // echo number_format($data['einheitenVerkauftPreisSumme'], 2) ?><!-- €</td>-->
<!--                    </tr>-->
<!--                --><?php //endforeach; ?>
<!--                </tbody>-->
<!--            </table>-->
<!---->
<!--        </div>-->
<!---->
<!--    </div>-->
<!--</div>-->