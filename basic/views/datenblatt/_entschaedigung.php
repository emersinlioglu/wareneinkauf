<?php
use yii\helpers\Html;
//use kartik\datetime\DateTimePicker;
use kartik\datecontrol\DateControl;
use yii\widgets\Pjax;
use kartik\money\MaskMoney;

/* @var $modelDatenblatt app\models\Datenblatt */
/* @var $modelNachlass app\models\Nachlass */
/* @var $form yii\bootstrap\ActiveForm */
?>
<style>
    #collapse-entschaedigung .control-label {
        display: none;
    }
</style>
<div class="box-group" id="accordion">
    <div class="panel box box-primary">
        <div class="box-header with-border">
            <h4 class="box-title">
                <a data-toggle="collapse" data-parent="#collapse-entschaedigung" href="#collapse-entschaedigung"
                   aria-expanded="true" class="">
                    Entschädigungen: (Summe: <?= Yii::$app->formatter->asCurrency($modelDatenblatt->getEntschaedigungSumme()) ?>)
                </a>
            </h4>
        </div>
        <div id="collapse-entschaedigung" class="panel-collapse collapse in" aria-expanded="false">
            <div class="box-body">

                <table class="table table-bordered">
                    <tr>
                        <th>Datum</th>
                        <th>Betrag ( € )</th>
                        <th>Bemerkung</th>
                        <th>
                            <?= Html::a('<span class="fa fa-plus"> </span>',
                                Yii::$app->urlManager->createUrl(["datenblatt/addentschaedigung", 'datenblattId' => $modelDatenblatt->id]),
                                ['class' => 'add-button add-entschaedigung btn btn-success btn-xl']) ?>
                        </th>
                    </tr>
                    <?php

                    foreach ($modelDatenblatt->entschaedigungs as $key => $modelEntschaedigung): ?>
                        <tr class="entschaedigung">
                            <td>
                                <div class="hide">
                                    <?= $form->field($modelEntschaedigung, "[$key]id")->textInput() ?>
                                </div>
                                <?php
                                echo $form->field($modelEntschaedigung, "[$key]datum")->widget(DateControl::classname(), [
                                    'type' => DateControl::FORMAT_DATE,
                                    'options' => [
                                        'pluginOptions' => [
                                            //'autoclose' => true
                                        ]
                                    ]
                                ]);
                                ?>
                            </td>
                            <td>
                                <?= $form->field($modelEntschaedigung, "[$key]betrag")
                                    //->textInput()
                                    ->widget(MaskMoney::classname(), [
                                        'options' => [
                                            'id' => $key . '-zhb-id',
                                            'style' => 'text-align: right'
                                        ],
//                                            'pluginOptions' => [
//                                                'suffix' => ' €',
//                                                'thousands' => '.',
//                                                'decimal' => ',',
//                                            ],
                                    ])
                                ?>
                            </td>
                            <td>
                                <?= $form->field($modelEntschaedigung, "[$key]bemerkung")->textInput([]) ?>
                            </td>
                            <td>
                                <?= Html::a('<span class="fa fa-minus"></span>',
                                    Yii::$app->urlManager->createUrl(["datenblatt/deleteentschaedigung", 'datenblattId' => $modelDatenblatt->id, 'entschaedigungId' => $modelEntschaedigung->id]),
                                    ['class' => 'delete-button add-entschaedigung btn btn-danger btn-xl']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </table>

            </div>
        </div>
    </div>
</div>


