<?php

use yii\helpers\Html;
use yii\grid\GridView;
use webvimark\modules\UserManagement\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjektSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projekte';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projekt-index">

    <?php if (User::hasPermission('write_projects')): ?>
        <p>
            <?= Html::a('Projekt erstellen', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'=>'{view}<br>{update}<br>{delete}<br>{pdf}',
                        'buttons' => [
                            'update' => function ($url, $model, $key) {
                                return User::hasPermission('write_projects') ? Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url) : '';
                            },
                            'delete' => function ($url, $model, $key) {
                                return User::hasPermission('write_projects') ?
                                    Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,
                                        [
                                            'data' => [
                                                'confirm' => 'Sind Sie sich sicher?',
                                                'method' => 'post',
                                            ],
                                        ]) : '';
                            },
                            'pdf' => function ($url, $model, $key) {
                                $url = \yii\helpers\Url::to(['pdf', 'id' => $model->id]);
                                return Html::a('<span class="glyphicon glyphicon-download"></span>', $url, ['target' => '_blank']);
                            }
                        ]

                    ],

                   // 'id',
                    'name',
                   // 'firma_id',
                    [
                        'attribute' => 'firma_name',
                        'value'=>'firma.name',
                        'label' => 'Firma'
                    ],
                    [
                        'attribute' => 'firma_nr',
                        'value'=>'firma.nr',
                        'label' => 'Buchungskr.'
                    ],
                    'strasse',
                    'hausnr',
                    'plz',
                    'ort',
                    //'mail_header',
                    //'mail_footer',

                ],
            ]); ?>

        </div>
    </div>
</div>
