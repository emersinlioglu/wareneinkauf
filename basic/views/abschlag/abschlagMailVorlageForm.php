<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Vorlage;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Abschlag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="abschlag-form">

    <?php $form = ActiveForm::begin([
        'action' => ['abschlag/send-abschlag-mails'],
        'method' => 'get',
        'options' => array(
            'class' => 'sendEinzelAbschlagMailForm',
        )
    ]); ?>

    <div class="hide">
        <?= $form->field($model, 'id')->hiddenInput() ?>
        <?= Html::hiddenInput('abschlag', $abschlagNr) ?>
        <?= Html::hiddenInput('datenblatt[]', $model->datenblatt_id) ?>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="control-label" for="datenblatt-firma_id">Vorlage</label>
                <?= Html::dropDownList(
                    'vorlage',
                    null,
                    ArrayHelper::map(Vorlage::findAll('1'), 'id', 'name'),
                    [
                        'class' => 'form-control',
                        'prompt'=>'Vorlage auswählen'
                    ]
                ); ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Absenden', ['class' => 'btn btn-primary']) ?>
    </div>

    <div class="row">
        <div class="col-sm-6 submit-message">

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
