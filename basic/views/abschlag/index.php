<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Abschlags');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="abschlag-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Abschlag'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'datenblatt_id',
            'sonderwunch_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
