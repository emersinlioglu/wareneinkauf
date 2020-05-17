<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Rechnung */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rechnung-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'datum')->textInput() ?>

    <?= $form->field($model, 'nummer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lieferant_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
