<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

?>

<div class="datenblatt-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

     <div class="row">
        <div class="col-sm-6">
            <?= $form->field($modelDatenblatt, 'nummer')->textInput(['maxlength' => true]) ?>
        </div>
        <!--<div class="col-sm-6">-->
            <!--?= $form->field($modelDatenblatt, 'last_name')->textInput(['maxlength' => true]) ?-->
        <!--</div>-->
    </div>

    <div class="padding-v-md">
        <div class="line line-dashed"></div>
    </div>

    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.container-items',
        'widgetItem' => '.zahlung-item',
        'limit' => 10,
        'min' => 1,
        'insertButton' => '.add-zahlung',
        'deleteButton' => '.remove-zahlung',
        'model' => $modelsZahlung[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'betrag',
            'datum'
        ],
    ]); ?>
    
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Zahlung</th>
                <!--<th style="width: 450px;">Rooms</th>-->
                <th class="text-center" style="width: 90px;">
                    <button type="button" class="add-zahlung btn btn-success btn-xs">
                        <span class="fa fa-plus"></span>
                    </button>
                </th>
            </tr>
        </thead>
        <tbody class="container-items">
        <?php foreach ($modelsZahlung as $indexZahlung => $modelZahlung): ?>
            <tr class="zahlung-item">
                <td class="vcenter">
                    <?php
                        // necessary for update action.
                        if (! $modelZahlung->isNewRecord) {
                            echo Html::activeHiddenInput($modelZahlung, "[{$indexZahlung}]id");
                        }
                    ?>
                    <?= $form->field($modelZahlung, "[{$indexZahlung}]betrag")->label(false)->textInput(['maxlength' => true]) ?>
                </td>
                <!--<td>-->
                    <!--?= $this->render('_form-rooms', [
                        'form' => $form,
                        'indexHouse' => $indexZahlung,
                        'modelsRoom' => $modelsRoom[$indexZahlung],
                    ]) ?-->
                <!--</td>-->
                <td class="text-center vcenter" style="width: 90px; verti">
                    <button type="button" class="remove-zahlung btn btn-danger btn-xs">
                        <span class="fa fa-minus"></span>
                    </button>
                </td>
            </tr>
         <?php endforeach; ?>
        </tbody>
    </table>
    
    
    <?php DynamicFormWidget::end(); ?>
    
    <div class="form-group">
        <?= Html::submitButton($modelDatenblatt->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>