<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Artikel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="artikel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nummer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bezeichnung')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seriennummer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hersteller_artikelnr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hersteller_id')->textInput() ?>

    <?= $form->field($model, 'warenart_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
