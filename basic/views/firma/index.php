<?php

use yii\helpers\Html;
use yii\grid\GridView;
use webvimark\modules\UserManagement\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FirmaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Firmen';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="firma-index">

    <?php if (User::hasPermission('write_company')): ?>
        <p>
            <?= Html::a('Firma erstellen', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'name',
                   // 'nr',
                     [
                        'attribute' => 'nr',
                        'value'=>'nr',
                        'label' => 'Buchungskr.'
                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'buttons' => [
                            'update' => function ($url, $model, $key) {
                                return User::hasPermission('write_company') ? Html::a('Update', $url) : '';
                            },
                            'delete' => function ($url, $model, $key) {
                                return User::hasPermission('write_company') ? Html::a('Delete', $url, [
                                    'data' => [
                                        'confirm' => 'Sind Sie sich sicher?',
                                        'method' => 'post',
                                    ],
                                ]) : '';
                            }
                        ]
                    ],

                ],
            ]); ?>
        </div>
    </div>

</div>
