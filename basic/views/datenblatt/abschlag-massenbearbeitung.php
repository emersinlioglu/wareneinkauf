<?php

use yii\widgets\ActiveForm;
use \yii\helpers\Html;

$this->title = 'Massenbearbeitung - Abschläge konfigurieren';

/** @var DAtenblatt $datenblatt */
?>

<?php
$this->registerJs('
    $(function(){
        new DatenblattMassenbearbeitungForm();
    });
');
?>
<style>
    .abschlag-tabelle.table > tbody > tr > td {
        vertical-align: middle;
    }
    .abschlag-tabelle tbody tr td:nth-child(3n) {
        width: 250px;
    }
    .projekt-meilensteine tr td:nth-child(2) {
        width: 250px;
    }
</style>

<div class="row">
    <div class="box-group col-sm-12" id="accordion">
        <div class="panel box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#collapse-datenblatts-zum-bearbeiten" href="#collapse-datenblatts-zum-bearbeiten" aria-expanded="true" class="">
                        Datenblätter zum Bearbeiten:
                    </a>
                </h4>
            </div>
            <div id="collapse-datenblatts-zum-bearbeiten" class="panel-collapse collapse in" aria-expanded="false">
                <div class="box-body">
                    <div class="alert alert-success col-sm-6">
                        <strong>Valide Datenblätter: </strong> <?php echo implode(', ', $valideDatenblattIds)?>
                    </div>
                    <div class="alert alert-danger col-sm-6">
                        <strong>Ignorierte Datenblätter: </strong> <?php echo implode(', ', $ignorierteDatenblattIds)?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                        'id' => 'abschlag-meileinstein-form',
                        'enableClientScript' => false,
                    ]); ?>

                        <table class="table table-bordered abschlag-tabelle" data-existing-abschlag-count="<?= $existingAbschlagCount ?>">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Prozent-Summe (%)</th>
                                    <th>Meilensteine</th>
                                    <th style="width: 5%;">
                                        <?php echo '<span class="add-button add-zahlung btn btn-success btn-xl"><span class="fa fa-plus"> </span></span>'; ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <ul>
                                            <?php foreach ($angeforderteAbschlagNamen as $abschlagName) { ?>
                                                <li><?= $abschlagName ?></li>
                                            <?php } ?>
                                        </ul>
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        <ul>
                                            <?php foreach ($angeforderteMeilensteine as $id => $meilensteinName) { ?>
                                                <li><?= $meilensteinName ?></li>
                                            <?php } ?>
                                        </ul>
                                    </td>
                                    <td>

                                    </td>
                                </tr>

                                <?php $startIndex = $existingAbschlagCount; ?>
                                <?php foreach ($abschlags as $key => $abschlag): ?>
                                    <tr data-is-editable="<?= $abschlag->isDeletable() ? 1 : 0 ?>">
                                        <td>
                                            <?= $form->field($abschlag, "[$startIndex]name")->textInput([])->label(false) ?>
                                        </td>
                                        <td class="prozent-summe" style="text-align: right;">
                                            <?php echo Yii::$app->formatter->asDecimal($abschlag->kaufvertrag_prozent, 2); ?>
                                        </td>
                                        <td style="width: 150px;">
                                            <ol class="sortable zuordnung meilenstein">

                                            </ol>

                                            <div class="">
                                                <?php echo Html::textInput("AbschlagMeilensteinZuordnung[$startIndex]", '', ['class' => 'abschlag-zuordnungen']) ?>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="delete-button btn btn-danger btn-xl">
                                                <span class="fa fa-minus"></span>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php $startIndex++; ?>
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

    <div class="box-group col-sm-6" id="accordion">
        <div class="panel box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#collapse-meilenstein" href="#collapse-meilenstein" aria-expanded="true" class="">
                        Meilensteine:
                    </a>
                </h4>
            </div>
            <div id="collapse-meilenstein" class="panel-collapse collapse in" aria-expanded="false">
                <div class="box-body">

                    <table class="table table-bordered projekt-meilensteine">
                        <tr>
                            <th style="">Drag&Drop</th>
                            <th style="">Name</th>
                            <th>Prozent-Summe (%)</th>
                        </tr>
                        <?php foreach ($projekt->meilensteins as $key => $meilenstein): ?>
                            <tr>
                                <td>
                                    <ol class="meilenstein sortable">
                                        <?php if(!in_array($meilenstein->id, array_keys($angeforderteMeilensteine))): ?>
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
                                    <?= $form->field($meilenstein, "[$key]name")->textInput(['disabled' => 'disabled'])->label(false) ?>
                                </td>
                                <td>
                                    <?= $form->field($meilenstein, "[$key]kaufvertrag_prozent")
                                        ->widget(\kartik\money\MaskMoney::classname(), [
                                            'options' => [
                                                'id' => $key . '-kaufvertrag_prozent-id',
                                                'style' => 'text-align: right',
                                                'disabled' => 'disabled'
                                            ],
                                        ])->label(false)
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <tr>
                            <td>Summe</td>
                            <td></td>
                            <td style="text-align: right;"><?= Yii::$app->formatter->asDecimal($projekt->getProzentSummeMeilensteine(), 2) ?></td>
                        </tr>

                    </table>

                </div>
            </div>
        </div>
    </div>

