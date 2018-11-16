<?php
use yii\helpers\Html;
//use kartik\datetime\DateTimePicker;
use kartik\datecontrol\DateControl;
use kartik\money\MaskMoney;

/* @var $modelDatenblatt app\models\Datenblatt */
/* @var $modelNachlass app\models\Nachlass */
/* @var $form yii\bootstrap\ActiveForm */
?>
<div class="box-group" id="accordion">
    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
    <div class="panel box box-primary">
        <div class="box-header with-border">
            <h4 class="box-title">
                <a data-toggle="collapse" data-parent="#collapse-nachlass" href="#collapse-nachlass" aria-expanded="true" class="">
                    Minderungen/Nachlass:
                    (Summe: <?= Yii::$app->formatter->asCurrency($modelDatenblatt->getNachlassSumme()) ?>)
                </a>
            </h4>
        </div>
        <div id="collapse-nachlass" class="panel-collapse collapse in" aria-expanded="false">
            <div class="box-body">
                
                <table class="table table-bordered">
                    <tr>
                        <th>Schreiben vom</th>
                        <th>Betrag ( € )</th>
                        <th>Bemerkung</th>
                        <th><?= Html::a('<span class="fa fa-plus"> </span>',
                            Yii::$app->urlManager->createUrl(["datenblatt/addnachlass", 'datenblattId' => $modelDatenblatt->id]), 
                            ['class' => 'add-button add-zahlung btn btn-success btn-xl']) ?></th>
                    </tr>
                <?php 

                $rechnungstellungBetrag = 0;

                foreach($modelDatenblatt->nachlasses as $key => $modelNachlass): ?>
                <tr class="sonderwunsch">
                    <td>
                        <div class="hide">
                            <?= $form->field($modelNachlass, "[$key]id")->textInput() ?>
                        </div>
                        <?php
                            echo $form->field($modelNachlass, "[$key]schreiben_vom")->widget(DateControl::classname(), [
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
                        <?= $form->field($modelNachlass, "[$key]betrag")
                            //->textInput([])
                            ->widget(MaskMoney::classname(), [
                                'options' => [
                                    'id' => $key . '-betrag-id',
                                    'style' => 'text-align: right'
                                ],
                                'pluginOptions' => [
                                    'allowNegative' => true
                                ]
                            ])
                        ?>
                    </td>
                    <td>
                        <?= $form->field($modelNachlass, "[$key]bemerkung")->textInput([]) ?>
                    </td>
                    <td>
                        <?= Html::a('<span class="fa fa-minus"></span>', 
                            Yii::$app->urlManager->createUrl(["datenblatt/deletenachlass", 'datenblattId' => $modelDatenblatt->id , 'nachlassId' => $modelNachlass->id]), 
                            ['class' => 'delete-button add-zahlung btn btn-danger btn-xl']) ?>
                    </td>
                </tr>    
                <?php endforeach;  ?>

                </table>
                
            </div>
        </div>
    </div>
</div>
