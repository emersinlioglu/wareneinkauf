<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TeileigentumseinheitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Forecast';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teileigentumseinheit-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'einheitstyp_id',
                'value' => 'einheitstyp.name',
                'label' => 'Einheitstyp',
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Einheitstyp::find()->all(), 'id', 'name')
            ],
            'te_nummer',
            'gefoerdert',
             'geschoss',
             'zimmer',
             'me_anteil',
             'wohnflaeche',
             'kaufpreis',
             'kp_einheit',
             'forecast_preis',
             'verkaufspreis',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
