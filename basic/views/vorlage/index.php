<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VorlageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vorlagen';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mail-vorlage-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Vorlage erstellen', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width: 70px;'],
            ],
            'name',
            'betreff',
            [
                'attribute' => 'text',
                'format' => 'raw',
//                'detail' => 'adfasdfasdf'
            ],

        ],
    ]); ?>

</div>
