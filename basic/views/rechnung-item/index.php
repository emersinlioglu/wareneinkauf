<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RechnungItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rechnung Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rechnung-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rechnung Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'rechnung_id',
            'anzahl',
            'netto_einzel_betrag',
            'kunde_rechnungsnr',
            // 'kunde_id',
            // 'artikel_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
