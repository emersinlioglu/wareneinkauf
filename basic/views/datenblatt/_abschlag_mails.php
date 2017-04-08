<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/** @var \app\models\Datenblatt $modelDatenblatt */
?>

<div class="col-md-6">
    <div class="box-group" id="accordion">
        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
        <div class="panel box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#collapse-abschlag-emails" href="#collapse-abschlag-emails"
                       aria-expanded="true" class="">
                        Abschlag-Emails:
                    </a>
                </h4>
            </div>
            <div id="collapse-abschlag-emails" class="panel-collapse collapse in" aria-expanded="false">
                <div class="box-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Erstelldatum</th>
                            <th>Mail versendet am</th>
                            <th colspan="3" class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="container-items">
                        <?php foreach ($modelDatenblatt->abschlags as $key => $abschlag): ?>
                            <tr class="abschlag-email-item">
                                <td class="vcenter">
                                    <?php echo $abschlag->id; ?>
                                </td>
                                <td class="vcenter">
                                    <?php echo $abschlag->name; ?>
                                </td>
                                <td class="vcenter erstell-datum">
                                    <?php echo Yii::$app->formatter->asDate($abschlag->erstell_datum, 'medium'); ?>
                                </td>
                                <td class="vcenter">
                                    <?php echo Yii::$app->formatter->asDatetime($abschlag->mail_gesendet, 'medium'); ?>
                                </td>
                                <td class="text-center vcenter" style="width: 90px;">
                                    <?php
                                        if ($abschlag->vorlage_id) {
                                            $url = \yii\helpers\Url::to(['abschlag/download-als-pdf',
                                                'abschlag' => $key,
                                                'vorlage' => $abschlag->vorlage_id,
                                                'datenblatt[]' => $modelDatenblatt->id,
                                            ]);
                                            echo Html::a('PDF', $url, ['target' => '_blank', 'class' => 'btn btn-primary']);
                                        }
                                    ?>
                                </td>
                                <td class="text-center vcenter" style="width: 90px;">
                                    <?php
                                        if (is_null($abschlag->mail_gesendet)) {
                                            $url = \yii\helpers\Url::to(['abschlag/update-abschlag-datum',
                                                'abschlag' => $key,
                                                'vorlage' => $abschlag->vorlage_id,
                                                'datenblatt[]' => $modelDatenblatt->id,
                                            ]);
                                            echo Html::a('Update Erstelldatum', $url, ['target' => '_blank', 'class' => 'update-erstelldatum btn btn-primary']);
                                        }
                                    ?>
                                </td>
                                <td class="text-center" style="width: 90px;">
                                    <?php
                                        if (is_null($abschlag->mail_gesendet)) {
//http://abg-projekt-manager.local/index.php?r=abschlag/send-abschlag-mails&abschlag=0&vorlage=1&datenblatt%5B%5D=35&datenblatt%5B%5D=34&datenblatt%5B%5D=33&datenblatt%5B%5D=31&datenblatt%5B%5D=30&datenblatt%5B%5D=29&datenblatt%5B%5D=28&datenblatt%5B%5D=27&datenblatt%5B%5D=26&datenblatt%5B%5D=12&datenblatt%5B%5D=35&datenblatt%5B%5D=34&datenblatt%5B%5D=33&datenblatt%5B%5D=31&datenblatt%5B%5D=30&datenblatt%5B%5D=29&datenblatt%5B%5D=28&datenblatt%5B%5D=27&datenblatt%5B%5D=26&datenblatt%5B%5D=12

                                            $url = \yii\helpers\Url::to(['abschlag/abschlag-mail-vorlage-form',
                                                'id' => $abschlag->id,
                                            ]);
                                            echo Html::a('Email senden', $url, ['target' => '_blank', 'class' => 'einzel-abschlag-email-senden btn btn-primary']);
                                        }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<button type="button" class="open-modal-btn btn btn-primary hide" data-toggle="modal" data-target="#exampleModal">Open modal</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Ergebnisse</h4>
            </div>
            <div class="modal-body">
                <!-- modal-body -->

                <p class="lade-icon">
                    <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Bitte warten...
                </p>

                <div class="message">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                <!--                <button type="button" class="btn btn-primary">Send message</button>-->
            </div>
        </div>
    </div>
</div>

