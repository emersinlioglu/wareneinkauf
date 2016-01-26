<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Datenblatt */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="datenblatt-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'firma_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'projekt_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'haus_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nummer')->textInput() ?>

    <?= $form->field($model, 'kaeufer_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'besondere_regelungen_kaufvertrag')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sonstige_anmerkungen')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
