<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ArtikelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="artikel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nummer') ?>

    <?= $form->field($model, 'bezeichnung') ?>

    <?= $form->field($model, 'seriennummer') ?>

    <?= $form->field($model, 'hersteller_artikelnr') ?>

    <?php // echo $form->field($model, 'hersteller_id') ?>

    <?php // echo $form->field($model, 'warenart_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
