<?php
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;

/* @var $modelDatenblatt app\models\Datenblatt */
/* @var $form yii\bootstrap\ActiveForm */
?>

<h3>Sonderwünsche:</h3>
 
<div class="row">
    <div class="col-sm-3">
        <!--?= Html::submitButton('<span class="fa fa-plus"> Sonderwunsch hinzufügen</span>', ['class' => 'btn btn-success', 'name' => 'addSonderwunsch']) ?-->
        <?= Html::a('<span class="fa fa-plus"> Sonderwunsch hinzufügen</span>',
            Yii::$app->urlManager->createUrl(["datenblatt/addsonderwunsch", 'datenblattId' => $modelDatenblatt->id]), 
            ['class' => 'add-zahlung btn btn-danger btn-xl']) ?>
    </div>
</div>


<table class="table table-bordered">   
    <tr>
        <th></th>
        <th colspan="2" style="text-align: center;">Angebot</th>
        <th colspan="2" style="text-align: center;">beuaftragt</th>
        <th colspan="2" style="text-align: center;">Rechnungsstellung</th>
    </tr>
    <tr>
        <th>Name</th>
        <th>Angebot</th>
        <th>beuaftragt</th>
        <th>Rechnungsstellung</th>
    </tr>
<?php 
foreach($modelDatenblatt->sonderwunsches as $key => $modelSonderwunsch): ?>
<tr class="sonderwunsch">
    <td>
        <div class="hide">
            <?= $form->field($modelSonderwunsch, "[$key]id")->textInput() ?>
        </div>
        <?= $form->field($modelSonderwunsch, "[$key]name")->textInput([]) ?>
    </td>
    <td>
            <?php
                $datum = DateTime::createFromFormat('Y-m-d H:i:s', $modelSonderwunsch->angebot_datum);
                if ($datum) {
                    $datum = $datum->format('d.m.Y');
                } else {
                    $datum = '';
                }
                //echo '<label>Übergang BNL:</label>';
                echo DateTimePicker::widget([
                    'name' => "Sonderwunsch[$key][angebot_datum]",
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
        <?= $form->field($modelSonderwunsch, "[$key]angebot_betrag")->textInput([]) ?>
    </td>
    <td>
        <?php
            $datum = DateTime::createFromFormat('Y-m-d H:i:s', $modelSonderwunsch->beauftragt_datum);
            if ($datum) {
                $datum = $datum->format('d.m.Y');
            } else {
                $datum = '';
            }
            //echo '<label>Übergang BNL:</label>';
            echo DateTimePicker::widget([
                'name' => "Sonderwunsch[$key][beauftragt_datum]",
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
        <?= $form->field($modelSonderwunsch, "[$key]beauftragt_betrag")->textInput([]) ?>
    </td>
    <td>
        <?php
            $datum = DateTime::createFromFormat('Y-m-d H:i:s', $modelSonderwunsch->rechnungsstellung_datum);
            if ($datum) {
                $datum = $datum->format('d.m.Y');
            } else {
                $datum = '';
            }
            //echo '<label>Übergang BNL:</label>';
            echo DateTimePicker::widget([
                'name' => "Sonderwunsch[$key][rechnungsstellung_datum]",
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
        <?= $form->field($modelSonderwunsch, "[$key]rechnungsstellung_betrag")->textInput([]) ?>
    </td>
    <td>
        <?= $form->field($modelSonderwunsch, "[$key]rechnungsstellung_rg_nr")->textInput([]) ?>
    </td>
    <td>
        <?= Html::a('<span class="fa fa-minus"></span>', 
            Yii::$app->urlManager->createUrl(["datenblatt/deletesonderwunsch", 'datenblattId' => $modelDatenblatt->id , 'sonderwunschId' => $modelSonderwunsch->id]), 
            ['class' => 'add-zahlung btn btn-danger btn-xl']) ?>
    </td>
</tr>    
<?php endforeach;  ?>

</table>