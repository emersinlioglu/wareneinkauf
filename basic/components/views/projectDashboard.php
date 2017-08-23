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
    .projects tbody tr.projekt {
        cursor: pointer;
    }

    .projects tr td:nth-child(2){
        border-right: 2px solid white;
    }
</style>

<div class="col-sm-6">
<?php
use miloschuman\highcharts\Highcharts;
use app\models\ProjektSearch;
use \app\models\Einheitstyp;

//echo Highcharts::widget([
//    'options' => [
//        'title' => ['text' => 'Verkaufsentwicklung (Stck.)'],
////                'xAxis' => [
////                    'categories' => ['Apples', 'Bananas', 'Oranges']
////                ],
////                'yAxis' => [
////                    'title' => ['text' => 'Fruit eaten']
////                ],
////                'series' => [
////                    ['name' => 'Jane', 'data' => [1, 0, 4]],
////                    ['name' => 'John', 'data' => [5, 7, 3]]
////                ]
//        'chart'=> [
//            'plotBackgroundColor'=> null,
//            'plotBorderWidth'=> null,
//            'plotShadow'=> false,
//            'type'=> 'pie'
//        ],
//        'tooltip'=> [
//            'pointFormat'=> '{series.name}: <b>{point.percentage:.0f}%</b>'
//        ],
//        'plotOptions'=> [
//            'pie'=> [
//                'allowPointSelect'=> true,
//                'cursor'=> 'pointer',
//                'dataLabels'=> [
//                    'enabled'=> true,
//                    'format'=> '<b>{point.name}</b>: {point.y:.0f}',
//                    'style'=> [
//                        'color'=> "(Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'"
//                    ],
//                    'connectorColor'=> 'silver'
//                ]
//            ]
//        ],
//        'series'=> [
//            [
//                'name'=> 'Status',
//                'data'=> $verkaufsentwicklungDataProProjektStatus,
//                'size'=> '100%',
//                'dataLabels'=> [
//                    'formatter'=> 'function () {
//                                return this.y > 5 ? this.point.name : null;
//                            }',
//                   'color'=> "(Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'",
//                    'distance'=> -60
//                ]
//            ],
//            [
//                'name'=> 'Einheiten',
//                'data'=> $verkaufsentwicklungDataProProjekt,
//                'size'=> '70%',
////                'innerSize'=> '0%',
//                'dataLabels'=> [
//                    'formatter'=> "function () {
//                                // display only if larger than 1
////                                return this.y > 1 ? '<b>' + this.point.name + ':</b> ' + this.y + 'Stck.' : null;
//                                return this.y > 1 ? '<b>' + this.point.name + ':</b> ' + this.y + '' : null;
//                            }",
//                    'color'=> "(Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'",
//                ]
//            ],
//            [
//                'name'=> 'Projekte',
//                'data'=> $verkaufsentwicklungData,
//                'size'=> '40%',
////                'innerSize'=> '50%',
//                'dataLabels'=> [
//                    'formatter'=> 'function () {
//                                return this.y > 5 ? this.point.name : null;
//                            }',
//                   'color'=> "(Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'",
//                    'distance'=> -30
//                ]
//            ],
//
//        ]
//    ]
//]);
?>
</div>

