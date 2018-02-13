<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \kartik\dynagrid\DynaGrid;
use app\models\User;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TeileigentumseinheitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Forecast';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teileigentumseinheit-index">

    <style>
        #ForecastSearch-container tfoot {
            text-align: right;
        }
    </style>
    <div class="panel panel-default">
        <div class="panel-body">

            <?php

            $columns = [
                ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT, 'pageSummary'=>'Summe',],
                'hausnr',
                [
                    'attribute' => 'einheitstyp_id',
                    'value' => 'einheitstyp.name',
                    'label' => 'Einheitstyp',
                    'filter' => \yii\helpers\ArrayHelper::map(\app\models\Einheitstyp::find()->all(), 'id', 'name'),

                ],
                'te_nummer',
                [
                    'class'=>'kartik\grid\BooleanColumn',
                    'attribute'=>'gefoerdert',
                    'value'=>'gefoerdert',
                    'label' => 'Gefördert',
                ],
                [
                    'attribute' => 'geschoss',
                    'width'=>'50px',
                ],
                [
                    'attribute' => 'zimmer',
                    'width'=>'50px',
                ],
                [
                    'attribute' => 'me_anteil',
                    'contentOptions' => ['class' => 'text-right'],
        //                'format'=>['decimal',2]
                ],
                [
                    'attribute' => 'wohnflaeche',
                    'format'=>['decimal',2],
                    'contentOptions' => ['class' => 'text-right'],
                ],
                [
                    'attribute' => 'kaufpreis',
                    'pageSummary'=>true,
                    'format'=>['decimal',2],
                    'contentOptions' => ['class' => 'text-right'],
                ],
                [
                    'attribute' => 'kp_einheit',
                    'format'=>['decimal',2],
                    'contentOptions' => ['class' => 'text-right'],
                ],
                [
                    'attribute' => 'forecast_preis',
                    'pageSummary'=>true,
                    'format'=>['decimal',2],
                    'contentOptions' => ['class' => 'text-right'],
                ],
                [
                    'attribute' => 'verkaufspreis',
                    'pageSummary'=>true,
                    'format'=>['decimal',2],
                    'contentOptions' => ['class' => 'text-right'],
                ],
                [
                    'attribute' => 'verkaufspreis_begruendung',
                    'width'=>'250px',
                ],
            ];

            echo DynaGrid::widget([
                'columns' => $columns,
        //            'storage' => DynaGrid::TYPE_DB,
        //            'userSpecific' => true,
        //            'enableMultiSort' => true,

                'gridOptions' => [
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'id' => 'ForecastSearch',
                    'showPageSummary'=>true,
                    'panel' => [
                        'heading' => '<h3 class="panel-title">Forecast</h3>',
                        'before' => '{dynagridFilter} {dynagridSort} {dynagrid}',
                    ],
                    'toolbar' => [
                        'before' => '{pager} {toggleData} {export}'
                    ],
                    'autoXlFormat' => true,
                    'export' => [
                        'fontAwesome' => true,
                        'showConfirmAlert' => false,
                        'target' => '_BLANK'
                    ],
                ],
                'options' => [
                    'id' => 'dynagrid-forecast',
                    'class' => User::hasPermission('export') ? '' : 'no-export'
                ]
            ]);
            ?>

        </div>
    </div>
</div>
