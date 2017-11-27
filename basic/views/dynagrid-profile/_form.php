<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DynagridProfile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dynagrid-profile-form">

    <?php $form = ActiveForm::begin([
        //'enableAjaxValidation' => false,
//        'enableClientValidation' => true,
//        'validateOnSubmit' => true,
        //'action' => ['add-meilenstein'],
        'options' => array(
            //'class' => 'datenblatt-form',
            'id' => 'dynagrid-profile-form'
        )
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Erstellen' : 'Aktualisieren', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
