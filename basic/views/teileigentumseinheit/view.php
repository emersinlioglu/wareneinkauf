<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Teileigentumseinheit */

$this->title = 'Teileigentumseinheit: ' . $model->te_nummer;
$this->params['breadcrumbs'][] = ['label' => 'Teileigentumseinheiten', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teileigentumseinheit-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<!--        --><?php //echo Html::a('Delete', ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => 'Are you sure you want to delete this item?',
//                'method' => 'post',
//            ],
//        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'haus_id',
            'einheitstyp_id',
            'te_nummer',
            'gefoerdert:boolean',
            'geschoss',
            'zimmer',
            'me_anteil:decimal',
            'wohnflaeche:decimal',
            'kaufpreis:currency',
            'kp_einheit:currency',
            [
                'attribute' => 'rechnung_vertrieb',
                'format' => 'boolean',
            ],
            [
                'attribute' => 'status',
                'value' => $model->getStatusLabel(),
            ],
        ],
    ]) ?>

    <div class="container-table zaehlerstand" id='zaehlerstand-id'>
        <h2>Zählerstand-Angaben:</h2>

        <table class="table no-label">
            <tr>
                <th style="width: 30%;">Medium-Name.</th>
                <th style="width: 30%;">Medium-Nr.</th>
                <th style="width: 20%;">Zählerstand</th>
                <th style="width: 20%;">Datum</th>
                <th style="width: 20%;">Abgemeldet</th>
            </tr>
            <?php
            /* @var $zaehlerstand app\models\Zaehlerstand */
            foreach ($model->zaehlerstands as $key => $zaehlerstand): ?>
                <tr>
                    <td><?= $zaehlerstand->name ?></td>
                    <td><?= $zaehlerstand->nummer ?></td>
                    <td><?= $zaehlerstand->stand ?></td>
                    <td><?= Yii::$app->formatter->asDatetime($zaehlerstand->datum, 'php:d.m.Y H:i') ?></td>
                    <td><?= $zaehlerstand->zaehler_abgemeldet ? 'ja' : 'nein' ?></td>
                </tr>
            <?php
            endforeach;
            ?>
        </table>

    </div>

</div>
