<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Einheitstyp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="einheitstyp-form">

    <?php $form = ActiveForm::begin(); ?>

   
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'einheit')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'prefix_debitor_nr')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
