<?php
use yii\helpers\Html;
//use kartik\datetime\DateTimePicker;
use kartik\datecontrol\DateControl;
use yii\widgets\Pjax;
use kartik\money\MaskMoney;

/* @var $modelDatenblatt app\models\Datenblatt */
/* @var $modelNachlass app\models\Nachlass */
/* @var $form yii\bootstrap\ActiveForm */
?>
<style>
    /*#collapse-entschaedigung .control-label {*/
        /*display: none;*/
    /*}*/
</style>
<div class="box-group" id="accordion">
    <div class="panel box box-primary">
        <div class="box-header with-border">
            <h4 class="box-title">
                <a data-toggle="collapse" data-parent="#collapse-protokoll" href="#collapse-protokoll" aria-expanded="true" class="">
                    Protokoll
                </a>
            </h4>
        </div>
        <div id="collapse-protokoll" class="panel-collapse collapse in" aria-expanded="false">
            <div class="box-body">

                <div class="row">
                    <div class="col-lg-12">
                        <label>Neue Bemerkung</label>
                        <?= Html::textarea('newProtokoll', null, ['style' => 'width: 100%', 'rows' => 6]) ?>
                    </div>
                </div>

                <table class="table table-bordered">
                    <colgroup>
                        <col style="width:10%">
                        <col style="width:10%">
                        <col style="width:60%">
                        <col style="width:5%;">
                    </colgroup>
                    <tr>
                        <th>Datum</th>
                        <th>Benutzer</th>
                        <th>Bemerkung</th>
                        <th style="text-align: right;">
                            <?= Html::a('<span class="fa fa-plus"> </span>',
                                Yii::$app->urlManager->createUrl(["datenblatt/add-protokoll", 'datenblattId' => $modelDatenblatt->id]),
                                ['class' => 'add-button add-protokoll btn btn-success btn-xl']) ?>
                        </th>
                    </tr>

                    <style>
                        .protokol-modal .modal-dialog {
                            width: 1200px;
                        }
                    </style>

                    <?php
                    foreach ($modelDatenblatt->protokolls as $key => $modelProtokoll): ?>
                        <tr class="protokoll">
                            <td>
                                <?= Yii::$app->formatter->asDatetime($modelProtokoll->erstellt_am, 'php:d.m.Y H:i') ?>
                            </td>
                            <td>
                                <?= $modelProtokoll->user->username ?>
                            </td>
                            <td>
                                <?php if (strlen($modelProtokoll->bemerkung) > 0): ?>
                                    <a href="#" type="button" class="" data-toggle="modal" data-target="#myModal-<?= $modelProtokoll->id ?>">
                                        <?= strlen($modelProtokoll->bemerkung) > 500 ? substr($modelProtokoll->bemerkung, 0, 500) . ' ...' : $modelProtokoll->bemerkung ?>
                                    </a>
                                    <div class="protokol-modal modal fade" id="myModal-<?= $modelProtokoll->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <?= $modelProtokoll->bemerkung ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: right;">
                                <?php
                                if ($modelProtokoll->user_id == \app\models\User::getCurrentUser()->id) {
                                    echo Html::a('<span class="fa fa-minus"></span>',
                                        Yii::$app->urlManager->createUrl(["datenblatt/delete-protokoll", 'datenblattId' => $modelDatenblatt->id, 'protokollId' => $modelProtokoll->id]),
                                        ['class' => 'delete-button add-protokoll btn btn-danger btn-xl']);
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </table>

            </div>
        </div>
    </div>
</div>


