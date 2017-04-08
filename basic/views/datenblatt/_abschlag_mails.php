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
                            <th>Name</th>
                            <th>Gesendet am</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody class="container-items">
                        <?php foreach ($modelDatenblatt->abschlags as $key => $abschlag): ?>
                            <tr class="abschlag-email-item">
                                <td class="vcenter">
                                    Abschlag <?php echo $key+1; ?>
                                </td>
                                <td class="vcenter">
                                    <?php echo Yii::$app->formatter->asDatetime($abschlag->mail_gesendet, 'short'); ?>
                                </td>
                                <td class="text-center vcenter" style="width: 90px; verti">
                                    <?php
                                        if ($abschlag->vorlage_id) {
                                            $url = \yii\helpers\Url::to(['abschlag/download-als-pdf',
                                                'abschlag' => $key+1,
                                                'vorlage' => $abschlag->vorlage_id,
                                                'datenblatt[]' => $modelDatenblatt->id,
                                            ]);
                                            echo Html::a('PDF', $url, ['target' => '_blank', 'class' => 'btn btn-primary']);
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

