<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use webvimark\modules\UserManagement\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Kaeufer */

$this->title = 'Käufer: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Käufer', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kaeufer-view">

    <?php if (User::hasPermission('write_customer')): ?>
        <p>
            <?= Html::a('Aktualisieren', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php
//            echo Html::a('Löschen', ['delete', 'id' => $model->id], [
//                'class' => 'btn btn-danger',
//                'data' => [
//                    'confirm' => 'Sind Sie sich sicher, diesen Datensatz zu löschen?',
//                    'method' => 'post',
//                ],
//            ]) ?>
        </p>
    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'debitor_nr',
            // 'beurkundung_am',
            // 'verbindliche_fertigstellung',
            // 'uebergang_bnl',
            // 'abnahme_se',
            // 'abnahme_ge',
            // 'auflassung',
            //  'anrede',
            [
                'attribute' => 'anrede',
                'value' => $model->anrede == 1 ? 'Frau' : 'Herrn',
            ],
            'titel',
            'vorname',
            'nachname',
            [
                'attribute' => 'anrede2',
                'value' => $model->anrede2 == 1 ? 'Frau' : 'Herrn',
            ],
            'titel2',
            'vorname2',
            'nachname2',
            'strasse',
            'hausnr',
            'plz',
            'ort',
            'land',
            'festnetz',
            'handy',
            'email:email',
            //'anrede2',
            //'titel2',
            //'vorname2',
            //'nachname2',
        ],
    ]) ?>

    <h3>Zugeordnete Projekte</h3>
    <ul>
        <?php foreach($model->kaeuferProjekts as $kaeuferProjekt): ?>
            <li><?= $kaeuferProjekt->projekt->name ?></li>
        <?php endforeach; ?>
    </ul>

    <h3>Zugeordnete Teileigentumseinheiten</h3>
    <ul>
        <?php foreach($model->zugewieseneTeileigentumseinheiten as $te): ?>
            <li><?= $te->te_nummer ?></li>
        <?php endforeach; ?>
    </ul>

</div>
