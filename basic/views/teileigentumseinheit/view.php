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
        ],
    ]) ?>

</div>
