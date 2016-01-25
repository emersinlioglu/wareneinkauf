<?php
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;

/* @var $modelDatenblatt app\models\Datenblatt */
/* @var $modelNachlass app\models\Nachlass */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="row">
    <div class="col-sm-8">
        <h3>Zahlungen:</h3>
    </div>
    <div class="col-sm-3">
        <?php 
        $total = 0;
        foreach($modelDatenblatt->zahlungs as $key => $modelZahlung) {
            $total += $modelZahlung->betrag;
        } ?>
        <h3>Summe: <?= Yii::$app->formatter->asCurrency($total) ?></h3>
    </div>
</div>
 
<div class="row">
    <div class="col-sm-9">
        <?= Html::a('<span class="fa fa-plus"> Zahlung hinzufügen</span>',
            Yii::$app->urlManager->createUrl(["datenblatt/addzahlung", 'datenblattId' => $modelDatenblatt->id]), 
            ['class' => 'add-zahlung btn btn-danger btn-xl']) ?>
    </div>
</div>

<table class="table table-bordered">
    <tr>
        <th>Datum</th>
        <th>Betrag</th>
        <th>Bemerkung</th>
    </tr>
<?php 

$rechnungstellungBetrag = 0;

foreach($modelDatenblatt->zahlungs as $key => $modelZahlung): ?>
<tr class="sonderwunsch">
    <td>
        <div class="hide">
            <?= $form->field($modelZahlung, "[$key]id")->textInput() ?>
        </div>
        <?php
            $datum = DateTime::createFromFormat('Y-m-d H:i:s', $modelZahlung->datum);
            if ($datum) {
                $datum = $datum->format('d.m.Y');
            } else {
                $datum = '';
            }
            //echo '<label>Übergang BNL:</label>';
            echo DateTimePicker::widget([
                'name' => "Zahlung[$key][datum]",
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
    </td>
    <td>
        <?= $form->field($modelZahlung, "[$key]betrag")->textInput([]) ?>
    </td>
    <td>
        <?= $form->field($modelZahlung, "[$key]bemerkung")->textInput([]) ?>
    </td>
    <td>
        <?= Html::a('<span class="fa fa-minus"></span>', 
            Yii::$app->urlManager->createUrl(["datenblatt/deletezahlung", 'datenblattId' => $modelDatenblatt->id , 'zahlungId' => $modelZahlung->id]), 
            ['class' => 'add-zahlung btn btn-danger btn-xl']) ?>
    </td>
</tr>    
<?php endforeach;  ?>

</table>