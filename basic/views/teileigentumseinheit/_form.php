<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;
use app\models\Einheitstyp;
use \app\models\Teileigentumseinheit;
use kartik\money\MaskMoney;
use \kartik\datecontrol\DateControl;

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
            <?= $form->field($model, 'rechnung_vertrieb')->checkbox() ?>
            <?= $form->field($model, 'zaehler_abgemeldet')->checkbox() ?>
            <?= $form->field($model, 'status')->dropDownList(Teileigentumseinheit::statusOptions(), ['prompt' => 'Bitte wählen'])->label('Status'); ?>
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

    <div class="container-table zaehlerstand" id='zaehlerstand-id'>
        <h2>Zählerstand-Angaben:</h2>

        <table class="table no-label">
            <tr>
                <th style="width: 30%;">Medium-Name.</th>
                <th style="width: 30%;">Medium-Nr.</th>
                <th style="width: 20%;">Zählerstand</th>
                <th style="width: 20%;">Datum</th>
                <th>
                    <?php if (!$model->haus->isNewRecord): ?>
                        <!--?= Html::submitButton('<span class="fa fa-plus"> Teileigentumseinheit hinzufügen</span>', ['class' => 'btn btn-success', 'name' => 'addnew']) ?-->
                        <?= Html::a('<span class="fa fa-plus"> </span>',
                            Yii::$app->urlManager->createUrl(["teileigentumseinheit/addzaehlerstand", 'teileigentumseinheitId' => $model->id]),
                            ['class' => 'add-button add-zaehlerstand btn btn-success btn-xl']) ?>
                    <?php endif; ?>
                </th>
            </tr>
            <?php
            /* @var $zaehlerstand app\models\Zaehlerstand */
            foreach ($model->zaehlerstands as $key => $zaehlerstand): ?>
                <tr>
                    <td>
                        <span class="hide">
                            <?= $form->field($zaehlerstand, 'id')->hiddenInput(['name' => "Zaehlerstand[$key][id]"]) ?>
                        </span>
                        <?= $form->field($zaehlerstand, 'name')->textInput(['name' => "Zaehlerstand[$key][name]"]) ?>
                    </td>
                    <td><?= $form->field($zaehlerstand, 'nummer')->textInput(['name' => "Zaehlerstand[$key][nummer]"]) ?></td>
                    <td><?= $form->field($zaehlerstand, 'stand')->textInput(['name' => "Zaehlerstand[$key][stand]"]) ?></td>
                    <td>
                        <?php
                        echo '<label>Datum</label>';
                        echo $form->field($zaehlerstand, "[$key]datum")->widget(DateControl::classname(), [
                            'type' => DateControl::FORMAT_DATE,
                            'options' => [
                                'pluginOptions' => [
                                    'removeButton' => false,
                                    'autoclose' => true
                                ]
                            ]
                        ]);
                        ?>
                    </td>
                    <td>
                        <label>&nbsp;</label>
                        <?= Html::a('<span class="fa fa-minus"></span>',
                            Yii::$app->urlManager->createUrl(["teileigentumseinheit/deletezaehlerstand", 'teileigentumseinheitId' => $model->id , 'zaehlerstandId' => $zaehlerstand->id]),
                            ['class' => 'delete-button delete-zaehlerstand btn btn-danger btn-xl']) ?>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
        </table>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
