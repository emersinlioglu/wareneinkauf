<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Konfiguration */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Konfigurations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="konfiguration-view">

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
            [
                'attribute' => 'konfigurationTyp.name',
                'label' => 'Konfigurationtyp'
            ],            
            'name',
            'zustimmung:boolean',
            'deleted:date',
//            'text:ntext',
            [
                'attribute' => 'text',
                'format' => 'raw'
            ]
        ],
    ]) ?>

</div>
