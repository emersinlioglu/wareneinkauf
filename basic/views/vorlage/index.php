<?php

use yii\helpers\Html;
use yii\grid\GridView;
//use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VorlageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vorlagen';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mail-vorlage-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <style>
        #myTextModal .modal-dialog {
            width: 900px;
        }
    </style>

    <p>
        <?= Html::a('Vorlage erstellen', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width: 70px;'],
            ],
            'name',
            'betreff',
            [
                'attribute' => 'text',
                'format' => 'raw',
//                '.\yii\helpers\StringHelper::truncate($model->text, 100).'
                'value' => function ($model) {
                    return '
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myTextModal">
                            Text
                        </button>
                        
                        <!-- Modal -->
                        <div id="myTextModal" class="modal large fade" role="dialog">
                          <div class="modal-dialog" width="900">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Modal Header</h4>
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
