<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Firma;

?>

<div class="datenblatt-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form', 
        'options'=>array(
            'class' => 'datenblatt-form'
        )
    ]); ?>

    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($modelDatenblatt, 'nummer')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($modelDatenblatt, 'firma_id')->dropDownList(ArrayHelper::map(Firma::find()->all(), 'id', 'name'), ['prompt'=>'Firma auswählen']) ?>
        </div>
        <div class="col-sm-2">
            <?php
                $projekte = $modelDatenblatt->firma ? $modelDatenblatt->firma->projekts : [];
                echo $form->field($modelDatenblatt, 'projekt_id')->dropDownList(ArrayHelper::map($projekte, 'id', 'name'), ['prompt'=>'Projekt auswählen']);
            ?>
        </div>
        <div class="col-sm-2">
            <?php   
                $haeuser = $modelDatenblatt->firma && $modelDatenblatt->projekt ? $modelDatenblatt->projekt->hauses : [];
                echo $form->field($modelDatenblatt, 'haus_id')->dropDownList(ArrayHelper::map($haeuser, 'id', 'id'), ['prompt'=>'Haus auswählen']);
            ?>
        </div>
    </div>
    
    
    <?= $this->render('_zahlungen', [
            'form' => $form,
            'modelsZahlung'  => $modelsZahlung,
        ]) ?>

    
    <div class="form-group">
        <?= Html::submitButton($modelDatenblatt->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>