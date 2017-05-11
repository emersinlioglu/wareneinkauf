<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
                    { text: "[projekt-name]", value: "[projekt-name]" },
                    { text: "[projekt-strasse]", value: "[projekt-strasse]" },
                    { text: "[projekt-ort]", value: "[projekt-ort]" },
                    { text: "[wohnung-nr]", value: "[wohnung-nr]" },
                    { text: "[kaufpreisabrechnung-kaufvertrag-in-prozent]", value: "[kaufpreisabrechnung-kaufvertrag-in-prozent]" },
                    { text: "[kaufpreisabrechnung-kaufvertrag-betrag]", value: "[kaufpreisabrechnung-kaufvertrag-betrag]" },
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
                ]
            });
        },
	});
');
?>

<div class="mail-vorlage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'betreff')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 24, 'class' => 'tinymce']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
