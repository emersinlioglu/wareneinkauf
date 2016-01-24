<?php
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;

/* @var $modelDatenblatt app\models\Datenblatt */
/* @var $form yii\bootstrap\ActiveForm */
?>

<h3>Kaufpreisabrechnung:</h3>
 
<div class="row">
    <div class="col-sm-3">
        <!--?= Html::submitButton('<span class="fa fa-plus"> Sonderwunsch hinzufügen</span>', ['class' => 'btn btn-success', 'name' => 'addSonderwunsch']) ?-->
        <?= Html::a('<span class="fa fa-plus"> Zahlung hinzufügen</span>',
            Yii::$app->urlManager->createUrl(["datenblatt/addabschlag", 'datenblattId' => $modelDatenblatt->id]), 
            ['class' => 'add-zahlung btn btn-danger btn-xl']) ?>
    </div>
</div>


<table class="table table-bordered">   
    <tr>
        <th>Bezeichnung</th>
        <th colspan="3" >Kaufvertrag</th>
        <th colspan="3" >beuaftragt</th>
        <th >Summe</th>
<!--        <th colspan="2" style="text-align: center;">Angebot</th>
        <th colspan="2" style="text-align: center;">beuaftragt</th>
        <th colspan="3" style="text-align: center;">Rechnungsstellung</th>-->
    </tr>
    <tr>
        <th></th>
        <th>- in %</th>
        <th>-Betrag</th>
        <th>-angefordert</th>
        <th>- in %</th>
        <th>-Betrag</th>
        <th>-angefordert</th>
        <th></th>
    </tr>
<?php 

$rechnungstellungBetrag = 0;

foreach($modelDatenblatt->abschlags as $key => $modelAbschlag): ?>
<tr class="sonderwunsch">
    <td>
        <div class="hide">
            <?= $form->field($modelAbschlag, "[$key]id")->textInput() ?>
        </div>
        <?= $form->field($modelAbschlag, "[$key]name")->textInput([]) ?>
    </td>
    <td>
        <?= $form->field($modelAbschlag, "[$key]kaufvertrag_prozent")->textInput([]) ?>
    </td>
    <td>
        Betrag
    </td>
    <td>
        <?php
            $datum = DateTime::createFromFormat('Y-m-d H:i:s', $modelAbschlag->kaufvertrag_angefordert);
            if ($datum) {
                $datum = $datum->format('d.m.Y');
            } else {
                $datum = '';
            }
            //echo '<label>Übergang BNL:</label>';
            echo DateTimePicker::widget([
                'name' => "Abschlag[$key][kaufvertrag_angefordert]",
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
        <?= $form->field($modelAbschlag, "[$key]sonderwunsch_prozent")->textInput([]) ?>
    </td>
    <td>
        Betrag
    </td>
    <td>
        <?php
            $datum = DateTime::createFromFormat('Y-m-d H:i:s', $modelAbschlag->sonderwunsch_angefordert);
            if ($datum) {
                $datum = $datum->format('d.m.Y');
            } else {
                $datum = '';
            }
            //echo '<label>Übergang BNL:</label>';
            echo DateTimePicker::widget([
                'name' => "Abschlag[$key][sonderwunsch_angefordert]",
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
        Summe
    </td>
    <td>
        <?= Html::a('<span class="fa fa-minus"></span>', 
            Yii::$app->urlManager->createUrl(["datenblatt/deleteabschlag", 'datenblattId' => $modelDatenblatt->id , 'abschlagId' => $modelAbschlag->id]), 
            ['class' => 'add-zahlung btn btn-danger btn-xl']) ?>
    </td>
</tr>    
<?php endforeach;  ?>
<tr>
    <td>Summe</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td><?= $rechnungstellungBetrag ?></td>
    <td></td>
    <td></td>    
</tr>

</table>