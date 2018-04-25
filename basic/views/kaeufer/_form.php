<?php

use app\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Kaeufer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kaeufer-form">

    <div class="panel panel-default">
        <div class="panel-body" >

            <?php $form = ActiveForm::begin(); ?>

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
                    <h2>Projekt-Zuordungen</h2>

<br>
                    <?php
                        $kaeuferProjektErrors = $model->getErrors('kaeuferProjekts');
                        if (count($kaeuferProjektErrors)):
                        ?>
                            <span class="alert alert-danger"><?= $kaeuferProjektErrors[0] ?></span>
                    <?php endif; ?>

<br>
<br>
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
                                    <input name="KaeuferProjekt[]" value="<?= $kaeuferProjekt->projekt->id ?>" type="hidden">
                                    <?= $kaeuferProjekt->projekt->name ?>
                                </td>
                                <td>
                                    <span class="delete-button btn btn-danger btn-xl"><span class="fa fa-minus"></span></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
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
        
        var table = $('.kaeufer-projekts');
        
        $('[name="kaeuferProjektId"]').change(function() {
            var selectedOption = $(this).find('option:selected');
            var projektId = this.value;
            
            if (projektId == 0) { 
                return;
            }
            
            var searchProjektId = $('[name="KaeuferProjekt[]"][value="' + projektId + '"]');
            console.log(searchProjektId);
            console.log(searchProjektId.length);
            if (0 == searchProjektId.length) {
            
                var tr = $('<tr>');
                var td = $('<td>')
                    .append($('<input>').attr('name', 'KaeuferProjekt[]').attr('type', 'hidden').attr('value', projektId))
                    .append(selectedOption.text());
                tr.append(td);
                
                tr.append($('<td>').html('<span class="delete-button btn btn-danger btn-xl"><span class="fa fa-minus"></span></span>'));
                    
                table.append(tr);
            }
            
        });
        
        table.on('click', '.delete-button', function(){
            $(this).closest('tr').remove();
        });
    });
EOT
);
?>
