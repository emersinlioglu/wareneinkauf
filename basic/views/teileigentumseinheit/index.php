<?php

use kartik\money\MaskMoney;
use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\User;
use app\models\Haus;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TeileigentumseinheitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Teileigentumseinheits';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .teileigentumseinheit-index .datenblatt-link {
        white-space: nowrap;
    }
</style>

<div class="teileigentumseinheit-index">

    <?php if (User::hasPermission('write_ownership')): ?>
        <p>
            <?= Html::a('Importieren', ['teileigentumseinheit/import'], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php endif; ?>

<!--    <pre>-->
<!--    --><?php //var_dump($searchModel) ?>

    <div class="panel panel-default">
        <div class="panel-body">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'projekt_name',
                        'value' => 'projekt.name',
                        'label' => 'Projekt'
                    ],
                    [
                        'attribute' => 'firma_name',
                        'value' => 'projekt.firma.name',
                        'label' => 'Firma'
                    ],
                    [
                        'attribute' => 'firma_nr',
                        'value' => 'projekt.firma.nr',
                        'label' => 'Firmen Nr.'
                    ],
                    [
                        'attribute' => 'status',
                        'value' => 'status',
                        'filter' => Html::activeDropDownList(
                            $searchModel,
                            'status',
                            \app\models\Teileigentumseinheit::statusOptions(),
                            ['class'=>'Alle','prompt' => '']
                        ),
                        'label' => 'Status'
                    ],
//                    [
//                        'attribute' => 'haus_status',
//                        'value' => 'haus.status',
//                        'filter' => Html::activeDropDownList(
//                            $searchModel,
//                            'haus_status',
//                            Haus::statusOptions(),
//                            ['class'=>'Alle','prompt' => '']
//                        ),
//                        'label' => 'Status'
//                    ],
                    'te_nummer',
                    [
                        'class' => 'kartik\grid\BooleanColumn',
                        'attribute' => 'rechnung_vertrieb',
                        'vAlign' => 'middle',
                        'trueLabel' => 'Ja',
                        'falseLabel' => 'Nein',
                        'label' => 'R.Vetrieb',
                        // 'filterType'=>GridView::FILTER_CHECKBOX,
                    ],
                    [
                        'class' => 'kartik\grid\BooleanColumn',
                        'attribute' => 'gefoerdert',
                        'vAlign' => 'middle',
                        'trueLabel' => 'Ja',
                        'falseLabel' => 'Nein',
                         //'filterType'=> GridView::FILTER_,
                    ],

                    'einheitstyp_id',

                     'geschoss',
                     'zimmer',
                     [
                         'attribute' => 'me_anteil',
                         'format' => ['decimal', 2],
                         'contentOptions' => ['class' => 'text-right'],
                     ],
                     [
                         'attribute' => 'wohnflaeche',
                         'format' => ['decimal', 2],
                         'contentOptions' => ['class' => 'text-right'],
                     ],
                     'kaufpreis:currency',
                     'kp_einheit:currency',

                    [
                        'label' => 'Datenblatt',
                        'format' => 'raw',
                        'value' => function ($model, $key, $index, $widget) {
                            $link = '';
                            if ($model->haus && count($model->haus->datenblatts) > 0) {
                                $url = \yii\helpers\Url::to(['datenblatt/update', 'id' => $model->haus->datenblatts[0]->id]);
                                $link = Html::a('> Datenblatt', $url, ['target' => '_blank', 'class' => 'datenblatt-link']);
                            }

                            return $link;
                        },
                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'buttons' => [
                            'update' => function ($url, $model, $key) {
                                return User::hasPermission('write_ownership') ? Html::a('Update', $url) : '';
                            },
                            'delete' => function ($url, $model, $key) {

                                if (User::hasPermission('write_ownership')) {
                                    /** @var $model \app\models\Haus */
                                    $haus = $model->haus;
                                    if ($haus && count($haus->datenblatts) > 0) {

                                        $ids = array();
                                        foreach ($haus->datenblatts as $datenblatt) {
                                            $ids[] = $datenblatt->id;
                                        }
                                        return '<a href="' . $url . '" class="not-deletable" data-datenblatts="'.implode(',', $ids).'">Delete</a>';
                                    } else {
                                        return Html::a('Delete', $url, [
                                            'data' => [
                                                'confirm' => 'Sind Sie sich sicher?',
                                                'method' => 'post',
                                            ],
                                        ]);
                                    }
                                }

                            }
                        ]
                    ],
                ],
            ]); ?>

        </div>
    </div>
</div>

<?php
$this->registerJs(
    "   
        $('.not-deletable').click(function(event) { 
            event.preventDefault();
            
            $('.dyna-content').empty();
            
            var datenblattIds = $(this).attr('data-datenblatts');
            datenblattIds.split(',').forEach(function(entry) {
                
                var link = $('<a>')
                    .attr('href', 'index.php?r=datenblatt/view&id=' + entry)
                    .text('Datenblatt ' + entry);
                
                link.appendTo($('.dyna-content'));
                $('<br>').appendTo($('.dyna-content'));
            });
            
            $('#myModal').modal();
            
        });
    ",
    \yii\web\View::POS_READY,
    'my-button-handler'
);
?>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">&nbsp;</h4>
            </div>
            <div class="modal-body">
                <p>Die Teileigentumseinheit kann nicht gelöscht werden.</p>
                <div class="dyna-content">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
            </div>
        </div>

    </div>
</div>
