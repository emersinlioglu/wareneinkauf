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

use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use webvimark\modules\UserManagement\models\User;
use kartik\dynagrid\Module;
use yii\widgets\ActiveForm;


$gridColumns = [
    //['class' => 'yii\grid\SerialColumn'],
    ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],

    /*
    [
        'attribute' => 'projekt_name',
        'value'=>'projekt.name',
        'label' => 'Projekt'
    ],
    [
        'attribute' => 'firma_nr',
        'value'=>'firma.nr',
        'label' => 'Firmen Nr.'
    ],

    [
        //'attribute' => 'haus_strasse',
        'value'=>'haus.strasse',
        'label' => 'Straße'
    ],
    [
        //'attribute' => 'haus_hausnr',
        'value'=>'haus.hausnr',
        'label' => 'Haus Nr.'
    ],

    [
        //'attribute' => 'haus_plz',
        'value'=>'haus.plz',
        'label' => 'Plz'
    ],
    [
        //'attribute' => 'haus_ort',
        'value'=>'haus.ort',
        'label' => 'Ort'
    ],

    */

    [
        'attribute' => 'abschlagKaufvertragSumme',
        'label' => 'Gesamtsumme (Wohnung + Sondereigentum)',
        'format' => ['currency'],
    ],
    [
        'value' => 'schlussrechnung',
        'label' => 'Schlussrechnung',
        'format' => ['currency'],
    ],
    [
        'attribute' => 'firma_name',
        'value'=>'firma.name',
        'label' => 'Firma'
    ],
    [
        'attribute' => 'firma_nr',
        'value'=>'firma.nr',
        'label' => 'Buchungskr.'
    ],
    [
        'attribute' => 'projekt_name',
        'value'=>'projekt.name',
        'label' => 'Projekt',
        'filter' => false
    ],
    [
        'attribute' => 'haus_strasse',
        'value'=>'haus.strasse',
        'label' => 'Straße'
    ],
     [
        'attribute' => 'haus_hausnr',
        'value'=>'haus.hausnr',
        'label' => 'Haus Nr.'
    ],
     [
        'attribute' => 'haus_plz',
        'value'=>'haus.plz',
        'label' => 'Plz'
    ],
    [
        'attribute' => 'haus_ort',
        'value'=>'haus.ort',
        'label' => 'Ort'
    ],
    [
        'attribute' => 'sap_debitor_nr',
        'value'=>'sap_debitor_nr',
        'label' => 'SAP Debitoren Nr.'
    ],
    [
        'attribute' => 'intern_debitor_nr',
        'value'=>'intern_debitor_nr',
        'label' => 'Interne Debitoren Nr.'
    ],

//    [
//        'attribute' => 'kaeufer_vorname',
//        'value'=>'kaeufer.vorname',
//        'label' => 'Käufer Vorname'
//    ],
//
//    [
//        'attribute' => 'kaeufer_nachname',
//        'value'=>'kaeufer.nachname',
//        'label' => 'Käufer Name'
//    ],
    [
        'attribute' => 'kaeufer_email',
        'value'=>'kaeufer.email',
        'label' => 'Käufer-Email'
    ],
    [
        'attribute' => 'kaeufer_festnetz',
        'value'=>'kaeufer.festnetz',
        'label' => 'Käufer-Festnetznummer'
    ],
    [
        'attribute' => 'kaeufer_handy',
        'value'=>'kaeufer.handy',
        'label' => 'Käufer-Handynummer'
    ],
    [
        'value'=>'kaeufer.anrede2Label',
        //'value'=> '$data->anrede == 1 ? "Herr" : "Frau"',
        'label' => '2. Käufer Anrede'
    ],
    [
        'attribute' => 'kaeufer_vorname2',
        'value'=>'kaeufer.vorname2',
        'label' => '2. Käufer Vorname'
    ],
    [
        'attribute' => 'kaeufer_titel2',
        'value'=>'kaeufer.titel2',
        'label' => '2. Käufer Titel'
    ],
    [
        'attribute' => 'kaeufer_nachname2',
        'value'=>'kaeufer.nachname2',
        'label' => '2. Käufer Name'
    ],
    [
        //'filter' => Html::activeTextField($model, 'te_nummer'),
        'format' => 'html',
        'attribute' => 'te_nummer',
        'value' => 'tenummerHtml',
        'label' => 'TE-Nr'
    ],

];

for ($i = 0; $i < $maxCountTEEinheits; $i++) {
    $cnt = $i + 1;
    $gridColumns[] = [
        'value'=> "teeinheit__{$i}__te_name",
        'label' => "{$cnt}. TE-Name"
    ];
    $gridColumns[] = [
        'value'=> "teeinheit__{$i}__te_nummer",
        'label' => "{$cnt}. TE-Nummer"
    ];
    $gridColumns[] = [
        'value'=> "teeinheit__{$i}__gefoerdert",
        'label' => "{$cnt}. TE-Gefoerdert",
        'filter' => array(0 => Yii::t('app', 'No'), 1 => Yii::t('app', 'Yes')),
    ];
    $gridColumns[] = [
        'value'=> "teeinheit__{$i}__geschoss",
        'label' => "{$cnt}. TE-Geschoss"
    ];
    $gridColumns[] = [
        'value'=> "teeinheit__{$i}__zimmer",
        'label' => "{$cnt}. TE-Geschoss"
    ];
    $gridColumns[] = [
        'value'=> "teeinheit__{$i}__me_anteil",
        'label' => "{$cnt}. TE-ME-Anteil"
    ];
    $gridColumns[] = [
        'value'=> "teeinheit__{$i}__wohnflaeche",
        'label' => "{$cnt}. TE-Wohnfläche"
    ];
    $gridColumns[] = [
        'value'=> "teeinheit__{$i}__kaufpreis",
        'label' => "{$cnt}. TE-Kaufpreis"
    ];
}

