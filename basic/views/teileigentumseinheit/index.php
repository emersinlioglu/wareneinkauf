<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Teileigentumseinheits');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teileigentumseinheit-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Teileigentumseinheit'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'haus_id',
            'einheitstyp_id',
            'te_nummer',
            'gefoerdert',
            // 'geschoss',
            // 'zimmer',
            // 'me_anteil',
            // 'wohnflaeche',
            // 'kaufpreis',
            // 'kp_einheit',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
