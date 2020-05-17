<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArtikelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Artikels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artikel-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Artikel', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nummer',
            'bezeichnung',
            'seriennummer',
            'hersteller_artikelnr',
            // 'hersteller_id',
            // 'warenart_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
