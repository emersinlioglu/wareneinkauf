<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DatenblattLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="datenblatt-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'firma_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'projekt_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'haus_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nummer')->textInput() ?>

    <?= $form->field($model, 'kaeufer_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'besondere_regelungen_kaufvertrag')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sonstige_anmerkungen')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'aktiv')->textInput() ?>

    <?= $form->field($model, 'beurkundung_am')->textInput() ?>

    <?= $form->field($model, 'verbindliche_fertigstellung')->textInput() ?>

    <?= $form->field($model, 'uebergang_bnl')->textInput() ?>

    <?= $form->field($model, 'abnahme_se')->textInput() ?>

    <?= $form->field($model, 'abnahme_ge')->textInput() ?>

    <?= $form->field($model, 'auflassung')->textInput() ?>

    <?= $form->field($model, 'creator_user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sap_debitor_nr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'intern_debitor_nr')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
