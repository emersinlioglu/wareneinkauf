<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Firma;
use yii\widgets\Pjax;

/* @var $this \yii\web\View */
/* @var $modelDatenblatt \app\models\Datenblatt */
/* @var $form \yii\widgets\ActiveForm */
?>
<?php
//$this->registerJs(
//    '$("document").ready(function(){
//        $("#dynamic-form").on("pjax:end", function() {
//            $.pjax.reload({container:"#datenblatt-form"});  //Reload GridView
//            console.log("reload form");
//        });
//    });'
//);
$this->registerJs('
    $(function(){
        $("#datenblatt-form").submit();

        // after reload form
        $(document).on(\'ready pjax:success\', function() {
            new DatenblattForm();
        });
        
//        // To disable f5
//        $(document).bind("keydown", function(e){
//            if ((e.which || e.keyCode) == 116) {
//                e.preventDefault();
//
//                $("#datenblatt-form").attr("action")
//            }
//        });

    });
');
?>

<!--<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>-->

<?php //yii\widgets\Pjax::begin(['id' => 'datenblatt-form']) ?>
<?php //$form = ActiveForm::begin(['options' => ['data-pjax' => true ]]); ?>

<?php $form = ActiveForm::begin([
    //'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    //'validateOnSubmit' => true,
    'options' => array(
        'data-pjax' => true,
        //'class' => 'datenblatt-form',
        'id' => 'datenblatt-form',
        'data-datenblatt-id' => $modelDatenblatt->id,
    )
]); ?>

<!--<div class="row">-->
<!--    <div class="col-sm-2">-->
        <!-- ?= $form->field($modelDatenblatt, 'nummer')->textInput(['maxlength' => true]) ?-->
<!--    </div>-->
<!--</div>-->

<div class="hide"><?= $form->field($modelDatenblatt, 'aktiv')->hiddenInput() ?></div>

<?php if ($modelDatenblatt->id): ?>
    <div class="row">
        <div class="col-sm-2">
            <?php $htmlOptions = $canEditBasicData ? [] : ['disabled' => 'disabled'] ?>
            <?= $form->field($modelDatenblatt, 'firma_id')
                ->dropDownList(ArrayHelper::map(
                    Firma::find()->all(), 'id', 'name'),
                    array_merge(
                        ['prompt' => 'Firma auswählen'],
                        $htmlOptions
                    )
                )
                ->label('Firma')
            ?>
        </div>
        <div class="col-sm-2">
            
            <?php 
            $firma = $modelDatenblatt->firma ? $modelDatenblatt->firma : new Firma();
            if($modelDatenblatt->firma) {
                //echo $modelDatenblatt->firma->nr;
            }
            echo $form->field($firma, 'nr')->textInput(['disabled' => 'disabled'])->label('Buchungskr.')
            ?>
        </div>
        <div class="col-sm-2">
            <?php
            $htmlOptions = ['prompt' => 'Projekt auswählen'];
            if (!$modelDatenblatt->firma_id || !$canEditBasicData) {
                $htmlOptions['disabled'] = 'disabled';
            }
            $projekte = $modelDatenblatt->firma ? $modelDatenblatt->firma->projekts : [];
            echo $form->field($modelDatenblatt, 'projekt_id')->dropDownList(ArrayHelper::map($projekte, 'id', 'name'), $htmlOptions)->label('Projekt');
            ?>
        </div>
        <div class="col-sm-2">
            <?php
