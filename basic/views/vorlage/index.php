<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'betreff',
//            'text:ntext',
            [
                'attribute' => 'text',
                'format' => 'raw',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>