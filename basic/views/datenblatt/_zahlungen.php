<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<h3>Zahlungen</h3>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th></th>
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
            <td class="text-center vcenter" style="width: 90px; verti">
                <button type="button" class="remove-zahlung btn btn-danger btn-xs">
                    <span class="fa fa-minus"></span>
                </button>
            </td>
        </tr>
     <?php endforeach; ?>
    </tbody>
</table>