<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Firma;
use yii\i18n\Formatter;
?>

<div class="datenblatt-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form', 
        'options'=>array(
            'class' => 'datenblatt-form'
        )
    ]); ?>

    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($modelDatenblatt, 'nummer')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($modelDatenblatt, 'firma_id')->dropDownList(ArrayHelper::map(Firma::find()->all(), 'id', 'name'), ['prompt'=>'Firma auswählen']) ?>
        </div>
        <div class="col-sm-2">
            <?php
                $projekte = $modelDatenblatt->firma ? $modelDatenblatt->firma->projekts : [];
                echo $form->field($modelDatenblatt, 'projekt_id')->dropDownList(ArrayHelper::map($projekte, 'id', 'name'), ['prompt'=>'Projekt auswählen']);
            ?>
        </div>
        <div class="col-sm-2">
            <?php   
                $haeuser = $modelDatenblatt->firma && $modelDatenblatt->projekt ? $modelDatenblatt->projekt->hauses : [];
                echo $form->field($modelDatenblatt, 'haus_id')->dropDownList(ArrayHelper::map($haeuser, 'id', 'id'), ['prompt'=>'Haus auswählen']);
            ?>
        </div>
    </div>
    
    <h3>Hause Details</h3>
    
    <div class="row">
        <div class="col-sm-3">
            Anschrift:
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            Straße + Hausnummer: 
        </div>
        <div class="col-sm-3">
            <?= $modelDatenblatt->haus ? $modelDatenblatt->haus->strasse : '' ?>
            <?= $modelDatenblatt->haus ? $modelDatenblatt->haus->hausnr : '' ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            PLZ/Ort: 
        </div>
        <div class="col-sm-3">
            <?= $modelDatenblatt->haus ? $modelDatenblatt->haus->plz : '' ?>
            <?= $modelDatenblatt->haus ? $modelDatenblatt->haus->ort : '' ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1">
            reserviert: 
        </div>
        <div class="col-sm-1">
            <?= $modelDatenblatt->haus ? ($modelDatenblatt->haus->reserviert ? 'ja' : 'nein') : '' ?><br>
        </div>
        <div class="col-sm-1">
            verkauft:
        </div>
        <div class="col-sm-1">
            <?= $modelDatenblatt->haus ? ($modelDatenblatt->haus->verkauft ? 'ja' : 'nein') : '' ?>
        </div>
        <div class="col-sm-2">
            Rechnung/Vertrieb:
        </div>
        <div class="col-sm-1">
            <?= $modelDatenblatt->haus ? ($modelDatenblatt->haus->rechnung_vertrieb ? 'ja' : 'nein') : '' ?>
        </div>
    </div>
    
    <h3>Beschreibung Teileigentumseinheit</h3>
    
    <table class="table">
        <tr>
            <th></th>
            <th>TE</th>
            <th>gefördert</th>
            <th>Geschoss</th>
            <th>Zimmer</th>
            <th>ME-Anteil</th>
            <th>Wohnfläche</th>
            <th>Kaufpreis</th>
            <th>KP/Einheit</th>
        </tr>
        <?php 
        /* @var $teileigentumseinheit app\models\Teileigentumseinheit */
        if ($modelDatenblatt->haus):
        foreach ($modelDatenblatt->haus->teileigentumseinheits as $teileigentumseinheit): ?>
            <tr>
                <td><?= $teileigentumseinheit->einheitstyp->name ?></td>
                <td><?= $teileigentumseinheit->te_nummer ?></td>
                <td><?= $teileigentumseinheit->gefoerdert ? 'ja' : 'nein' ?></td>
                <td><?= $teileigentumseinheit->geschoss ?></td>
                <td><?= $teileigentumseinheit->zimmer ?></td>
                <td><?= $teileigentumseinheit->me_anteil ?></td>
                <td><?= $teileigentumseinheit->wohnflaeche ?></td>
                <td>€ <?= number_format ((float)$teileigentumseinheit->kaufpreis, 2); ?></td>
                <td>€ <?= number_format ((float)$teileigentumseinheit->kp_einheit, 2); ?></td>
            </tr>
        <?php 
        endforeach; 
        endif;
        ?>
    </table>
        
    <h3>Zählerangaben</h3>
    
    <table class="table">
        <tr>
            <th>Medium-Nr.</th>
            <th>Zählerstand</th>
            <th>Datum</th>
        </tr>
        <?php 
        /* @var $zaehlerstand app\models\Zaehlerstand */
        if ($modelDatenblatt->haus):
        foreach ($modelDatenblatt->haus->zaehlerstands as $zaehlerstand): ?>
            <tr>
                <td><?= $zaehlerstand->name ?></td>
                <td><?= $zaehlerstand->stand ?></td>
                <td><?php 
                $datum = DateTime::createFromFormat('Y-m-d H:i:s', $zaehlerstand->datum);
                echo $datum->format('d.m.Y');
                ?>
                </td>
            </tr>
        <?php 
        endforeach; 
        endif;
        ?>
    </table>
    
    <?= $this->render('_zahlungen', [
            'form' => $form,
            'modelsZahlung'  => $modelsZahlung,
        ]) ?>

    
    <div class="form-group">
        <?= Html::submitButton($modelDatenblatt->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>