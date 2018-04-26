<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use webvimark\modules\UserManagement\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KaeuferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Käufer';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kaeufer-index">

    <?php if (User::hasPermission('write_customer')): ?>
        <p>
            <?= Html::a('Käufer erstellen', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>


    <div class="panel panel-default">
        <div class="panel-body">

            <?php if (User::hasPermission('export')): ?>
                <div class="col-md-4 col-sm-6 col-xs-12" style="float: none;">
                    <div class="info-box">

                        <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-number"><h4>Serienbrief Datenquelle Export</h4></span>


                            </br>
                            <?php

                                $gridColumns = [
                                    //['class' => 'yii\grid\SerialColumn'],
        //                            'debitor_nr',
                                    [
                                        'attribute' => 'anrede',
                                        'value' => 'anredeLabel',
                                    ],
                                    'titel',
                                    'vorname',
                                    'nachname',
                                    [
                                        'attribute' => 'anrede2',
                                        'value' => 'anrede2Label',
                                    ],
                                    'titel2',
                                    'vorname2',
                                    'nachname2',
                                    'strasse',
                                    'hausnr',
                                    'plz',
                                    'ort',
                                    'festnetz',
                                    'handy',
                                    'email:email',
                                    //'publish_date',
                                    //'status',
                                    //['class' => 'yii\grid\ActionColumn'],
                                ];

                                echo ExportMenu::widget([
                                    'dataProvider' => $dataProvider,
                                    'columns' => $gridColumns,
                                    //'fontAwesome' => true,
                                    'columnSelectorOptions' => [
                                        'label' => 'Felder auswählen.',
                                        //'class' => 'btn btn-success',
                                    ],
                                    'exportConfig' => [
                                        ExportMenu::FORMAT_HTML => false,
                                        ExportMenu::FORMAT_TEXT => false,
                                        ExportMenu::FORMAT_PDF => false
                                    ],
                                    'dropdownOptions' => [
                                        'label' => 'Export Typ auswählen',
                                        //	'class' => 'btn btn-success',
                                        //
                                    ],
                                ]);

                            ?>
                        </div>
                        <!-- /.info-box-content -->

                    </div>
                </div>

            <?php endif; ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    //'debitor_nr',
                    //'beurkundung_am',
                    //'verbindliche_fertigstellung',
                    //'uebergang_bnl',
                    // 'abnahme_se',
                    // 'abnahme_ge',
                    // 'auflassung',
                    // 'anrede',
                    [
                        'attribute' => 'anrede',
                        'value' => 'anredeLabel',
                        'filter' => array(0 => 'Herr', 1 => 'Frau'),
                    ],
                    'titel',
                    'vorname',
                    'nachname',
                    'strasse',
                    'hausnr',
                    'plz',
                    'ort',
                    'land',
                    // 'festnetz',
                    // 'handy',
                    'email:email',
                    [
                        'attribute' => 'anrede2',
                        'value' => 'anrede2Label',
                        'filter' => array( 0 => 'Herr', 1 => 'Frau'),
                    ],
                    'titel2',
                    'vorname2',
                    'nachname2',
//                    'zugeordneteProjektNamen',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'buttons' => [
                            'update' => function ($url, $model, $key) {
                                return User::hasPermission('write_customer') ? Html::a('Update', $url) : '';
                            },
                            'delete' => function ($url, $model, $key) {

                                if (User::hasPermission('write_customer')) {
                                    /** @var $model \app\models\Kaeufer */
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
                <p>Der Käufer kann nicht gelöscht werden.</p>
                <div class="dyna-content">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
            </div>
        </div>

    </div>
</div>