<?php 
use kartik\datetime\DateTimePicker;

/* @var $form yii\bootstrap\ActiveForm */
?>
    <h3>Käuferdaten</h3>
    
    <!--
 * @property integer $id
 * @property string $debitor_nr
 * @property string $beurkundung_am
 * @property string $verbindliche_fertigstellung
 * @property string $uebergang_bnl
 * @property string $abnahme_se
 * @property string $abnahme_ge
 * @property integer $auflassung
 * @property integer $anrede
 * @property string $titel
 * @property string $vorname
 * @property string $nachname
 * @property string $strasse
 * @property string $hausnr
 * @property string $plz
 * @property string $ort
 * @property string $festnetz
 * @property string $handy
 * @property string $email
-->
    
<!--
Käuferdaten							
Debitor-Nr.			123456				
Beurkundung am: 			1/1/2015				
Termine:            - verbindliche Fertigstellung			1/1/2018	 -Abnahme SE	1/1/2018	 - Auflassung	    X
		-Übergang BNL	1/1/2018	 -Abnahme GE	 01.01.2018		
Anrede 1, Titel 1, Vorname 1, Nachname 1			Herr	Dr.	Karl 	Mustermann	
Anrede 2, Titel 2, Vorname 2, Nachname 2			n.n.	n.n.	n.n.	n.n.	
Straße + Hausnummer			Musterstr. 7				
PLZ/Ort			80333	München			
Tel. Festnetz/mobil			089/24226		0123/456078		
E-Mail			karl.muster@tlin.de				
							
besondere Regelungen Kaufvertrag							
-->
		
<div class="row">
    <div class="col-sm-3">
        <?= $form->field($modelKaeufer, 'debitor_nr')->textInput(['maxlength' => true]) ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <?php
            $datum = DateTime::createFromFormat('Y-m-d H:i:s', $modelKaeufer->beurkundung_am);
            if ($datum) {
                $datum = $datum->format('d.m.Y');
            } else {
                $datum = '';
            }
            echo '<label>Beurkundung am:</label>';
            echo DateTimePicker::widget([
                'name' => "Kaeufer[beurkundung_am]",
                'options' => ['placeholder' => 'Datum auswählen'],
                'convertFormat' => true,
                'value' => $datum,
                'pluginOptions' => [
                    'minView' => 'month',
                    'maxView' => 'month',
                    'viewSelect' => 'month',
                    'format' => 'dd.mm.yyyy',
                    'autoclose' => true,
                    'todayHighlight' => true
                ]
            ]);
        ?>
    </div>
    <div class="col-sm-3">
        <?php
            $datum = DateTime::createFromFormat('Y-m-d H:i:s', $modelKaeufer->verbindliche_fertigstellung);
            if ($datum) {
                $datum = $datum->format('d.m.Y');
            } else {
                $datum = '';
            }
            echo '<label>verbindliche Fertigstellung:</label>';
            echo DateTimePicker::widget([
                'name' => "Kaeufer[verbindliche_fertigstellung]",
                'options' => ['placeholder' => 'Datum auswählen'],
                'convertFormat' => true,
                'value' => $datum,
                'pluginOptions' => [
                    'minView' => 'month',
                    'maxView' => 'month',
                    'viewSelect' => 'month',
                    'format' => 'dd.mm.yyyy',
                    'autoclose' => true,
                    'todayHighlight' => true
                ]
            ]);
        ?>
        <?php
            $datum = DateTime::createFromFormat('Y-m-d H:i:s', $modelKaeufer->uebergang_bnl);
            if ($datum) {
                $datum = $datum->format('d.m.Y');
            } else {
                $datum = '';
            }
            echo '<label>Übergang BNL:</label>';
            echo DateTimePicker::widget([
                'name' => "Kaeufer[uebergang_bnl]",
                'options' => ['placeholder' => 'Datum auswählen'],
                'convertFormat' => true,
                'value' => $datum,
                'pluginOptions' => [
                    'minView' => 'month',
                    'maxView' => 'month',
                    'viewSelect' => 'month',
                    'format' => 'dd.mm.yyyy',
                    'autoclose' => true,
                    'todayHighlight' => true
                ]
            ]);
        ?>
    </div>
    <div class="col-sm-3">
        <?php
            $datum = DateTime::createFromFormat('Y-m-d H:i:s', $modelKaeufer->abnahme_se);
            if ($datum) {
                $datum = $datum->format('d.m.Y');
            } else {
                $datum = '';
            }
            echo '<label>Abnahme SE:</label>';
            echo DateTimePicker::widget([
                'name' => "Kaeufer[abnahme_se]",
                'options' => ['placeholder' => 'Datum auswählen'],
                'convertFormat' => true,
                'value' => $datum,
                'pluginOptions' => [
                    'minView' => 'month',
                    'maxView' => 'month',
                    'viewSelect' => 'month',
                    'format' => 'dd.mm.yyyy',
                    'autoclose' => true,
                    'todayHighlight' => true
                ]
            ]);
        ?>
        <?php
            $datum = DateTime::createFromFormat('Y-m-d H:i:s', $modelKaeufer->abnahme_ge);
            if ($datum) {
                $datum = $datum->format('d.m.Y');
            } else {
                $datum = '';
            }
            echo '<label>Abnahme GE:</label>';
            echo DateTimePicker::widget([
                'name' => "Kaeufer[abnahme_ge]",
                'options' => ['placeholder' => 'Datum auswählen'],
                'convertFormat' => true,
                'value' => $datum,
                'pluginOptions' => [
                    'minView' => 'month',
                    'maxView' => 'month',
                    'viewSelect' => 'month',
                    'format' => 'dd.mm.yyyy',
                    'autoclose' => true,
                    'todayHighlight' => true
                ]
            ]);
        ?>
    </div>
    
    <div class="col-sm-3">
        <?= $form->field($modelKaeufer, 'auflassung')->checkbox([]) ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-3">
        <?= $form->field($modelKaeufer, 'anrede')->dropDownList([0 => 'Herr', 1 => 'Frau']) ?>
        <?= $form->field($modelKaeufer, 'titel')->textInput([]) ?>
        <?= $form->field($modelKaeufer, 'vorname')->textInput([]) ?>
        <?= $form->field($modelKaeufer, 'nachname')->textInput([]) ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($modelKaeufer, 'anrede2')->dropDownList([0 => 'Herr', 1 => 'Frau']) ?>
        <?= $form->field($modelKaeufer, 'titel2')->textInput([]) ?>
        <?= $form->field($modelKaeufer, 'vorname2')->textInput([]) ?>
        <?= $form->field($modelKaeufer, 'nachname2')->textInput([]) ?>
    </div>
    <div class="col-sm-3">
        <?= $form->field($modelKaeufer, 'strasse')->textInput([]) ?>
        <?= $form->field($modelKaeufer, 'hausnr')->textInput([]) ?>
        <?= $form->field($modelKaeufer, 'plz')->textInput([]) ?>
        <?= $form->field($modelKaeufer, 'ort')->textInput([]) ?>
    </div>
</div>    