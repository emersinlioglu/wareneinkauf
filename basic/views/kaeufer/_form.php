<?php

use app\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\models\Kaeufer;

/* @var $this yii\web\View */
/* @var $model app\models\Kaeufer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kaeufer-form">

    <div class="panel panel-default">
        <div class="panel-body">

            <?php $form = ActiveForm::begin([
                'id' => 'kaeufer-form',
                'options' => ['data-id' => $model->id],
            ]); ?>

            <div class="row">
                <div class="col-lg-6">

                    <h3>Kontaktdaten</h3>

                    <div class="row">
                        <div class="col-sm-6">
                            <?php //echo $form->field($model, 'debitor_nr')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'anrede')->dropDownList([0 => 'Herr', 1 => 'Frau'], ['prompt' => 'Auswählen']) ?>
                            <?= $form->field($model, 'titel')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'vorname')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'nachname')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'anrede2')->dropDownList([0 => 'Herr', 1 => 'Frau'], ['prompt' => 'Auswählen']) ?>
                            <?= $form->field($model, 'titel2')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'vorname2')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'nachname2')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <h3>Adresse</h3>

                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'strasse')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'plz')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'land')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Land::$laender, 'code', 'name'), ['prompt' => 'Auswählen']) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'hausnr')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'ort')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'festnetz')->textInput(['maxlength' => true])->widget(\yii\widgets\MaskedInput::className(), [
                                'mask' => '09999-9[9][9][9][9][9][9][9][9]',
                            ]) ?>
                            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'handy')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                </div>

                <div class="col-sm-6">
                    <h3>Projekt-Zuordnungen</h3>

                    <br>
                    <?php
                    $kaeuferProjektErrors = $model->getErrors('kaeuferProjekts');
                    if (count($kaeuferProjektErrors)):
                        ?>
                        <span class="alert alert-danger"><?= $kaeuferProjektErrors[0] ?></span>
                    <?php endif; ?>

                    <div class="form-group">
                        <?php
                        echo Html::dropDownList('kaeuferProjektId', null,
                            ArrayHelper::map(User::getProjects(), 'id', 'name'),
                            ['class' => 'form-control', 'prompt' => 'Projekt auswählen'])
                        ?>

                    </div>

                    <table class="table table-straped kaeufer-projekts">
                        <?php $accessableProjektIds = User::getAccessableProjektIds(); ?>
                        <?php foreach ($model->kaeuferProjekts as $kaeuferProjekt): ?>
                            <?php if (!in_array($kaeuferProjekt->projekt_id, $accessableProjektIds)) continue; ?>
                            <tr>
                                <td>
                                    <input name="KaeuferProjekt[]" value="<?= $kaeuferProjekt->projekt->id ?>"
                                           type="hidden">
                                    <?= $kaeuferProjekt->projekt->name ?>
                                </td>
                                <td>
                                    <span class="delete-button btn btn-danger btn-xl"><span class="fa fa-minus"></span></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>

                <div class="row <?= !User::hasRole('vertrieb_extern') || $model->id == null ? 'hide' : '' ?>">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>
                                Teileigentumseinheiten
                                <?php if(!$nichtgekauft):?>
                                    <span style="color: #f00;">sind bereits verkauft (nicht &auml;nderbar)</span>
                                <?php endif ?>
                            </label>
                            <?= Html::dropDownList('teileigentumseinheits', null,
                                ArrayHelper::map(Kaeufer::getFreieTeileigentumseinheiten(), 'id', 'te_nummer'),
                                ['prompt' => 'Bitte auswählen', 'class'=>'form-control']
                            );
                            ?>
                        </div>

                        <div class="">
                            <ul class="list-group">
                                <?php foreach ($model->zugewieseneTeileigentumseinheiten as $te): ?>
                                    <li class="list-group-item">
                                        <?= $te->te_nummer ?>
                                        <?= Html::a('<span class="fa fa-minus"></span>',
                                            ["unassign-teileigentumseinheit", 'kaeuferId' => $model->id, 'teId' => $te->id],
                                            ['class' => 'delete-button unassign-kaeufer pull-right btn btn-danger btn-xs']) ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Erstellen' : 'Aktualisieren', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

<?php
$this->registerJs(<<<EOT
    $(function(){
        new KaeuferForm();
    });
EOT
);
?>

