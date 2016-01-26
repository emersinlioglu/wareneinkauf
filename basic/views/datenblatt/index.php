<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Datenblatts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="datenblatt-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Datenblatt'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'firma_id',
//            'projekt_id',
//            'projekt.name',

            [
                'attribute' => 'projekt.name',
                'format' => 'raw',
                'filter'=> Html::textInput('DatenblattSearch[projektname]')
//                'value' => function ($model) {                      
//                    $str = '';
//                    if ($model->haus) {
//                        $haus = $model->haus;
//                        $str = $haus->strasse . ' ' . $haus->hausnr . ' ' . $haus->plz . ' ' . $haus->ort ;
//                    }
//                    return $str;
//                },
//                'label' => 'Hause-Adresse'
            ],
                
            [
                'attribute' => 'haus',
                'format' => 'raw',
                'value' => function ($model) {                      
                    $str = '';
                    if ($model->haus) {
                        $haus = $model->haus;
                        $str = $haus->strasse . ' ' . $haus->hausnr . ' ' . $haus->plz . ' ' . $haus->ort ;
                    }
                    return $str;
                },
                'label' => 'Hause-Adresse'
            ],
            'nummer',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
