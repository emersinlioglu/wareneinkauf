<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RechnungItem */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rechnung Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rechnung-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'rechnung_id',
            'anzahl',
            'netto_einzel_betrag',
            'kunde_rechnungsnr',
            'bemerkung:ntext',
            'benutzernummer',
            'kunde_id',
            'artikel_id',
        ],
    ]) ?>

</div>
