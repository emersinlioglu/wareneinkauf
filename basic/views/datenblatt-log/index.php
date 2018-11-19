<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DatenblattLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Datenblatt (storniert)';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .grid-view .glyphicon-trash,
    .grid-view .glyphicon-pencil {
        display: none;
    }
</style>
<div class="datenblatt-log-index">

    <div class="panel panel-default">
        <div class="panel-body" style="overflow-x: auto;">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
//                    ['class' => 'yii\grid\SerialColumn'],
                    ['class' => 'yii\grid\ActionColumn'],

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
                        'attribute' => 'sap_debitor_nr',
                        'value'=>'sap_debitor_nr',
                        'label' => 'SAP Debitoren Nr.'
                    ],
                    [
                        'attribute' => 'intern_debitor_nr',
                        'value'=>'intern_debitor_nr',
                        'label' => 'Interne Debitoren Nr.'
                    ],
                    [
                        'value' => 'kaeufer.anredeLabel',
                        //'value'=> '$data->anrede == 1 ? "Herr" : "Frau"',
                        'label' => 'Käufer Anrede'
                    ],
                    [
                        'attribute' => 'kaeufer_titel',
                        'value' => 'kaeufer.titel',
                        'label' => 'Käufer Titel'
                    ],
                    [
                        'attribute' => 'kaeufer_vorname',
                        'value' => 'kaeufer.vorname',
                        'label' => 'Käufer Vorname'
                    ],
                    [
                        'attribute' => 'kaeufer_nachname',
                        'value' => 'kaeufer.nachname',
                        'label' => 'Käufer Name'
                    ],

                    [
                        'value'=>'kaeufer.anrede2Label',
                        //'value'=> '$data->anrede == 1 ? "Herr" : "Frau"',
                        'label' => '2. Käufer Anrede'
                    ],
                    [
                        'attribute' => 'kaeufer_titel2',
                        'value'=>'kaeufer.titel2',
                        'label' => '2. Käufer Titel'
                    ],
                    [
                        'attribute' => 'kaeufer_vorname2',
                        'value'=>'kaeufer.vorname2',
                        'label' => '2. Käufer Vorname'
                    ],
                    [
                        'attribute' => 'kaeufer_nachname2',
                        'value'=>'kaeufer.nachname2',
                        'label' => '2. Käufer Name'
                    ],
                    [
                        'attribute' => 'te_nummer',
                        'value'=>'tenummerHtml',
                        'label' => 'TE-Nr',
                        'format' => 'html',
                    ],
                    [
                        'label' => 'Gelöscht durch',
                        'value'=>'deletedBy.username',
                        'format' => 'html',
                    ],

                ],
            ]); ?>

        </div>
    </div>

</div>
