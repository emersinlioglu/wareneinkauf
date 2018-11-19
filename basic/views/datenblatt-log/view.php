<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DatenblattLog */

$this->title =  '';
$this->params['breadcrumbs'][] = ['label' => 'Datenblatt Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
?>
<div class="datenblatt-log-view">

    <p>
        <?= Html::a('Zurück', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'firma.name',
            [
                'attribute' => 'firma_nr',
                'value'=> $model->firma->nr,
                'label' => 'Buchungskr.'
            ],
            'projekt.name',
            [
                'value' => $model->kaeufer ? $model->kaeufer->anredeLabel : '',
                'label' => 'Käufer Anrede'
            ],
            [
                'attribute' => 'kaeufer_titel',
                'value' => $model->kaeufer ? $model->kaeufer->titel : '',
                'label' => 'Käufer Titel'
            ],
            [
                'attribute' => 'kaeufer_vorname',
                'value' => $model->kaeufer ? $model->kaeufer->vorname : '',
                'label' => 'Käufer Vorname'
            ],
            [
                'attribute' => 'kaeufer_nachname',
                'value' => $model->kaeufer ? $model->kaeufer->nachname : '',
                'label' => 'Käufer Name'
            ],
            [
                'value'=> $model->kaeufer ? $model->kaeufer->anrede2Label : '',
                'label' => '2. Käufer Anrede'
            ],
            [
                'attribute' => 'kaeufer_titel2',
                'value'=> $model->kaeufer ? $model->kaeufer->titel2 : '',
                'label' => '2. Käufer Titel'
            ],
            [
                'attribute' => 'kaeufer_vorname2',
                'value'=> $model->kaeufer ? $model->kaeufer->vorname2 : '',
                'label' => '2. Käufer Vorname'
            ],
            [
                'attribute' => 'kaeufer_nachname2',
                'value'=> $model->kaeufer ? $model->kaeufer->nachname2 : '',
                'label' => '2. Käufer Name'
            ],
            'besondere_regelungen_kaufvertrag:ntext',
            'sonstige_anmerkungen:ntext',
            'aktiv:boolean',
            [
                'label' => 'Beurkundung am',
                'value' => Yii::$app->formatter->asDate($model->beurkundung_am, 'medium'),
                'format' => 'html'
            ],
            'verbindliche_fertigstellung:date',
            'uebergang_bnl',
            'abnahme_se:date',
            'abnahme_ge:date',
            'auflassung',
            'createdBy.username',
            'sap_debitor_nr',
            'intern_debitor_nr',
            [
                'label' => 'Gelöscht durch',
                'value' => $model->deletedBy ? $model->deletedBy->username : '',
            ]
        ],
    ]) ?>

    <h3>Teileigentumseinheiten</h3>
    <table class="table table-striped">
        <tr>
            <th>Einheitstyp</th>
            <th>TE-Nr</th>
            <th>Status</th>
            <th>Gefördert</th>
            <th>Kaufpreis</th>
            <th>KP-Einheit</th>
        </tr>
        <?php /** @var $te \app\models\TeileigentumseinheitLog */ ?>
        <?php foreach($model->teileigentumseinheits as $te): ?>
            <tr>
                <td><?= $te->einheitstyp ?  $te->einheitstyp->name : '' ?></td>
                <td><?= $te->te_nummer ?></td>
                <td><?= $te->status ?></td>
                <td><?= $te->gefoerdert ? 'ja' : 'nein' ?></td>
                <td><?= Yii::$app->formatter->asCurrency($te->kaufpreis) ?></td>
                <td><?= Yii::$app->formatter->asCurrency($te->kp_einheit) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>
