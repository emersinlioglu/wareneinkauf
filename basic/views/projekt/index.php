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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if (User::hasPermission('write_projects')): ?>
        <p>
            <?= Html::a('Projekt erstellen', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
                'label' => 'Firmen Nr.'
            ],
            'strasse',
            'hausnr',
            'plz',
            'ort',
            'mail_header',
            'mail_footer',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}<br>{update}<br>{delete}<br>{pdf}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return User::hasPermission('write_projects') ? Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url) : '';
                    },
                    'delete' => function ($url, $model, $key) {
                        return User::hasPermission('write_projects') ? Html::a('<span class="glyphicon glyphicon-trash"></span>', $url) : '';
                    },
                    'pdf' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['pdf', 'id' => $model->id]);
                        return Html::a('<span class="glyphicon glyphicon-download"></span>', $url, ['target' => '_blank']);
                    }
                ]

            ],
        ],
    ]); ?>

</div>
