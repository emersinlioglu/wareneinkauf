<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Vorlage;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model app\models\Abschlag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="abschlag-form">

    <?php $form = ActiveForm::begin([
        'action' => ['abschlag/update-abschlag-datum'],
        'method' => 'get',
        'options' => array(
            'class' => 'updateErstelldatumVorlageForm',
        )
    ]); ?>

    <div class="hide">
        <?= Html::hiddenInput('abschlag', $abschlagNr) ?>
        <?= Html::hiddenInput('datenblatt[]', $model->datenblatt_id) ?>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'vorlage_id')->dropDownList(
                ArrayHelper::map(Vorlage::findAll('1'), 'id', 'name'),
                [
                    'class' => 'form-control',
                    'prompt'=>'Vorlage auswählen'
                ]
            ); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?php
            echo $form->field($model, "erstell_datum")->widget(DateControl::classname(), [
                'type' => DateControl::FORMAT_DATE,
                'options' => [
                    'pluginOptions' => [
                        //'autoclose' => true
                    ]
                ]
            ]);
            ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Absenden', ['class' => 'btn btn-primary']) ?>
    </div>

    <div class="row">
        <div class="col-sm-12 submit-message">

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
