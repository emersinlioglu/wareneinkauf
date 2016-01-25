<?php
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;

/* @var $modelDatenblatt app\models\Datenblatt */
/* @var $modelNachlass app\models\Nachlass */
/* @var $form yii\bootstrap\ActiveForm */
?>


<div class="row">
    <div class="col-sm-8">
        <h3>Minderungen/Nachlass:</h3>
    </div>
    <div class="col-sm-3">
        <?php 
        $total = 0;
        foreach($modelDatenblatt->nachlasses as $item) {
            $total += $item->betrag;
        } ?>
        <h3>Summe: <?= Yii::$app->formatter->asCurrency($total) ?></h3>
    </div>
</div>
 
<div class="row">
    <div class="col-sm-3">
        <!--?= Html::submitButton('<span class="fa fa-plus"> Sonderwunsch hinzufügen</span>', ['class' => 'btn btn-success', 'name' => 'addSonderwunsch']) ?-->
        <?= Html::a('<span class="fa fa-plus"> Nachlass hinzufügen</span>',
            Yii::$app->urlManager->createUrl(["datenblatt/addnachlass", 'datenblattId' => $modelDatenblatt->id]), 
            ['class' => 'add-zahlung btn btn-danger btn-xl']) ?>
    </div>
</div>

<table class="table table-bordered">
    <tr>
        <th>Schreiben vom</th>
        <th>Betrag</th>
        <th>Bemerkung</th>
    </tr>
<?php 

$rechnungstellungBetrag = 0;

foreach($modelDatenblatt->nachlasses as $key => $modelNachlass): ?>
<tr class="sonderwunsch">
    <td>
        <div class="hide">
            <?= $form->field($modelNachlass, "[$key]id")->textInput() ?>
        </div>
        <?php
            $datum = DateTime::createFromFormat('Y-m-d H:i:s', $modelNachlass->schreiben_vom);
            if ($datum) {
                $datum = $datum->format('d.m.Y');
            } else {
                $datum = '';
            }
            //echo '<label>Übergang BNL:</label>';
            echo DateTimePicker::widget([
                'name' => "Nachlass[$key][schreiben_vom]",
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
        <?= $form->field($modelNachlass, "[$key]betrag")->textInput([]) ?>
    </td>
    <td>
        <?= $form->field($modelNachlass, "[$key]bemerkung")->textInput([]) ?>
    </td>
    <td>
        <?= Html::a('<span class="fa fa-minus"></span>', 
            Yii::$app->urlManager->createUrl(["datenblatt/deletenachlass", 'datenblattId' => $modelDatenblatt->id , 'nachlassId' => $modelNachlass->id]), 
            ['class' => 'add-zahlung btn btn-danger btn-xl']) ?>
    </td>
</tr>    
<?php endforeach;  ?>

</table>