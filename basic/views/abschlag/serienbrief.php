<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Vorlage;
use kartik\datecontrol\DateControl;

$this->title = 'Serienbriefe';
?>

<?php
$this->registerJs('
    $(function(){
        new Serienbrief();
    });'
);
?>

<div class="box-group" id="accordion">
    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
    <div class="panel box box-primary">
        <div class="box-header with-border">
            <h4 class="box-title">
                <a data-toggle="collapse" data-parent="#collapse-kaeuferdaten" href="#collapse-kaeuferdaten" aria-expanded="true" class="">
                    Ausgewählte Datenblätter (ID):
                </a>
            </h4>
        </div>
        <div id="collapse-kaeuferdaten" class="panel-collapse collapse in" aria-expanded="false">
            <div class="box-body">
                <?= implode(', ', $datenblattIds) ?>
            </div>
        </div>
    </div>
</div>

<div class="box-group" id="accordion">
    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
    <div class="panel box box-primary">
        <div class="box-header with-border">
            <h4 class="box-title">
                <a data-toggle="collapse" data-parent="#collapse-kaeuferdaten" href="#collapse-kaeuferdaten" aria-expanded="true" class="">
                    Aktualisieren:
                </a>
            </h4>
        </div>
        <div id="collapse-kaeuferdaten" class="panel-collapse collapse in" aria-expanded="false">
            <div class="box-body">

                <?php
                $form = ActiveForm::begin([
                    'action' => ['abschlag/update-abschlag-datum'],
                    'method' => 'post',
                    'options' => array(
                        'class' => 'updateAbschlagDatumForm',
                    )
                ]);
                ?>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label" for="datenblatt-firma_id">Abschlag</label>
                            <?= Html::dropDownList('abschlag', null, $abschlagOptions, ['prompt' => 'Bitte auswählen', 'class'=>'form-control']); ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <?= $form->field($abschlagModel, 'vorlage_id')->dropDownList(
                            ArrayHelper::map(Vorlage::findAll('1'), 'id', 'name'),
                            [
                                'class' => 'form-control',
                                'prompt'=>'Vorlage auswählen'
                            ]
                        ); ?>
                    </div>
                    <div class="col-sm-3">
                        <?php
                        echo $form->field($abschlagModel, "erstell_datum")->widget(DateControl::classname(), [
                            'type' => DateControl::FORMAT_DATE,
                            'options' => [
                                'pluginOptions' => [
                                    //'autoclose' => true
                                ]
                            ]
                        ]);
                        ?>
                    </div>
                    <div class="col-sm-6">
                        <b>Aktualisieren</b><br />
                        Das Erstelldatum und die Vorlage werden gesetzt, wenn keine Erinnerungsmail für den Abschlag bereits verschickt wurde.
                    </div>
                </div>

                <?php foreach ($datenblattIds as $datenblattId): ?>
                    <?= Html::hiddenInput('datenblatt[]', $datenblattId); ?>
                <?php endforeach; ?>

                <div class="row">
                    <div class="col-sm-6">
                        <?= Html::submitButton('Abschicken', ['name' => 'submit', 'value' => 'selection', 'class' => 'btn btn-primary']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>

<div class="box-group" id="accordion">
    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
    <div class="panel box box-primary">
        <div class="box-header with-border">
            <h4 class="box-title">
                <a data-toggle="collapse" data-parent="#collapse-kaeuferdaten" href="#collapse-kaeuferdaten" aria-expanded="true" class="">
                    Pdf herunterladen:
                </a>
            </h4>
        </div>
        <div id="collapse-kaeuferdaten" class="panel-collapse collapse in" aria-expanded="false">
            <div class="box-body">

                <?php
                $form = ActiveForm::begin([
                    'action' => ['abschlag/download-als-pdf'],
                    'method' => 'get',
                    'options' => array(
                        'class' => 'downloadAlsPdfForm',
                        'target'=>'_blank'
                    )
                ]);
                ?>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label" for="datenblatt-firma_id">Abschlag</label>
                            <?= Html::dropDownList('abschlag', null, $abschlagOptions, ['prompt' => 'Bitte auswählen', 'class'=>'form-control']); ?>
                        </div>
                    </div>
<!--                    <div class="col-sm-3">-->
<!--                        <div class="form-group">-->
<!--                            <label class="control-label" for="datenblatt-firma_id">Vorlage</label>-->
<!--                            --><?php //echo Html::dropDownList(
//                                'vorlage',
//                                null,
//                                ArrayHelper::map(Vorlage::findAll('1'), 'id', 'name'),
//                                [
//                                    'class' => 'form-control',
//                                    'prompt'=>'Vorlage auswählen'
//                                ]
//                            ); ?>
<!--                        </div>-->
<!--                    </div>-->
                    <div class="col-sm-6">
                        <b>Die Mails als Pdf herunterladen.</b><br>
                        Für die Abschläge, für die bereits eine E-Mail versendet wurde, wird keine E-Mail-Vorlage gesetzt.
                    </div>
                </div>

                <?php foreach ($datenblattIds as $datenblattId): ?>
                    <?= Html::hiddenInput('datenblatt[]', $datenblattId); ?>
                <?php endforeach; ?>

                <div class="row">
                    <div class="col-sm-6">
                        <?= Html::submitButton('Abschicken', ['name' => 'submit', 'value' => 'selection', 'class' => 'btn btn-primary']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>

<div class="box-group" id="accordion">
    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
    <div class="panel box box-primary">
        <div class="box-header with-border">
            <h4 class="box-title">
                <a data-toggle="collapse" data-parent="#collapse-kaeuferdaten" href="#collapse-kaeuferdaten" aria-expanded="true" class="">
                    E-Mail versenden:
                </a>
            </h4>
        </div>
        <div id="collapse-kaeuferdaten" class="panel-collapse collapse in" aria-expanded="false">
            <div class="box-body">

                <?php
                $form = ActiveForm::begin([
                    'action' => ['abschlag/send-abschlag-mails'],
                    'method' => 'post',
                    'options' => array(
                        'class' => 'sendAbschlagMailsForm',
                    )
                ]);
                ?>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label" for="datenblatt-firma_id">Abschlag</label>
                            <?= Html::dropDownList('abschlag', null, $abschlagOptions, ['prompt' => 'Bitte auswählen', 'class'=>'form-control']); ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label" for="datenblatt-firma_id">Vorlage</label>
                            <?= Html::dropDownList(
                                'vorlage', null,
                                ArrayHelper::map(Vorlage::findAll('1'), 'id', 'name'),
                                [
                                    'class' => 'form-control',
                                    'prompt'=>'Vorlage auswählen'
                                ]
                            ); ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <b>Mail versenden</b><br />
                        Das Erstellungsdatum wird auf das heutige Datum gesetzt, wenn keine E-Mail für den Abschlag bereits versendet wurde.
                    </div>
                </div>

                <?php foreach ($datenblattIds as $datenblattId): ?>
                    <?= Html::hiddenInput('datenblatt[]', $datenblattId); ?>
                <?php endforeach; ?>

                <div class="row">
                    <div class="col-sm-6">
                        <?= Html::submitButton('Abschicken', ['name' => 'submit', 'value' => 'selection', 'class' => 'btn btn-primary']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>


<button type="button" class="open-modal-btn btn btn-primary hide" data-toggle="modal" data-target="#exampleModal">Open modal</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Ergebnisse</h4>
            </div>
            <div class="modal-body">
                <!-- modal-body -->

                <p class="lade-icon">
                    <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Bitte warten...
                </p>

                <div class="message">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
<!--                <button type="button" class="btn btn-primary">Send message</button>-->
            </div>
        </div>
    </div>
</div>

<style>
    .glyphicon-refresh-animate {
        -animation: spin .7s infinite linear;
        -webkit-animation: spin2 .7s infinite linear;
    }

    @-webkit-keyframes spin2 {
        from { -webkit-transform: rotate(0deg);}
        to { -webkit-transform: rotate(360deg);}
    }

    @keyframes spin {
        from { transform: scale(1) rotate(0deg);}
        to { transform: scale(1) rotate(360deg);}
    }
</style>

