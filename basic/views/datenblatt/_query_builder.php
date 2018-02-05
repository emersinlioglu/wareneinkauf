<?php
//use leandrogehlen\querybuilder\QueryBuilderForm;
use app\models\QueryBuilderProfile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveForm;

?>

<?php

// filter rules
$rules = QueryBuilderProfile::getActiveFilterRules();

// filters
$filters = [
    //['id' => 'datenblatt.firma.name', 'label' => 'Projekt', 'type' => 'integer', 'input' => 'select', 'values' => ArrayHelper::map(Projekt::find()->all(), 'id', 'name') ],
    ['id' => 'firma.name', 'label' => 'Firma', 'type' => 'string'],
    ['id' => 'firma.nr', 'label' => 'Buchungskreis', 'type' => 'string'],
    ['id' => 'sap_debitor_nr', 'label' => 'SAP Debitoren Nr.', 'type' => 'integer'],
    ['id' => 'intern_debitor_nr', 'label' => 'Interne Debitoren Nr.', 'type' => 'string'],

    ['id' => 'haus.strasse', 'label' => 'Straße', 'type' => 'string'],
    ['id' => 'haus.hausnr', 'label' => 'Haus Nr.', 'type' => 'string'],
    ['id' => 'haus.plz', 'label' => 'Plz', 'type' => 'string'],
    ['id' => 'haus.ort', 'label' => 'Ort', 'type' => 'string'],

    ['id' => 'kaeufer.titel', 'label' => 'Käufer Titel', 'type' => 'string'],
    ['id' => 'kaeufer.anrede', 'label' => 'Käufer Anrede', 'type' => 'boolean', 'input' => 'select', 'values' => ['1'=> 'Frau', '0'=> 'Herr']],
    ['id' => 'kaeufer.vorname', 'label' => 'Käufer Vorname', 'type' => 'string'],
    ['id' => 'kaeufer.nachname', 'label' => 'Käufer Name', 'type' => 'string'],
    ['id' => 'kaeufer.email', 'label' => 'Käufer-Email', 'type' => 'string'],
    ['id' => 'kaeufer.festnetz', 'label' => 'Käufer-Festnetznummer', 'type' => 'string'],
    ['id' => 'kaeufer.handy', 'label' => 'Käufer-Handynummer', 'type' => 'string'],

//    ['id' => 'kaeufer.titel2', 'label' => '2. Käufer Titel', 'type' => 'string'],
//    ['id' => 'kaeufer.anrede2', 'label' => '2. Käufer Anrede', 'type' => 'boolean', 'input' => 'select', 'values' => ['1'=> 'Frau', '0'=> 'Herr']],
    ['id' => 'kaeufer.vorname2', 'label' => '2. Käufer Vorname', 'type' => 'string'],
    ['id' => 'kaeufer.nachname2', 'label' => '2. Käufer Name', 'type' => 'string'],
    ['id' => 'te_nummer', 'label' => 'TE-Nr', 'type' => 'string'],
];
$filters = Json::encode($filters);

$this->registerJs("
    $(function() {
        new QueryBuilderProfileForm({$filters}, {$rules});
    });
");

?>

<style>
    #query-builder-wrapper .box-title a {
        padding-right: 30px;
    }
    #query-builder-wrapper form {
        display: inline-block;
    }
    #query-builder-wrapper select[name="queryBuilderProfileId"] {
        display: inline-block;
        width: auto;
        min-width: 150px;
    }
</style>

<div class="box-group" id="query-builder-wrapper">
    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
    <div class="panel box box-primary">
        <div class="box-header with-border">
            <h4 class="box-title">
                <a data-toggle="collapse" data-parent="#collapse-querybuilder" href="#collapse-querybuilder" aria-expanded="true" class="">
                    Filter
                </a>
            </h4>

            <?php
            echo Html::dropDownList(
                'queryBuilderProfileId',
                QueryBuilderProfile::getAktiveProfileId(),
                ArrayHelper::map(QueryBuilderProfile::getProfilesForCurrentUser(), 'id', 'name'),
                ['class' => "form-control", 'prompt' => 'Bitte wählen']
            )
            ?>

            <?= Html::a('<span class="fa fa-plus"> </span>',
                Yii::$app->urlManager->createUrl(["query-builder-profile/create"]),
                ['class' => 'add-query-builder-profile btn btn-success']) ?>
            <?= Html::a('<span class="fa fa-minus"></span>',
                Yii::$app->urlManager->createUrl(["query-builder-profile/delete", 'id' => '']),
                ['class' => 'remove-query-builder-profile btn btn-danger']) ?>

            <?php
                $queryBuilderProfileModel = QueryBuilderProfile::getAktiveProfile();
            ?>
            <?php if ($queryBuilderProfileModel): ?>
                <span>&nbsp;|&nbsp;</span>
                <?php $form = ActiveForm::begin([
                    'action' => ['query-builder-profile/update', 'id' => QueryBuilderProfile::getAktiveProfileId()],
                    'options' => array(
                        'class' => 'query-builder-form',
                    )
                ]);?>
                    <div class="hidden">
                        <?= $form->field($queryBuilderProfileModel, 'filter_rules')->hiddenInput() ?>
                    </div>
                    <?= Html::submitButton('Speichern', ['class' => 'btn btn-success']); ?>
                    <?= Html::submitButton('Zurücksetzen', ['class' => 'btn btn-danger', 'name' => 'reset']); ?>
                <?php ActiveForm::end(); ?>
            <?php endif; ?>
        </div>
        <div id="collapse-querybuilder" class="panel-collapse collapse in" aria-expanded="false">
            <div class="box-body">
                <div id="querybuilder">
                    <!-- PLATZHALTER -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="query-builder-profile-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Filter erstellen</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
            </div>
        </div>

    </div>
</div>