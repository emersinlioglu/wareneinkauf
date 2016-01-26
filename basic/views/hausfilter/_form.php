<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Haus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="haus-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'projekt_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ort')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'strasse')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hausnr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reserviert')->textInput() ?>

    <?= $form->field($model, 'verkauft')->textInput() ?>

    <?= $form->field($model, 'rechnung_vertrieb')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
