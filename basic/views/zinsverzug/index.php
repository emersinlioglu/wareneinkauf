<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ZinsverzugSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Zinsverzugs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zinsverzug-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Zinsverzug', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'datenblatt_id',
            'schreiben_vom',
            'betrag',
            'bemerkung',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
