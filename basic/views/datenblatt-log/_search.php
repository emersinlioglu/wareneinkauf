<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DatenblattLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="datenblatt-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'firma_id') ?>

    <?= $form->field($model, 'projekt_id') ?>

    <?= $form->field($model, 'haus_id') ?>

    <?= $form->field($model, 'nummer') ?>

    <?php // echo $form->field($model, 'kaeufer_id') ?>

    <?php // echo $form->field($model, 'besondere_regelungen_kaufvertrag') ?>

    <?php // echo $form->field($model, 'sonstige_anmerkungen') ?>

    <?php // echo $form->field($model, 'aktiv') ?>

    <?php // echo $form->field($model, 'beurkundung_am') ?>

    <?php // echo $form->field($model, 'verbindliche_fertigstellung') ?>

    <?php // echo $form->field($model, 'uebergang_bnl') ?>

    <?php // echo $form->field($model, 'abnahme_se') ?>

    <?php // echo $form->field($model, 'abnahme_ge') ?>

    <?php // echo $form->field($model, 'auflassung') ?>

    <?php // echo $form->field($model, 'creator_user_id') ?>

    <?php // echo $form->field($model, 'sap_debitor_nr') ?>

    <?php // echo $form->field($model, 'intern_debitor_nr') ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