//            $htmlOptions = ['prompt' => 'Object auswählen'];
//            $haeuserOptions = [];
//            if (!$modelDatenblatt->projekt_id || !$canEditBasicData) {
//                $htmlOptions['disabled'] = 'disabled';
//            } else {
//                /* @var $haus \app\models\Haus */
//                $haeuserOptions = [];
//                foreach ($modelDatenblatt->projekt->hauses as $haus) {
//                    if ($haus->id == $modelDatenblatt->haus_id || count($haus->datenblatts) == 0) {
//                        /* @var $te \app\models\Teileigentumseinheit */
//                        $teId = '';
//                        $teNr = '';
//                        //echo 'hid: ' . $haus->id . "<br>";
//                        foreach ($haus->teileigentumseinheits as $te) {
//                            //echo 'te-id: ' . $te->id . "<br>";
//                            //if ($te->einheitstyp_id == \app\models\Einheitstyp::TYPE_HAUS) {
//                                $haeuserOptions[$haus->id] = ($te->te_nummer ? $te->te_nummer : "Keine TE-Nr (id: $te->id)");
//                                break;
//                            //}
//                        }
//                    }
//                }
//            }
//            echo $form->field($modelDatenblatt, 'haus_id')->dropDownList($haeuserOptions, $htmlOptions)->label('Teileigentumseinheit');
            ?>
        </div>
    </div>

    <ul class="nav nav-tabs well">
        <li class="active"><a href="#tab-te-details" data-toggle="tab">Teileigentumseinheiten</a></li>
        <li class=""><a href="#tab-kaeuferdaten" data-toggle="tab">Käuferdaten</a></li>
        <li class=""><a href="#tab-sonderwuensche" data-toggle="tab">Sonderwünsche</a></li>
        <li class=""><a href="#tab-kaufpreisabrechnung" data-toggle="tab">Kaufpreisabrechnung/Abschlag-Emails</a></li>
        <li class=""><a href="#tab-minderungen" data-toggle="tab">Minderungen/Zahlungen/Verzugszins</a></li>
    </ul>
    <div id="" class="tab-content">
        <div id="tab-te-details" class="tab-pane active">
            <?= $this->render('_hausdetails', [
                'form' => $form,
                'modelDatenblatt' => $modelDatenblatt,
            ]) ?>

            <?= $this->render('_teileigentumseinheiten', [
                'form' => $form,
                'modelDatenblatt' => $modelDatenblatt,
            ]) ?>

            <?= $this->render('_zaehlerangaben', [
                'form' => $form,
                'modelDatenblatt' => $modelDatenblatt
            ]) ?>
        </div>
        <div id="tab-kaeuferdaten" class="tab-pane">

            <?php //if ($modelDatenblatt->kaeufer): ?>
            <?= $this->render('_kaeuferdaten', [
                'form' => $form,
                'modelKaeufer' => $modelKaeufer,
                'modelDatenblatt' => $modelDatenblatt,
                'canEditBasicData' => $canEditBasicData,
            ]) ?>
            <?php //endif; ?>

            <div class="row">
                <div class="col-sm-10">
                    <?= $form->field($modelDatenblatt, 'besondere_regelungen_kaufvertrag')->textarea(['rows' => '5']) ?>
                </div>
            </div>

        </div>
        <div id="tab-sonderwuensche" class="tab-pane">
            <?= $this->render('_sonderwuensche', [
                'form' => $form,
                'modelDatenblatt' => $modelDatenblatt,
            ]) ?>
<!--            <div class="form-group" style="text-align: right;">-->
<!--                --><?php //echo Html::submitButton($modelDatenblatt->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary', 'name' => 'submit']) ?>
<!--            </div>-->
        </div>
        <div id="tab-kaufpreisabrechnung" class="tab-pane">

            <?= $this->render('_kaufpreisabrechnung', [
                'form' => $form,
                'modelDatenblatt' => $modelDatenblatt,
                'kaufpreisTotal' => $kaufpreisTotal,
                'sonderwuenscheTotal' => $sonderwuenscheTotal,
            ]) ?>
            <div class="form-group" style="text-align: right;">
                <?= Html::submitButton($modelDatenblatt->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary', 'name' => 'submit']) ?>
            </div>

            <?= $this->render('_abschlag_mails', [
                'modelDatenblatt' => $modelDatenblatt,
            ]) ?>

        </div>
        <div id="tab-minderungen" class="tab-pane">

            <div class="row">
                <div class="col-md-12">

                    <?= $this->render('_nachlass', [
                        'form' => $form,
                        'modelDatenblatt' => $modelDatenblatt,
                    ]) ?>

                    <?= $this->render('_zahlung', [
                        'form' => $form,
                        'modelDatenblatt' => $modelDatenblatt,
                    ]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <?= $this->render('_zinsverzug', [
                        'form' => $form,
                        'modelDatenblatt' => $modelDatenblatt,
                    ]) ?>

                </div>
            </div>

            <div class="row">
                <div class="col-sm-8">
                    <?= $form->field($modelDatenblatt, 'sonstige_anmerkungen')->textarea(['rows' => '5']) ?>
                </div>
            </div>

        </div>
    </div>

    <div style="clear: both;"></div>
<?php endif; ?>

<div class="form-group" style="text-align: right;">
    <?= Html::submitButton($modelDatenblatt->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary', 'name' => 'submit']) ?>
</div>

<?php ActiveForm::end(); ?>
<?php //yii\widgets\Pjax::end() ?>



<div style="clear: both;"></div>
