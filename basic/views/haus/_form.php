<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Projekt;
use app\models\Einheitstyp;

/* @var $this yii\web\View */
/* @var $model app\models\Haus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="haus-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'projekt_id')->dropDownList(ArrayHelper::map(Projekt::find()->all(), 'id', 'name')) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'strasse')->textInput([]) ?>
            <?= $form->field($model, 'plz')->textInput([]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'hausnr')->textInput([]) ?>
            <?= $form->field($model, 'ort')->textInput([]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'reserviert')->checkbox([]) ?>
            <?= $form->field($model, 'verkauft')->checkbox([]) ?>
            <?= $form->field($model, 'rechnung_vertrieb')->checkbox([]) ?>
        </div>
    </div>
    
    <h2></h2>
    
    <table>
    <?php foreach($modelsTeilieigentum as $key => $modelTeilieigentum): ?>
        <tr>
            <td>
                <span class="hide">
                    <?= $form->field($modelTeilieigentum, 'id')
                        ->hiddenInput(['name' => "Teileigentumseinheiten[$key][id]"]) ?>
                    <?= $form->field($modelTeilieigentum, 'haus_id')
                        ->hiddenInput(['name' => "Teileigentumseinheiten[$key][haus_id]"]) ?>
                </span>
                <?= $form->field($modelTeilieigentum, 'einheitstyp_id')
                    ->dropDownList(ArrayHelper::map(Einheitstyp::find()->all(), 'id', 'name'), 
                            ['name' => "Teileigentumseinheiten[$key][einheitstyp_id]"]) ?>
            </td>

            <td><?= $form->field($modelTeilieigentum, 'te_nummer')->textInput(["maxlength" => true, 'name' => "Teileigentumseinheiten[$key][te_nummer]"]) ?></td>

            <td><?= $form->field($modelTeilieigentum, 'gefoerdert')->dropDownList([1 => 'Ja', 0 => 'Nein'], ['name' => "Teileigentumseinheiten[$key][gefoerdert]"]) ?></td>

            <td><?= $form->field($modelTeilieigentum, 'geschoss')->textInput(["maxlength" => true, 'name' => "Teileigentumseinheiten[$key][geschoss]"]) ?></td>

            <td><?= $form->field($modelTeilieigentum, 'zimmer')->textInput(["maxlength" => true, 'name' => "Teileigentumseinheiten[$key][zimmer]"]) ?></td>

            <td><?= $form->field($modelTeilieigentum, 'me_anteil')->textInput(["maxlength" => true, 'name' => "Teileigentumseinheiten[$key][me_anteil]"]) ?></td>

            <td><?= $form->field($modelTeilieigentum, 'wohnflaeche')->textInput(["maxlength" => true, 'name' => "Teileigentumseinheiten[$key][wohnflaeche]"]) ?></td>

            <td><?= $form->field($modelTeilieigentum, 'kaufpreis')->textInput(['name' => "Teileigentumseinheiten[$key][kaufpreis]"]) ?></td>

            <td><?= $form->field($modelTeilieigentum, 'kp_einheit')->textInput(['name' => "Teileigentumseinheiten[$key][kp_einheit]"]) ?></td>
            
            <td>
                <?= Html::a('Löschen', 
                    Yii::$app->urlManager->createUrl(["haus/deleteteileigentumseinheit", 'hausId' => $model->id , 'teileigentumseinheitId' => $modelTeilieigentum->id]), 
                    ['class' => 'btn btn-block btn-danger btn-flat']) ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>

    <div class="form-group">
        <?php if (!$model->isNewRecord): ?>
        <?= Html::submitButton('Teileigentumseinheit hinzufügen', ['class' => 'btn btn-success', 'name' => 'addnew']) ?>
        <?php endif; ?>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
