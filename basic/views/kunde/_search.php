<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KundeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kunde-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?php //echo $form->field($model, 'debitor_nr') ?>

    <?= $form->field($model, 'anrede') ?>

    <?= $form->field($model, 'titel') ?>

    <?= $form->field($model, 'vorname') ?>

    <?php // echo $form->field($model, 'nachname') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'strasse') ?>

    <?php // echo $form->field($model, 'hausnr') ?>

    <?php // echo $form->field($model, 'plz') ?>

    <?php // echo $form->field($model, 'ort') ?>

    <?php // echo $form->field($model, 'festnetz') ?>

    <?php // echo $form->field($model, 'handy') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
