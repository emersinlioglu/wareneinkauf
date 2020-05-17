<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RechnungSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rechnungs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rechnung-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rechnung', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'datum',
            'nummer',
            'lieferant_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
