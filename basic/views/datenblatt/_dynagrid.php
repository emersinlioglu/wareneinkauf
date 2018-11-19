<style>
    .kv-panel-before .pagination {
        margin: 0;
        float: left;
        margin-right: 20px;
    }
    /*.kv-grid-table tr > *:last-child {*/
        /*display: none;*/
    /*}*/
</style>

<?php

use app\models\Datenblatt;
use app\models\User;
use kartik\dynagrid\DynaGrid;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$gridColumns = [
    //['class' => 'yii\grid\SerialColumn'],
    ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
];

$gridColumns = array_merge($gridColumns, Datenblatt::getGridColumns($projekt->id, $dataProvider->getModels()));

$gridColumns[] = [
    'class' => 'kartik\grid\ActionColumn',
    //'contentOptions' => ['style' => 'width:200px;'],
    //'header'=>'Actions',
    'order'=>DynaGrid::ORDER_FIX_LEFT,
//    'pageSummary'=>'Seitensumme',
    'template' => '{view}{update}{report}{delete} ',
    'buttons' => [
        'view' => function ($url, $model) {

            if (User::hasPermission('read_datasheets')) {
                return Html::a('<span class="fa fa-search"></span> Anzeigen ', $url, [
                    'title' => Yii::t('app', 'View'),
                    'class'=>'btn btn-primary btn-xs',
                ]);
            } else {
                return '';
            }
        },
        'update' => function ($url, $model) {
            if (User::hasPermission('write_datasheets')) {
                return Html::a('<span class=" glyphicon glyphicon-pencil"></span> Bearbeiten', $url, [
                    'title' => Yii::t('app', 'Update'),
                    'class'=>'btn btn-primary btn-xs',
                ]);
            } else {
                return '';
            }
        },
        //print button
        'report' => function ($url, $model) {
            if (User::hasPermission('report')) {
                return Html::a('<span class="fa fa-print"></span> Drucken', $url, [
                    'title' => Yii::t('app', 'Report'),
                    'target' => '_blank',
                    'class'=>'btn btn-primary btn-xs',
                ]);
            } else {
                return '';
            }
        },
//        'delete' => function ($url, $model) {
//            if (User::hasPermission('write_datasheets')) {
//                return Html::a('<span class="glyphicon glyphicon-trash"></span> Löschen', $url, [
//                    'title' => Yii::t('app', 'Delete'),
//                    'class'=>'btn btn-primary btn-xs',
//                    'data-confirm'=>'Wollen Sie diesen Eintrag wirklich löschen?',
//                    'data-method'=>'post',
//                ]);
//            } else {
//                return '';
//            }
//        },
        'delete' => function ($url, $model, $key) {

            if (User::hasPermission('write_datasheets')) {

                /** @var $model \app\models\Datenblatt */
                /** @var $abschlag \app\models\Abschlag */
                $isDeletable =  true;
                foreach ($model->abschlags as $abschlag) {
                    if ($abschlag->kaufvertrag_angefordert != '') {
                        $isDeletable =  false;
                        break;
                    }
                }

                if (!$isDeletable) {

//                    $ids = array();
//                    foreach ($model->datenblatts as $datenblatt) {
//                        $ids[] = $datenblatt->id;
//                    }
//                    return '<a href="' . $url . '" class="not-deletable" data-datenblatts="'.implode(',', $ids).'">Delete</a>';
                    return Html::a('<span class="glyphicon glyphicon-trash"></span> Löschen', $url, [
                        'title' => Yii::t('app', 'Delete'),
                        'class'=>'btn btn-primary btn-xs not-deletable',
                    ]);

                } else {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span> Löschen', $url, [
                        'title' => Yii::t('app', 'Delete'),
                        'class'=>'btn btn-primary btn-xs',
                        'data-confirm'=>'Wollen Sie diesen Eintrag wirklich löschen?',
                        'data-method'=>'post',
                    ]);
                }
            }

        }

    ],
];

$gridColumns[] = [
    'class'=>'kartik\grid\CheckboxColumn',
    'order'=>DynaGrid::ORDER_FIX_LEFT
];

