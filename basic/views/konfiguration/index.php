<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use \app\models\KonfigurationTyp;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KonfigurationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Konfiguration';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="konfiguration-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <style>
        #myTextModal .modal-dialog {
            width: 900px;
        }
    </style>

    <p>
        <?= Html::a('Konfiguration erstellen', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
     //       ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width: 70px;'],
            ],
            [
                'attribute' => 'konfiguration_typ_id',
                'value' => 'konfigurationTyp.name',
                'filter' => ArrayHelper::map(KonfigurationTyp::find()->all(), 'id', 'name'),
            ],
            'name',
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'zustimmung',
                'vAlign' => 'middle',
                'trueLabel' => 'Ja',
                'falseLabel' => 'Nein',
                 //'filterType'=> GridView::FILTER_,
            ],
            [
                'class' => 'kartik\grid\DataColumn',
                'attribute' => 'deleted',
                'format' => ['date', 'php:d.m.Y'],
                'filterType' => '\kartik\datecontrol\DateControl'
            ],
            [
                'attribute' => 'text',
                'format' => 'raw',
//                '.\yii\helpers\StringHelper::truncate($model->text, 100).'
                'value' => function ($model) {
                    return '
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myTextModal-'.$model->id.'">
                            <span class="glyphicon glyphicon-eye-open"></span> Konfiguration
                        </button>
                        
                        <!-- Modal -->
                        <div id="myTextModal-'.$model->id.'" class="modal large fade" role="dialog">
                          <div class="modal-dialog" style="width: 900px;">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Konfiguration</h4>
                              </div>
                              <div class="modal-body">
                                '.$model->text.'
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                        
                          </div>
                        </div>
                    ';
                }
//                'detail' => 'adfasdfasdf'
            ],

        ],
    ]); ?>

</div>
