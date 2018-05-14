<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;
use app\models\Einheitstyp;
use kartik\money\MaskMoney;

/* @var $this yii\web\View */
/* @var $model app\models\Teileigentumseinheit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teileigentumseinheit-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'hausnr')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'einheitstyp_id')
                ->dropDownList(ArrayHelper::map(Einheitstyp::find()->all(), 'id', 'name'))
            ?>
            <?= $form->field($model, 'te_nummer')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'gefoerdert')->checkbox() ?>
            <?= $form->field($model, 'geschoss')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'zimmer')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, "me_anteil")
                //->textInput([])
                ->widget(MaskMoney::classname(), [
                    'options' => [
                        'style' => 'text-align: right',
                    ],
                ])
            ?>
            <?= $form->field($model, "wohnflaeche")
                //->textInput([])
                ->widget(MaskMoney::classname(), [
                    'options' => [
                        'style' => 'text-align: right',
                    ],
                ])
            ?>
            <?= $form->field($model, "kp_einheit")
                //->textInput([])
                ->widget(MaskMoney::classname(), [
                    'options' => [
                        'style' => 'text-align: right',
                    ],
                ])
            ?>

            <?= $form->field($model, "verkaufspreis")
                //->textInput([])
                ->widget(MaskMoney::classname(), [
                    'options' => [
                        'style' => 'text-align: right',
                    ],
                ])
            ?>
            <?= $form->field($model, "forecast_preis")
                //->textInput([])
                ->widget(MaskMoney::classname(), [
                    'options' => [
                        'style' => 'text-align: right',
                    ],
                ])
            ?>
            <?= $form->field($model, 'verkaufspreis_begruendung')->textInput(['maxlength' => true]) ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
