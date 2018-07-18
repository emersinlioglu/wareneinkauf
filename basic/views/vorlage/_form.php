<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\models\VorlageTyp;
use \app\models\Projekt;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Vorlage */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$this->registerJs('
    tinymce.init({ 
    	selector:".tinymce",
		menubar:true,
		statusbar: false,
        plugins: "table",
        toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | fontsizeselect | platzhalter",
        
        setup: function (editor) {
            editor.addButton(\'platzhalter\', {
                type: \'listbox\',
                text: \'Platzhalter\',
                icon: false,
                onselect: function (e) {
                    editor.insertContent(this.value());
                },
                values: [
                    { text: "[briefanrede]", value: "[briefanrede]" },
                    { text: "[persoenliche-briefanrede]", value: "[persoenliche-briefanrede]" },
                    { text: "[projekt-name]", value: "[projekt-name]" },
                    { text: "[projekt-strasse]", value: "[projekt-strasse]" },
                    { text: "[projekt-ort]", value: "[projekt-ort]" },
                    { text: "[wohnung-nr]", value: "[wohnung-nr]" },
                    
                    { text: "[nachlass-summe]", value: "[nachlass-summe]" },
                    { text: "[kaufpreis-gesamt]", value: "[kaufpreis-gesamt]" },
                    { text: "[gesamtforderung]", value: "[gesamtforderung]" },
                    
                    { text: "[kaufpreisabrechnung-kaufvertrag-in-prozent]", value: "[kaufpreisabrechnung-kaufvertrag-in-prozent]" },
                    { text: "[kaufpreisabrechnung-kaufvertrag-betrag]", value: "[kaufpreisabrechnung-kaufvertrag-betrag]" },
                    { text: "[kaufpreisabrechnung-kaufvertrag-betrag-in-worten]", value: "[kaufpreisabrechnung-kaufvertrag-betrag-in-worten]" },
                    { text: "[erstell-datum]", value: "[erstell-datum]" },
                    { text: "[abschlag-nr]", value: "[abschlag-nr]" },
                    { text: "[debitor-nr]", value: "[debitor-nr]" },
//                    { text: "[kaeufer-anrede]", value: "[kaeufer-anrede]" },
//                    { text: "[kaeufer-vorname]", value: "[kaeufer-vorname]" },
//                    { text: "[kaeufer-nachname]", value: "[kaeufer-nachname]" },
                    { text: "[kaeufer]", value: "[kaeufer]" },
                    { text: "[kaeufer-strasse]", value: "[kaeufer-strasse]" },
                    { text: "[kaeufer-strassen-nr]", value: "[kaeufer-strassen-nr]" },
                    { text: "[kaeufer-plz]", value: "[kaeufer-plz]" },
                    { text: "[kaeufer-ort]", value: "[kaeufer-ort]" },
                    
                    { text: "[tenummer-stellplatz]", value: "[tenummer-stellplatz]" },
                    { text: "[tenummer-stellplatz-2]", value: "[tenummer-stellplatz-2]" },
                    { text: "[tenummer-lagerraum]", value: "[tenummer-lagerraum]" },
                    { text: "[tenummer-garage]", value: "[tenummer-garage]" },
                    { text: "[tenummer-aussenstellplatz]", value: "[tenummer-aussenstellplatz]" },
                    { text: "[tenummer-keller]", value: "[tenummer-keller]" },
                    { text: "[einheitstypname-stellplatz]", value: "[einheitstypname-stellplatz]" },
                    { text: "[einheitstypname-lagerraum]", value: "[einheitstypname-lagerraum]" },
                    { text: "[einheitstypname-garage]", value: "[einheitstypname-garage]" },
                    { text: "[einheitstypname-aussenstellplatz]", value: "[einheitstypname-aussenstellplatz]" },
                    { text: "[einheitstypname-keller]", value: "[einheitstypname-keller]" },
                    { text: "[sonderwuensche-zusammenfassung]", value: "[sonderwuensche-zusammenfassung]" },
                    { text: "[sonderwuensche-gesamtbetrag]", value: "[sonderwuensche-gesamtbetrag]" },
                    { text: "[aktuelles-datum]", value: "[aktuelles-datum]" },
                    { text: "[offene-posten]", value: "[offene-posten]" },
                    { text: "[meilensteine]", value: "[meilensteine]" },
                    { text: "[offene-posten-schlussrechnung-abzg-nachlass]", value: "[offene-posten-schlussrechnung-abzg-nachlass]" },
                    { text: "[zahlungen-gesamt]", value: "[zahlungen-gesamt]" },
                    { text: "[schlussrechnung-offener-gesamtbetrag]", value: "[schlussrechnung-offener-gesamtbetrag]" },
                ]
            });
        },
	});
');
?>

<div class="mail-vorlage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'vorlage_typ_id')->dropDownList(ArrayHelper::map(VorlageTyp::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'projekt_id')->dropDownList(ArrayHelper::map(Projekt::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'betreff')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 24, 'class' => 'tinymce']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
