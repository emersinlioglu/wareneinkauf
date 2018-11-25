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

<?php
$this->registerJs('
    $(function(){
        new TeileigentumseinheitForm();
    });'
);
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
                <th>Abgemeldet</th>
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
                        <?php
                            $options = [];
                            if ($zaehlerstand->zaehler_abgemeldet) { $options['readonly'] = 'readonly'; }
                            echo $form->field($zaehlerstand, 'name')->textInput(['name' => "Zaehlerstand[$key][name]"] + $options)
                        ?>
                    </td>
                    <td><?= $form->field($zaehlerstand, 'nummer')->textInput(['name' => "Zaehlerstand[$key][nummer]"] + $options) ?></td>
                    <td><?= $form->field($zaehlerstand, 'stand')->textInput(['name' => "Zaehlerstand[$key][stand]"] + $options) ?></td>
                    <td>
                        <?php

                        $options = [];
                        if ($zaehlerstand->zaehler_abgemeldet) { $options['disabled'] = 'disabled'; }

                        echo '<label>Datum</label>';
                        echo $form->field($zaehlerstand, "[$key]datum")->widget(DateControl::classname(), [
                            'type' => DateControl::FORMAT_DATE,
                            'options' => [
                                'pluginOptions' => [
                                    'removeButton' => false,
                                    'autoclose' => true
                                ],

                            ] + $options
                        ]);
                        ?>
                    </td>
                    <td>
                        <?= $form->field($zaehlerstand, "[$key]zaehler_abgemeldet")->checkbox([], false) ?>
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

<!-- Trigger the modal with a button -->
<!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

<!-- Modal -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Bestätigung</h4>
            </div>
            <div class="modal-body">
                <p>Möchten Sie die Änderung wirklich durchführen?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                <button type="button" class="btn btn-primary">Abschicken</button>
            </div>
        </div>
    </div>
</div>
