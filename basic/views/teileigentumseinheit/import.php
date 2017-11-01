<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;
use \app\models\Customer;
use webvimark\modules\UserManagement\models\User;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Sim */

$this->title = Yii::t('app', 'Teileigentumseinheiten importieren');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sims'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sim-create">

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
                        <div class="form-group field-customer_id">
                            <label class="control-label" for="sim-card_number">Einheitstyp</label>
                            <?= Html::dropDownList(
                                'einheitstyp_id',
                                $einheitstyp_id,
                                ArrayHelper::map(\app\models\Einheitstyp::find()->all(), 'id', 'name'),
                                ['prompt' => 'Bitte wählen', 'class' => "form-control"]
                            )
                            ?>
                        </div>
                        <div class="form-group field-numbers">
                            <label class="control-label" for="sim-card_number">Datei</label>
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
                                        <th>TE-Nummer</th>
                                        <th>Geschoss</th>
                                        <th>Zimmer</th>
                                        <th>Wohnfläche</th>
                                        <th>Kaufspreis</th>
                                        <th>ME-Anteil</th>
                                        <th>Importiert</th>
                                    </tr>
                                </thead>
                                <?php /** @var $te \app\models\Teileigentumseinheit */ ?>
                                <?php foreach ($fehlgeschlageneTeileigentumseinheiten as $te): ?>
                                    <tr>
                                        <td><?= $te->te_nummer ?></td>
                                        <td><?= $te->geschoss ?></td>
                                        <td><?= $te->zimmer ?></td>
                                        <td><?= $te->wohnflaeche ?></td>
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
