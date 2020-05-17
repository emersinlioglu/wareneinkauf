<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RechnungItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rechnung-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rechnung_id')->textInput() ?>

    <?= $form->field($model, 'anzahl')->textInput() ?>

    <?= $form->field($model, 'netto_einzel_betrag')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kunde_rechnungsnr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kunde_id')->textInput() ?>

    <?= $form->field($model, 'artikel_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