echo DynaGrid::widget([
    
    //'columns'=>$columns,
    'columns'=>$gridColumns,

    'storage'=>DynaGrid::TYPE_DB,
    'userSpecific'=>true,
    'enableMultiSort' => true,

    'options'=>[
        // !!!! WICHTIG !!!! a unique identifier is important
        'id' => 'dynagrid-datenblatt-' . $dynagridProfileId,
        'class' => User::hasPermission('export') ? '' : 'no-export'
        //'defaultPageSize' => 0,
    ],

    'gridOptions'=>[
        'floatHeader' => true,
        'showPageSummary'=>true,
        'floatHeaderOptions' => [
            'position' => 'absolute',
        ],
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'panel'=>[
            'heading'=>'<h3 class="panel-title">Datenblätter</h3>',
            'before' => '{dynagridSort} {dynagrid} '
                . '<a id="" class="btn btn-default serienbrief" title="Serienbrief"><i class="fa fa-share"></i> Serienbrief</a>'
                . '<a id="" data-bulk-edit-url="'.\yii\helpers\Url::to(['datenblatt/abschlag-massenbearbeitung', 'ids' => '']).'" 
                            data-single-edit-url="'.\yii\helpers\Url::to(['datenblatt/konfiguration', 'id' => '']).'"
                            class="btn btn-default abschlag-massenbearbeitung '. (User::hasRole('Sonderwunsch', false) ? 'hide' : '' ) .'" title="Abschlagkonfiguration">
                        <i class="fa fa-list"></i> Abschlagkonfiguration
                   </a>'
                . '<span id="" class="btn btn-default export-zaehler" title="Zählerangaben exportieren"
                        data-export-url="'.Url::to(['teileigentumseinheit/export-zaehler', 'datenblattIds' => '']).'"
                   >
                   Zählerangaben exportieren
               </span>',
        ],
        'toolbar' =>  [
            'before' => '{pager} {toggleData} {export}'
//            'before' => '{dynagridFilter} {dynagridSort} {dynagrid}'
//                . '<a id="" data-exportmiteuro-url="'.Url::to(['datenblatt/index', 'exportMitEuro' => $euroExport]).'"
//                        class="btn btn-default exportmiteuro" title="Export mit €"><i class="fa fa-share"></i> '.$buttonEuro.'</a>',
////            'before' => '<div class="pull-right">{pager}</div>',
        ],
        'autoXlFormat'=>true,
            'export'=>[
                'fontAwesome'=>true,
                'showConfirmAlert'=>false,
                'target'=>'_BLANK'
            ],
            /*
            'toolbar' =>  [
                [
                    'content'=> Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['datenblatt/index'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>'Zurücksetzen'])
                ],
                [
                    'content'=>'{dynagridFilter}{dynagridSort}{dynagrid}'
                ],
                '{export}',
            ]
            */
        ],

    ]
);

?>

<?php $form = ActiveForm::begin([
    'action' => ['abschlag/serienbrief'],
    'method' => 'post',
    'options' => array(
        'class' => 'datenblatt-selection-form hide',
    )
]); ?>
<?= Html::submitButton('submitSelection', ['name' => 'submitSelection', 'value' => 'selection']) ?>
<?php ActiveForm::end(); ?>

<?php $form = ActiveForm::begin([
    'action' => ['datenblatt/export'],
    'method' => 'post',
    'options' => [
        'class' => 'datenblatt-export',
        'target' => '_blank'
    ]
]); ?>
<?php
    if (isset($_GET['DatenblattSearch'])) {
        foreach ($_GET['DatenblattSearch'] as $field => $value) {
            echo Html::hiddenInput("DatenblattSearch[$field]", $value);
        }
    }

//    echo Html::dropDownList('fields[]', null, ArrayHelper::map($gridColumns, 'value', 'label'), [
//        'multiple'=>'multiple',
//    ]);
?>
<?php ActiveForm::end(); ?>

<!-- custom export -->
<?php
//echo $this->render('_custom_export', [
//    'gridColumns' => $gridColumns
//]);
?>

<?php
$this->registerJs(<<<JS
    $(function() {
        $('.serienbrief').click(function(e) {
            e.preventDefault();
            
            $('[name="selection[]"]:checked').each(function(i, elm) {
               
                var input = $('<input>')
                    .attr('type', 'hidden')
                    .attr('name', 'datenblatts[]')
                    .val(elm.value);
                   
                $('.datenblatt-selection-form').prepend(input);
            });

            $('.datenblatt-selection-form button').click();
        });
        
        $('.abschlag-massenbearbeitung').click(function(e) {
            e.preventDefault();
            
            var datenblattIds = $('[name="selection[]"]:checked');
            var ids = datenblattIds
                .map(function () {return this.value;})
                .get()
                .join(",");
     
            if (ids) {
                if (ids.indexOf(',') > -1) {
                   // bulk-edit                
                    window.location = $(this).attr('data-bulk-edit-url') + ids;
                } else {
                   // single-edit                
                    window.location = $(this).attr('data-single-edit-url') + ids;     
                }
            } else {
                alert('Bitte wählen Sie erst Datenblätter aus!');
            }
            
        })
        
        $('.export-zaehler').click(function(e) {
            e.preventDefault();
            var datenblattIds = $('[name="selection[]"]:checked');
            var ids = datenblattIds
                .map(function () {return this.value;})
                .get()
                .join(",");
     
            if (ids) {
                var url = $(this).attr('data-export-url') + ids;
                var win = window.open(url, '_blank');
                win.focus();
            } else {
                alert('Bitte wählen Sie mindestens ein Datenblatt aus!');
            }
            
        });
        
        $('.exportmiteuro').click(function(e) {
            e.preventDefault();
            window.location = $(this).attr('data-exportmiteuro-url');            
        });

        $('.kv-grid-container').doubleScroll();
    });
JS
);
?>

<?php
$this->registerJs(
    "  
//        $(function() {
//            $('.kv-export-form').attr('action', '/index.php?r=datenblatt/export');
//        });
        
        $('.not-deletable').click(function(event) { 
            event.preventDefault();
            
//            $('.dyna-content').empty();
//            
//            var datenblattIds = $(this).attr('data-datenblatts');
//            datenblattIds.split(',').forEach(function(entry) {
//                
//                var link = $('<a>')
//                    .attr('href', 'index.php?r=datenblatt/view&id=' + entry)
//                    .text('Datenblatt ' + entry);
//                
//                link.appendTo($('.dyna-content'));
//                $('<br>').appendTo($('.dyna-content'));
//            });
            
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
                <p>Das Datenblatt kann nicht gelöscht werden.</p>
                <div class="dyna-content">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
            </div>
        </div>

    </div>
</div>