<div class="row">
<div class="col-sm-6">
<?php
//echo Highcharts::widget([
//    'options' => [
//        'title' => ['text' => 'Verkaufsentwicklung (in m²)'],
////                'xAxis' => [
////                    'categories' => ['Apples', 'Bananas', 'Oranges']
////                ],
////                'yAxis' => [
////                    'title' => ['text' => 'Fruit eaten']
////                ],
////                'series' => [
////                    ['name' => 'Jane', 'data' => [1, 0, 4]],
////                    ['name' => 'John', 'data' => [5, 7, 3]]
////                ],
//        'chart'=> [
//            'plotBackgroundColor'=> null,
//            'plotBorderWidth'=> null,
//            'plotShadow'=> false,
//            'type'=> 'pie',
//            'height'=> 500,
//        ],
//        'tooltip'=> [
//            'pointFormat'=> '{series.name}: <b>{point.percentage:.2f}%</b>'
//        ],
//        'plotOptions'=> [
//            'pie'=> [
//                
//                'size'=>700,
//                'allowPointSelect'=> true,
//                'cursor'=> 'pointer',
//                'dataLabels'=> [
//                    'enabled'=> true,
//                    'format'=> '<b>{point.name}</b>: {point.y:.2f}',
//                    'style'=> [
//                        'color'=> "(Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'"
//                    ],
//                    'connectorColor'=> 'silver'
//                ]
//            ]
//        ],
//        'series'=> [
//            [
//                'name'=> 'Status',
//                'data'=> $veDataProProjektStatus,
//                'size'=> '100%',
//                'dataLabels'=> [
//                    'formatter'=> 'function () {
//                        return this.y > 5 ? this.point.name : null;
//                    }',
//                    'color'=> "(Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'",
//                    'distance'=> -60
//                ]
//            ],
//            [
//                'name'=> 'Einheiten',
//                'data'=> $veDataProProjekt,
//                'size'=> '70%',
//                'dataLabels'=> [
//                    'formatter'=> "function () {
//                        // display only if larger than 1
//                        return this.y > 1 ? '<b>' + this.point.name + ':</b> ' + this.y + '' : null;
//                    }",
//                    'color'=> "(Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'",
//                ]
//            ],
//            [
//                'name'=> 'Projekte',
//                'data'=> $veData,
//                'size'=> '40%',
//                'dataLabels'=> [
//                    'formatter'=> 'function () {
//                        return this.y > 5 ? this.point.name : null;
//                    }',
//                    'color'=> "(Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'",
//                    'distance'=> -30
//                ]
//            ],
//
//        ]
//    ]
//]);
?>
</div>
</div>

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
                        <th bgcolor="#f2f2f2">Fläche/Plätze</th>
                        <th bgcolor="#f2f2f2" colspan="2">Verkaufspreis</th>
                        <th bgcolor="#d9d9d9">Einheiten/Soll</th>
                        <th bgcolor="#d9d9d9">Einheiten/Ist</th>
                        <th bgcolor="#c4d89b">Status Einheiten frei</th>
                        <th bgcolor="#c4d89b">Status Einheiten in %</th>
                        <th bgcolor="#ffff00">Status € in %</th>
                        <th bgcolor="#ffff00">Status €</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($projectDashboardData as $key => $data): ?>
                    <tr style="background-color: #cecece; font-weight: bold" key="<?= $key ?>" class="projekt">
                        <td>
                            <?= $data['name'] ?>
                            <?php echo \yii\helpers\Html::a(
                                '<span class="glyphicon glyphicon-download"></span>',
                                \yii\helpers\Url::to(['projekt/pdf', 'id' => $data['projektId']]),
                                ['target' => '_blank', 'class' => 'pull-right']
                            )
                            ?>
                        </td>
                        <td bgcolor="#f2f2f2">
<!--                            --><?php //echo Yii::$app->formatter->format($data['wohnflaechensumme'], ['decimal', 2]) ?><!-- m²-->
                        </td>
                        <td bgcolor="#f2f2f2">
<!--                            --><?php //echo Yii::$app->formatter->format($data['durchschnittlicherPreisProQuadradmeter'], ['decimal', 2]) ?><!-- €/m²-->
                        </td>
                        <td bgcolor="#f2f2f2"><?= Yii::$app->formatter->format($data['verkuafspreissumme'], ['decimal', 2]) ?> €</td>

                        <td bgcolor="#d9d9d9"><?= Yii::$app->formatter->format($data['einheitenGesamt'], ['decimal', 0]) ?></td>
                        <td bgcolor="#d9d9d9"><?= number_format($data['einheitenVerkauftStück'], 0) ?></td>

                        <td bgcolor="#c4d89b"><?= number_format($data['einheitenFreiStück'], 0) ?></td>
                        <td bgcolor="#c4d89b">