// Kaeufer Daten
$gridColumns = array_merge($gridColumns, [
    [
        'value'=>'kaeufer.anredeLabel',
        //'value'=> '$data->anrede == 1 ? "Herr" : "Frau"',
        'label' => 'Käufer Anrede'
    ],
    [
        'attribute' => 'kaeufer_titel',
        'value'=>'kaeufer.titel',
        'label' => 'Käufer Titel'
    ],
    [
        'attribute' => 'kaeufer_vorname',
        'value'=>'kaeufer.vorname',
        'label' => 'Käufer Vorname'
    ],
    [
        'attribute' => 'kaeufer_nachname',
        'value'=>'kaeufer.nachname',
        'label' => 'Käufer Name'
    ],
    [
        'value'=>'beurkundungAmLabel',
        'label' => 'Beurkundung am:'
    ],
    [
        'value'=>'uebergangBnlLabel',
        'label' => '-Übergang BNL'
    ],
    [
        'value'=>'abnahmeSeLabel',
        'label' => '-Abnahme SE'
    ],
    [
        'value'=>'abnahmeGeLabel',
        'label' => '-Abnahme GE'
    ],
    [
        'value'=>'kaeufer.strasse',
        'label' => 'Straße'
    ],
    [
        'value'=>'kaeufer.hausnr',
        'label' => 'Hausnr.'
    ],
    [
        'value'=>'kaeufer.plz',
        'label' => 'PLZ'
    ],
    [
        'value'=>'kaeufer.ort',
        'label' => 'Ort'
    ],
]);

for ($i = 0; $i < $maxCountSonderwunsches; $i++) {
    $cnt = $i + 1;
    $gridColumns[] = [
        'value'=> "sonderwunsch__{$i}__name",
        'label' => "{$cnt}. SW-Name"
    ];
    $gridColumns[] = [
        'value'=> "sonderwunsch__{$i}__rechnungsstellung_betrag",
        'label' => "{$cnt}. SW-Rechnungsstellungsbetrag"
    ];
    $gridColumns[] = [
        'value'=> "sonderwunsch__{$i}__rechnungsstellung_rg_nr",
        'label' => "{$cnt}. SW-Rechnungsstellung-Rg.-Nr."
    ];
}

for ($i = 0; $i < $maxCountAbschlags; $i++) {
    $cnt = $i + 1;
    $gridColumns[] = [
        'value'=> "abschlag__{$i}__name",
        'label' => "{$cnt}. Abschlag-Name"
    ];
    $gridColumns[] = [
        'value'=> "abschlag__{$i}__kaufvertrag_prozent",
        'label' => "{$cnt}. Abschlag-Prozent"
    ];
    $gridColumns[] = [
        'value'=> "abschlag__{$i}__kaufvertrag_betrag",
        'label' => "{$cnt}. Abschlag-Betrag"
    ];
    $gridColumns[] = [
        'value'=> "abschlag__{$i}__kaufvertrag_angefordert",
        'label' => "{$cnt}. Abschlag-Angefordert"
    ];
}

for ($i = 0; $i < $maxCountNachlasses; $i++) {
    $cnt = $i + 1;
    $gridColumns[] = [
        'value'=> "nachlass__{$i}__schreibenVomLabel",
        'label' => "{$cnt}. Nachlass-Schreiben vom:"
    ];
}

for ($i = 0; $i < $maxCountZinsverzugs; $i++) {
    $cnt = $i + 1;
    $gridColumns[] = [
        'value'=> "zinsverzug__{$i}__schreibenVomLabel",
        'label' => "{$cnt}. Zinsverzug-Schreiben vom:"
    ];
    $gridColumns[] = [
        'value'=> "zinsverzug__{$i}__betrag",
        'label' => "{$cnt}. Zinsverzug-Betrag:"
    ];
}

$gridColumns[] = [
    'value'=> "nachlassSumme",
    'label' => "Minderungen/Nachlaß-Summe:"
];
$gridColumns[] = [
    'value'=> "zinsverzugSumme",
    'label' => "Zinsverzugs-Summe:"
];

for ($i = 0; $i < $maxCountZahlungs; $i++) {
    $cnt = $i + 1;
    $gridColumns[] = [
        'value'=> "zahlung__{$i}__datumLabel",
        'label' => "{$cnt}. Zahlung-Datum:"
    ];
    $gridColumns[] = [
        'value'=> "zahlung__{$i}__betrag",
        'label' => "{$cnt}. Zahlung-betrag:"
    ];
}

$gridColumns[] = [
    'value'=> "zahlungSumme",
    'label' => "Zahlungen- bereits gezahlt:"
];

$gridColumns[] = [
    'value'=> "offenePosten",
    'label' => "Offene Posten:",
    'format' => ['currency'],
];

$gridColumns[] = [
    'class' => 'kartik\grid\ActionColumn',
    //'contentOptions' => ['style' => 'width:200px;'],
    //'header'=>'Actions',
    'order'=>DynaGrid::ORDER_FIX_LEFT,
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
                            class="btn btn-default abschlag-massenbearbeitung" title="Abschlagkonfiguration">
                        <i class="fa fa-list"></i> Abschlagkonfiguration
                   </a>',
        ],
        'toolbar' =>  [
            'before' => '{pager} {toggleData} {export}'
//            'before' => '{dynagridFilter} {dynagridSort} {dynagrid}'
//            . '<a id="" class="btn btn-default serienbrief" title="Serienbrief"><i class="fa fa-share"></i> Serienbrief</a>',
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
    });
JS
);
?>

<?php
$this->registerJs(
    "   
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
