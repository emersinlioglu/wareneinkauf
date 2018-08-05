<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\models\KonfigurationTyp;
use \yii\helpers\ArrayHelper;
use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model app\models\Konfiguration */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$this->registerJs('
    tinymce.init({ 
        selector:".tinymce",
        menubar:true,
        statusbar: false,
        plugins: "table",
        toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | fontsizeselect",
    });
');
?>

<div class="konfiguration-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'konfiguration_typ_id')->dropDownList(ArrayHelper::map(KonfigurationTyp::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zustimmung')->checkbox() ?>

    <?=   $form->field($model, 'deleted')->widget(DateControl::classname(),
                [
                    'type' => DateControl::FORMAT_DATE,
                    'displayFormat' => 'dd.MM.yyyy',
                    'options' => [
                        'pluginOptions' => [
                            'autoclose' => true
                        ]
                    ]
                ]
        );
    ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 24, 'class' => 'tinymce']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
