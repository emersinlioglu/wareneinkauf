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
        <?= Html::a('<i class="fa  fa-print text-white"></i>   Drucken', ['report', 'id' => $model->id], [
            'class' => 'btn btn-info',
            'data' => [
                'class' => 'btn btn-info',
                'target' => '_blank',
                'data-toggle' => 'tooltip',
                'title' => 'Generate the pdf'
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
            [
                'attribute' => 'projekt.name',
                'label' => 'Projekt'
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
