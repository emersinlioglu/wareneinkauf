<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HausSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Hauses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="haus-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Haus'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'projekt_id',
            'plz',
            'ort',
            'strasse',
            // 'hausnr',
            // 'reserviert',
            // 'verkauft',
            // 'rechnung_vertrieb',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
