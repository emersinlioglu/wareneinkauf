<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Vorlage */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Vorlagen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="vorlage-view">

    <h3><?= Html::encode($model->name) ?></h3>

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
                'attribute' => 'vorlageTyp.name',
                'label' => 'Vorlagetyp'
            ],
            'name',
            'betreff',
//            'text:ntext',
            [
                'attribute' => 'text',
                'format' => 'raw'
            ]
        ],
    ]) ?>

</div>
