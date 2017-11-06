<?php

use yii\widgets\ActiveForm;
use \yii\helpers\Html;


$this->title = 'Projekt (' . $projekt->name . '): Abschläge konfigurieren';
/** @var \app\models\Projekt $projekt */
/** @var \app\models\ProjektAbschlag $projektAbschlag */
?>

<div class="row">

    <div class="box-group col-sm-6" id="accordion">
        <div class="panel box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#collapse-abschlag" href="#collapse-abschlag" aria-expanded="true" class="">
                        Abschläge:
                    </a>
                </h4>
            </div>
            <div id="collapse-abschlag" class="panel-collapse collapse in" aria-expanded="false">
                <div class="box-body">

                    <?php $form = ActiveForm::begin([
                        'enableClientScript' => false,
                    ]); ?>

                        <table class="table table-bordered abschlag-tabelle">
                            <thead>
                                <tr>
                                    <th style="">Name</th>
                                    <th style="">Prozent-Summe (%)</th>
                                    <th style="">Meilensteine</th>
                                    <th style="width: 5%;">
                                        <?= Html::a('<span class="fa fa-plus"> </span>',
                                            Yii::$app->urlManager->createUrl(["projekt/add-projekt-abschlag", 'id' => $projekt->id]),
                                            ['class' => 'add-button add-projekt-abschlag btn btn-success btn-xl']) ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($projekt->projektAbschlags as $key => $projektAbschlag): ?>
                                    <tr>
                                        <td>
                                            <div class="hide">
                                                <?= $form->field($projektAbschlag, "[$key]id")->hiddenInput() ?>
                                            </div>
                                            <?= $form->field($projektAbschlag, "[$key]name")->textInput([])->label(false) ?>
                                        </td>
                                        <td class="prozent-summe" style="text-align: right;">
                                            <?php echo Yii::$app->formatter->asDecimal($projektAbschlag->getKaufvertragProzentSumme(), 2); ?>
                                        </td>
                                        <td style="width: 150px;">
                                            <ol class="meilenstein sortable zuordnung">
                                                <?php foreach ($projektAbschlag->meilensteins as $meilensteinKey => $meilenstein): ?>
                                                    <li data-meilenstein-id="<?= $meilenstein->id ?>" data-prozent="<?= $meilenstein->kaufvertrag_prozent ?>">
                                                        <i class="glyphicon glyphicon-move"></i><?= $meilenstein->name ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ol>

                                            <div class="hide">
                                                <?php echo Html::textInput("ProjektAbschlagZuordnung[$projektAbschlag->id]", $projektAbschlag->getZuordnungenAsString(),
                                                    ['class' => 'abschlag-zuordnungen'])
                                                ?>
                                            </div>
                                        </td>
                                        <td>
                                            <?= Html::a('<span class="fa fa-minus"></span>',
                                                Yii::$app->urlManager->createUrl(["projekt/delete-projekt-abschlag", 'id' => $projektAbschlag->id]),
                                                ['class' => 'delete-button delete-projekt-abschlag btn btn-danger btn-xl']) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>

                        <div class="form-group" style="text-align: right;">
                            <?= Html::submitButton('Aktualisieren', ['class' => 'btn btn-primary', 'name' => 'submit']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>

    <?php
    $this->registerJs('
        $(function(){
        
            function updateMeilensteinZuordnungen() {
                $(".abschlag-tabelle tbody tr").each(function () {
                    var elm = $(this);
                    
                    var prozentSumme = 0;
                    
                    // get meilenstein ids
                    var meilensteinIds = new Array();
                    elm.find(".meilenstein.zuordnung li").each(function() {
                        meilensteinIds.push($(this).attr("data-meilenstein-id"));
                        prozentSumme += parseFloat($(this).attr("data-prozent"));
                    });
                    
                    elm.find(".prozent-summe").html(prozentSumme.toFixed(2));
                    
                    // set meileinstein ids
                    elm.find(".abschlag-zuordnungen").val(
                        meilensteinIds
                    );
                    
                });
            }
            
            $(".meilenstein").sortable2({
                group: "meilenstein",
                onDrop: function ($item, container, _super) {
                    updateMeilensteinZuordnungen();
                }
            });
    
        });
    ');
    ?>

    <div class="box-group col-sm-6" id="accordion">
        <div class="panel box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#collapse-meilenstein" href="#collapse-meilenstein"
                       aria-expanded="true" class="">
                        Meilensteine:
                    </a>
                </h4>
            </div>
            <div id="collapse-meilenstein" class="panel-collapse collapse in" aria-expanded="false">
                <div class="box-body">

                    <?php if($projekt->getProzentSummeMeilensteine() != 100): ?>
                        <div class="alert alert-danger fade in alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                            <strong>Wichtig!</strong> Die Summe von Prozent-Angaben müssen 100 sein.<br>
                            Aktuell: <?= $projekt->getProzentSummeMeilensteine() ?>
                        </div>
                    <?php endif; ?>

                    <?php $form = ActiveForm::begin([
                        'action' => ['projekt/update-meilensteine', 'id' => $projekt->id],
                        'enableClientScript' => false,
                        'options' => []
                    ]); ?>

                    <table class="table table-bordered">
                        <tr>
                            <th style="">Drag&Drop</th>
                            <th style="">Name</th>
<!--                            <th style="">Nummer</th>-->
                            <th>Prozent-Summe (%)</th>
                            <th style="width: 5%;">
                                <?= Html::a('<span class="fa fa-plus"> </span>',
                                    Yii::$app->urlManager->createUrl(["projekt/add-meilenstein", 'id' => $projekt->id]),
                                    ['class' => 'add-button add-meilenstein btn btn-success btn-xl']) ?>
                            </th>
                        </tr>
                        <?php foreach ($projekt->meilensteins as $key => $meilenstein): ?>
                            <tr>
                                <td>
                                    <ol class="meilenstein sortable">
                                        <?php if(!$meilenstein->projekt_abschlag_id): ?>
                                            <li data-meilenstein-id="<?= $meilenstein->id ?>" data-prozent="<?= $meilenstein->kaufvertrag_prozent ?>">
                                                <i class="glyphicon glyphicon-move"></i><?= $meilenstein->name ?>
                                            </li>
                                        <?php endif; ?>
                                    </ol>
                                </td>
                                <td>
                                    <div class="hide">
                                        <?= $form->field($meilenstein, "[$key]id")->hiddenInput() ?>
                                    </div>
                                    <?= $form->field($meilenstein, "[$key]name")->textInput([])->label(false) ?>
                                </td>
<!--                                <td>-->
<!--                                    --><?php //echo $form->field($meilenstein, "[$key]number")->textInput([])->label(false) ?>
<!--                                </td>-->
                                <td>
                                    <?= $form->field($meilenstein, "[$key]kaufvertrag_prozent")
                                        ->widget(\kartik\money\MaskMoney::classname(), [
                                            'options' => [
                                                'id' => $key . '-kaufvertrag_prozent-id',
                                                'style' => 'text-align: right'
                                            ],
                                        ])->label(false)
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if ($meilenstein->isDeletable()) {
                                            echo Html::a('<span class="fa fa-minus"></span>',
                                                Yii::$app->urlManager->createUrl(["projekt/delete-meilenstein", 'id' => $meilenstein->id]),
                                                ['class' => 'delete-button delete-meilenstein btn btn-danger btn-xl']
                                            );
                                        }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <tr>
                            <td>Summe</td>
                            <td></td>
<!--                            <td></td>-->
                            <td style="text-align: right;"><?= Yii::$app->formatter->asDecimal($projekt->getProzentSummeMeilensteine(), 2) ?></td>
                        </tr>

                    </table>


                    <div class="form-group" style="text-align: right;">
                        <?= Html::submitButton('Aktualisieren', ['class' => 'btn btn-primary', 'name' => 'submit']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