</div>


<table class="zeilenvorlage hide">
    <tr data-is-editable="1">
        <td>
            <div class="form-group field-abschlag-0-name has-success">
                <input type="text" id="abschlag-0-name" class="form-control" name="Abschlag[<<placeholder>>][name]" value="<<placeholder>>">
                <div class="help-block"></div>
            </div>
        </td>
        <td class="prozent-summe" style="text-align: right;">0.00</td>
        <td style="width: 150px;">
            <ol class="sortable zuordnung meilenstein">
            </ol>

            <div class="">
                <input type="text" class="abschlag-zuordnungen" name="AbschlagMeilensteinZuordnung[<<placeholder>>]" value="">
            </div>
        </td>
        <td>
            <span class="delete-button btn btn-danger btn-xl"><span class="fa fa-minus"></span></span>
        </td>
    </tr>
</table>

<div class="row">
    <div class="box-group col-sm-12" id="accordion">
        <div class="panel box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#collapse-selected-entities" href="#collapse-selected-entities" aria-expanded="true" class="">
                        Zusammenfassung der ausgewählten Datenblätter:
                    </a>
                </h4>
            </div>
            <div id="collapse-selected-entities" class="panel-collapse collapse in" aria-expanded="false">
                <div class="box-body">

                    <div class="row">
                        <?php
                            $dangerIcon = '<i class="fa fa-times text-danger" aria-hidden="true"></i>';
                            $checkIcon = '<i class="fa fa-check text-success" aria-hidden="true"></i>';
                        ?>
                        <div class="col-sm-6" style="font-size: 16px; font-weight: bold;">
                            <?= $dangerIcon ?> => Angefordert    <?= $checkIcon ?> => Nicht Angefordert
                        </div>
                    </div>
                    <br>

                    <?php foreach (array_chunk($selectedDatenblatts, 6) as $datenblattGroup) { ?>
                        <div class="row">
                            <?php foreach ($datenblattGroup as $datenblatt) { ?>
                                <div class="col-sm-2">
                                    <div class="box <?= in_array($datenblatt->id, $valideDatenblattIds) ? 'box-success' : 'box-danger' ?>">
                                        <div class="box-header with-border">
                                            <h5>
                                                <?= '<b>Datenblatt:</b> ' . $datenblatt->id . ' <br> <b>TE-Nummer:</b> ' . $datenblatt->getTenummerHtml() ?>
                                            </h5>
                                        </div>
                                        <div class="box-body">
                                            <ul>
                                                <?php foreach ($datenblatt->abschlags as $abschlag) { ?>
                                                    <li>
                                                        <b><?= $abschlag->name ?> <?= $abschlag->kaufvertrag_angefordert ? $dangerIcon : $checkIcon ?></b>
                                                        <ul>
                                                            <?php foreach ($abschlag->abschlagMeilensteins as $abschlagMeilenstein) { ?>
                                                                <li><?= $abschlagMeilenstein->meilenstein->name ?></li>
                                                            <?php } ?>
                                                        </ul>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div id="myModal" class="modal large fade" role="dialog">
    <div class="modal-dialog" style="width: 900px;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Bearbeitete Datenblätter</h4>
            </div>
            <div class="modal-body">
                <div class="links">

                </div>
                <br>
                <br>
                <p>
                    <a href="index.php?r=datenblatt/index"> >> Datenblätter</a>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>