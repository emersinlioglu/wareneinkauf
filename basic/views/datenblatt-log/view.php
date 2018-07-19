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
            'projekt.name',
            'nummer',
            'kaeufer.vorname1',
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
            <th>Projekt</th>
            <th>Firma</th>
            <th>Firma-Nr</th>
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
                <td><?= $te->projekt ? $te->projekt->name : ''?></td>
                <td><?= $te->projekt && $te->projekt->firma ? $te->projekt->firma->name : ''?></td>
                <td><?= $te->projekt && $te->projekt->firma ? $te->projekt->firma->nr : ''?></td>
                <td><?= $te->status ?></td>
                <td><?= $te->gefoerdert ? 'ja' : 'nein' ?></td>
                <td><?= Yii::$app->formatter->asCurrency($te->kaufpreis) ?></td>
                <td><?= Yii::$app->formatter->asCurrency($te->kp_einheit) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>
