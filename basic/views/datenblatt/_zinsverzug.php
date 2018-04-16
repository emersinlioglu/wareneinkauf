<?php
use yii\helpers\Html;
//use kartik\datetime\DateTimePicker;
use kartik\datecontrol\DateControl;
use kartik\money\MaskMoney;

/* @var $modelDatenblatt app\models\Datenblatt */
/* @var $modelZinsverzug app\models\Nachlass */
/* @var $form yii\bootstrap\ActiveForm */
?>
<div class="col-md-6">
<div class="box-group" id="accordion">
    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
    <div class="panel box box-primary">
        <div class="box-header with-border">
            <h4 class="box-title">
                <a data-toggle="collapse" data-parent="#collapse-zinsverzug" href="#collapse-zinsverzug" aria-expanded="true" class="">
                    Verzugszins:
                    (Summe: <?= Yii::$app->formatter->asCurrency($modelDatenblatt->getZinsverzugSumme()) ?>)
                </a>
            </h4>
        </div>
        <div id="collapse-zinsverzug" class="panel-collapse collapse in" aria-expanded="false">
            <div class="box-body">
                
                <table class="table table-bordered">
                    <tr>
                        <th>Schreiben vom</th>
                        <th>Betrag ( € )</th>
                        <th>Bemerkung</th>
                        <th><?= Html::a('<span class="fa fa-plus"> </span>',
                            Yii::$app->urlManager->createUrl(["datenblatt/addzinsverzug", 'datenblattId' => $modelDatenblatt->id]), 
                            ['class' => 'add-button add-zahlung btn btn-success btn-xl']) ?></th>
                    </tr>
                <?php 

                $rechnungstellungBetrag = 0;

                foreach($modelDatenblatt->zinsverzugs as $key => $modelZinsverzug): ?>
                <tr class="zinsverzug">
                    <td>
                        <div class="hide">
                            <?= $form->field($modelZinsverzug, "[$key]id")->textInput() ?>
                        </div>
                        <?php
                            echo $form->field($modelZinsverzug, "[$key]schreiben_vom")->widget(DateControl::classname(), [
                                'type' => DateControl::FORMAT_DATE,
                                'options' => [
                                    'pluginOptions' => [
                                        //'autoclose' => true
                                    ]
                                ]
                            ])->label('');
                        ?>
                    </td>
                    <td>
                        <?= $form->field($modelZinsverzug, "[$key]betrag")
                            //->textInput([])
                            ->widget(MaskMoney::classname(), [
                                'options' => [
                                    'id' => 'zinsverzug-' . $key . '-betrag-id',
                                    'style' => 'text-align: right'
                                ],
                                'pluginOptions' => [
                                    'allowNegative' => true
                                ]
                            ])
                        ?>
                    </td>
                    <td>
                        <?= $form->field($modelZinsverzug, "[$key]bemerkung")->textInput([]) ?>
                    </td>
                    <td>
                        <?= Html::a('<span class="fa fa-minus"></span>', 
                            Yii::$app->urlManager->createUrl(["datenblatt/deletezinsverzug", 'datenblattId' => $modelDatenblatt->id , 'zinsverzugId' => $modelZinsverzug->id]),
                            ['class' => 'delete-button btn btn-danger btn-xl']) ?>
                    </td>
                </tr>    
                <?php endforeach;  ?>

                </table>
                
            </div>
        </div>
    </div>
</div>
</div>