<!--                            --><?php //echo number_format($data['einheitenVerkauftProzent'], 2) ?><!-- %-->
                        </td>

                        <td bgcolor="#ffff00"><?= number_format($data['betragInProzentAngefordert'], 2) ?> %</td>
                        <td bgcolor="#ffff00"><?= Yii::$app->formatter->format((float)$data['betragInEuroAngefordert'], ['decimal', 2]) ?> €</td>

                    </tr>

                    <?php foreach(Einheitstyp::find()->all() as $einheitstyp):

                            $einheitstypData = ProjektSearch::getInfoForEinheitstyp(
                                $data['projektId'],
                                $einheitstyp->id
                            );

                            if(!is_array($einheitstypData)) continue;
                        ?>

                        <?php if((float)$einheitstypData['wohnflaechensumme'] + (float)$einheitstypData['verkuafspreissumme'] > 0): ?>
                            <tr class="einheitstypen hide">
                                <td>
                                    <?= $einheitstyp->name ?><br>
                                    -frei finanziert-
                                </td>
                                <?php
                                    $decimal = $einheitstyp->einheit == 'm2' ? 2 : 0;
                                ?>
                                <td bgcolor="#f2f2f2"><?= Yii::$app->formatter->format((float)$einheitstypData['wohnflaechensumme'], ['decimal', $decimal]) ?> <?= $einheitstyp->einheit ?></td>
                                <td bgcolor="#f2f2f2"><?= Yii::$app->formatter->format((float)$einheitstypData['durchschnittlicherPreisProQuadradmeter'], ['decimal', 2]) ?> €/<?= $einheitstyp->einheit ?></td>
                                <td bgcolor="#f2f2f2"><?= Yii::$app->formatter->format((float)$einheitstypData['verkuafspreissumme'], ['decimal', 2]) ?> €</td>

                                <td bgcolor="#d9d9d9"><?= Yii::$app->formatter->format($einheitstypData['einheitenGesamt'], ['decimal', 0]) ?></td>
                                <td bgcolor="#d9d9d9"><?= number_format($einheitstypData['einheitenVerkauftStück'], 0) ?></td>

                                <td bgcolor="#c4d89b"><?= number_format($einheitstypData['einheitenFreiStück'], 0) ?></td>
                                <td bgcolor="#c4d89b"><?= number_format($einheitstypData['einheitenVerkauftProzent'], 2) ?> %</td>

                                <td bgcolor="#ffff00"><?php echo number_format($einheitstypData['betragInProzentAngefordert'], 2) ?> %</td>
                                <td bgcolor="#ffff00"><?php echo Yii::$app->formatter->format((float)$einheitstypData['betragInEuroAngefordert'], ['decimal', 2]) ?> €</td>
                            </tr>
                        <?php endif; ?>

                        <?php if((float)$einheitstypData['wohnflaechensummeGefoerdert'] + (float)$einheitstypData['verkuafspreissummeGefoerdert'] > 0): ?>
                            <tr class="einheitstypen hide">
                                <td>
                                    <?= $einheitstyp->name ?><br>
                                    -gefördert-
                                </td>
                                <?php
                                    $decimal = $einheitstyp->einheit == 'm2' ? 2 : 0;
                                ?>
                                <td bgcolor="#f2f2f2"><?= Yii::$app->formatter->format((float)$einheitstypData['wohnflaechensummeGefoerdert'], ['decimal', $decimal]) ?> <?= $einheitstyp->einheit ?></td>
                                <td bgcolor="#f2f2f2"><?= Yii::$app->formatter->format((float)$einheitstypData['durchschnittlicherPreisProQuadradmeterGefoerdert'], ['decimal', 2]) ?> €/<?= $einheitstyp->einheit ?></td>
                                <td bgcolor="#f2f2f2"><?= Yii::$app->formatter->format((float)$einheitstypData['verkuafspreissummeGefoerdert'], ['decimal', 2]) ?> €</td>

                                <td bgcolor="#d9d9d9"><?= Yii::$app->formatter->format($einheitstypData['einheitenGesamtGefoerdert'], ['decimal', 0]) ?></td>
                                <td bgcolor="#d9d9d9"><?= number_format($einheitstypData['einheitenVerkauftStückGefoerdert'], 0) ?></td>

                                <td bgcolor="#c4d89b"><?= number_format($einheitstypData['einheitenFreiStückGefoerdert'], 0) ?></td>
                                <td bgcolor="#c4d89b"><?= number_format($einheitstypData['einheitenVerkauftProzentGefoerdert'], 2) ?> %</td>

                                <td bgcolor="#ffff00"><?php echo number_format($einheitstypData['betragInProzentAngefordertGefoerdert'], 2) ?> %</td>
                                <td bgcolor="#ffff00"><?php echo Yii::$app->formatter->format((float)$einheitstypData['betragInEuroAngefordertGefoerdert'], ['decimal', 2]) ?> €</td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>

                <?php endforeach; ?>
                </tbody>
            </table>

        </div>

    </div>
</div>

<?php
$this->registerJs('
    $(function(){
       $("table.projects tr.projekt").click(function() {
            var hasHideClass = $(this).next().hasClass("hide");
            
            var table = $(this).closest("table");
            table.find("tr.einheitstypen").addClass("hide");
            
            if (hasHideClass) {
                console.log("hat gallss");
                $(this).nextUntil(".projekt", "tr").removeClass("hide");
            } else {
                console.log("hat gein gallss");
                $(this).nextUntil(".projekt", "tr").addClass("hide");
            }
         });
    });
');
?>

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