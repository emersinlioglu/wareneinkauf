<?php

use webvimark\modules\UserManagement\models\User;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
//use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\DatenblattSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Datenblätter in ' . $projekt->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$this->registerJs('
    $(function(){
        new DynagridProfileForm();
    });
');
?>

<div class="datenblatt-index">

    <?php if (User::hasPermission('write_datasheets')): ?>
        <p>
            <?= Html::a('Datenblatt erstellen', ['create', 'projektId' => $projekt->id], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <div class="panel panel-default">
        <div class="panel-body">

        <div class="row">
            <div class="form-group field-dynagrid_profile_id col-sm-2">
                <label class="control-label" for="projekt">Profil</label>
                <?= Html::dropDownList(
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
            <div class="form-group col-sm-2 profile">
                <label class="control-label">&nbsp;</label><br>
                <?= Html::a('<span class="fa fa-plus"> </span>',
                    Yii::$app->urlManager->createUrl(["dynagrid-profile/create"]),
                    ['class' => 'add-dyngrid-profile btn btn-success']) ?>
                <?= Html::a('<span class="fa fa-minus"></span>',
                    Yii::$app->urlManager->createUrl(["dynagrid-profile/delete", 'id' => '']),
                    ['class' => 'remove-dynagrid-profile btn btn-danger']) ?>
            </div>
        </div>

    <!--
            <div class="col-md-5 col-sm-6 col-xs-12" style="float: none;">
            <div class="info-box">

                <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-number"><h4>Serienbrief Datenquelle Export</h4></span>

                    <?php
                        /*
                        echo $this->render('_gridexport', [
                            'dataProvider' => $dataProvider,
                            'searchModel' => $searchModel,
                            'maxCountTEEinheits' => $maxCountTEEinheits,
                            'maxCountSonderwunsches' => $maxCountSonderwunsches,
                            'maxCountAbschlags' => $maxCountAbschlags,
                            'maxCountNachlasses' => $maxCountNachlasses,
                            'maxCountZahlungs' => $maxCountZahlungs,
                            ]);
                        */
                    ?>

                </div>
            </div>

    -->
        </div>

        <?php
        /*
            if (User::hasPermission('export')) {
                echo $this->render('_gridexport', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                    'maxCountTEEinheits' => $maxCountTEEinheits,
                    'maxCountSonderwunsches' => $maxCountSonderwunsches,
                    'maxCountAbschlags' => $maxCountAbschlags,
                    'maxCountNachlasses' => $maxCountNachlasses,
                    'maxCountZahlungs' => $maxCountZahlungs,
                    ]);

            }
        */
        ?>

        <?php  echo $this->render('_dynagrid', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'maxCountTEEinheits' => $maxCountTEEinheits,
            'maxCountSonderwunsches' => $maxCountSonderwunsches,
            'maxCountAbschlags' => $maxCountAbschlags,
            'maxCountNachlasses' => $maxCountNachlasses,
            'maxCountZinsverzugs' => $maxCountZinsverzugs,
            'maxCountZahlungs' => $maxCountZahlungs,
            'dynagridProfileId' => $dynagridProfileId,
        ]); ?>

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
