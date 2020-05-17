<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RechnungItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rechnung-item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'rechnung_id') ?>

    <?= $form->field($model, 'anzahl') ?>

    <?= $form->field($model, 'netto_einzel_betrag') ?>

    <?= $form->field($model, 'kunde_rechnungsnr') ?>

    <?php // echo $form->field($model, 'kunde_id') ?>

    <?php // echo $form->field($model, 'artikel_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
