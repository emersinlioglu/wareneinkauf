<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Kaeufer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kaeufer-form">

    <div class="panel panel-default">
        <div class="panel-body" >

            <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-lg-6">

                    <h3>Kontaktdaten</h3>

                    <div class="row">
                        <div class="col-sm-6">
                            <?php //echo $form->field($model, 'debitor_nr')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'anrede')->dropDownList([0 => 'Herr', 1 => 'Frau'], ['prompt' => 'Auswählen']) ?>
                            <?= $form->field($model, 'titel')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'vorname')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'nachname')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'anrede2')->dropDownList([0 => 'Herr', 1 => 'Frau'], ['prompt' => 'Auswählen']) ?>
                            <?= $form->field($model, 'titel2')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'vorname2')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'nachname2')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <h3>Adresse</h3>

                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'strasse')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'plz')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'land')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Land::$laender, 'code', 'name'), ['prompt' => 'Auswählen']) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'hausnr')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'ort')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'festnetz')->textInput(['maxlength' => true])->widget(\yii\widgets\MaskedInput::className(), [
                                'mask' => '09999-9[9][9][9][9][9][9][9][9]',
                            ]) ?>
                            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'handy')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Erstellen' : 'Aktualisieren', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
