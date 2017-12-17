<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use webvimark\modules\UserManagement\models\User;
use \app\models\Haus;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HausSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Teileigentumseinheiten';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="haus-index">

    <?php if (User::hasPermission('write_ownership')): ?>
        <p>
            <?= Html::a('Erstellen', ['create'], ['class' => 'btn btn-success']) ?>
<!--            --><?php //echo Html::a('Importieren', ['teileigentumseinheit/import'], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php endif; ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    //'projekt_id',

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
                        'attribute' => 'projekt_name',
                        'value' => 'projekt.name',
                        'label' => 'Projekt'
                    ],
                    [
                        'attribute' => 'status',
                        'filter' => Html::activeDropDownList(
                            $searchModel,
                            'status',
                            Haus::statusOptions(),
                            ['class'=>'form-control','prompt' => '']
                        ),
                    ],
        //            [
        //                'class' => 'kartik\grid\BooleanColumn',
        //                'attribute' => 'verkauft',
        //                'vAlign' => 'middle',
        //                'trueLabel' => 'Ja',
        //                'falseLabel' => 'Nein',
        //
        //                // 'filterType'=>GridView::FILTER_CHECKBOX,
        //            ],
                    // 'rechnung_vertrieb',
                    [
                        'class' => 'kartik\grid\BooleanColumn',
                        'attribute' => 'rechnung_vertrieb',
                        'vAlign' => 'middle',
                        'trueLabel' => 'Ja',
                        'falseLabel' => 'Nein',
                        'label' => 'R.Vetrieb',
                        // 'filterType'=>GridView::FILTER_CHECKBOX,
                    ],
                    'strasse',
                    'plz',
                    'ort',
                    [
                        //'filter' => Html::activeTextField($model, 'te_nummer'),
                        'format' => 'html',
                        'attribute' => 'te_nummer',
                        'value' => 'tenummerHtml',
                        'label' => 'TE-Nr',
                    ],

                    [
                        'label' => 'Datenblatt',
                        'format' => 'raw',
                        'value' => function ($model, $key, $index, $widget) {
                            $link = '';
                            if (count($model->datenblatts) > 0) {
                                $url = \yii\helpers\Url::to(['datenblatt/update', 'id' => $model->datenblatts[0]->id]);
                                $link = Html::a('> Datenblatt', $url);
                            }

                            return $link;
                        },
                    ],


                    // 'hausnr',


                    [
                        'class' => 'yii\grid\ActionColumn',
                        'buttons' => [
                            'update' => function ($url, $model, $key) {
                                return User::hasPermission('write_ownership') ? Html::a('Update', $url) : '';
                            },
                            'delete' => function ($url, $model, $key) {

                                if (User::hasPermission('write_ownership')) {
                                    /** @var $model \app\models\Haus */
                                    if (count($model->datenblatts) > 0) {

                                        $ids = array();
                                        foreach ($model->datenblatts as $datenblatt) {
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

<!-- Trigger the modal with a button -->
<!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

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