<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sim */

$this->title = Yii::t('app', 'Rechnung-Item importieren');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rechnung-Item importieren'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sim-create">

    <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Vorlage:</h4>
        Klicken Sie bitte auf <a href="/file/te-liste.xlsx">Download</a>, um die Import-Vorlage herunterzuladen.
    </div>

    <div class="panel panel-default" style="overflow-x: auto;">
        <div class="panel-body">

            <div class="sim-form">

                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                <?php if (count($errors)): ?>
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            <?php
                            foreach ($errors as $error) {
                                echo '<li>' . $error . '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group field-numbers">
                            <label class="control-label">Datei</label>
                            <?= Html::fileInput('file', null, ['class' => 'form-control']) ?>
                        </div>

                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('app', 'Import'), ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>

                    <?php if (count($fehlgeschlageneTeileigentumseinheiten) > 0): ?>
                        <div class="col-sm-9">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Zeile</th>
                                        <th>Hausnr.</th>
                                        <th>TE-Nummer</th>
                                        <th>Geschoss</th>
                                        <th>Zimmer</th>
                                        <th>Wohnfläche</th>
                                        <th>KP-Einheit (€/m²)</th>
                                        <th>Kaufspreis (Gesamt)</th>
                                        <th>ME-Anteil</th>
                                        <th>Valide</th>
                                    </tr>
                                </thead>
                                <?php /** @var $te \app\models\Teileigentumseinheit */ ?>
                                <?php foreach ($fehlgeschlageneTeileigentumseinheiten as $row => $te): ?>
                                    <tr>
                                        <td><?= $row ?></td>
                                        <td><?= $te->hausnr ?></td>
                                        <td><?= $te->te_nummer ?></td>
                                        <td><?= $te->geschoss ?></td>
                                        <td><?= $te->zimmer ?></td>
                                        <td><?= $te->wohnflaeche ?></td>
                                        <td><?= $te->kp_einheit ?></td>
                                        <td><?= $te->kaufpreis ?></td>
                                        <td><?= $te->me_anteil ?></td>
                                        <td>
                                            <?php if (count($te->errors) == 0) {
                                                echo '<span class="alert alert-success">ja</span>';
                                            } else {
                                                echo $form->errorSummary($te);
                                            }
                                        ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>

                        </div>
                    <?php endif; ?>

                </div>

                <?php ActiveForm::end(); ?>

            </div>

        </div>
    </div>
</div>
