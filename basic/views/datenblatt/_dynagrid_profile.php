<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>
<div class="box-group" id="accordion">
    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
    <div class="panel box box-primary">
        <div class="box-header with-border">
            <h4 class="box-title">
                <a data-toggle="collapse" data-parent="#collapse-querybuilder" href="#collapse-querybuilder" aria-expanded="true" class="">
                    Profile
                </a>
            </h4>
        </div>
        <div id="collapse-querybuilder" class="panel-collapse collapse in" aria-expanded="false">
            <div class="box-body">


                <div class="form-group field-dynagrid_profile_id col-sm-6">
                    <label class="control-label" for="projekt">Profile</label>
                    <?php
                    echo Html::dropDownList(
                        'dynagridProfileId',
                        $dynagridProfileId,
                        ArrayHelper::map(\app\models\DynagridProfile::find()->all(), 'id', 'name'),
                        [
                            //'prompt' => 'Bitte wählen',
                            'class' => "form-control"
                        ]
                    )
                    ?>
                </div>
                <div class="form-group col-sm-6 profile">
                    <label class="control-label">&nbsp;</label><br>
                    <?= Html::a('<span class="fa fa-plus"> </span>',
                        Yii::$app->urlManager->createUrl(["dynagrid-profile/create"]),
                        ['class' => 'add-dyngrid-profile btn btn-success']) ?>
                    <?= Html::a('<span class="fa fa-minus"></span>',
                        Yii::$app->urlManager->createUrl(["dynagrid-profile/delete", 'id' => '']),
                        ['class' => 'remove-dynagrid-profile btn btn-danger']) ?>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="dynagrid-profile-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">&nbsp;</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
            </div>
        </div>

    </div>
</div>
