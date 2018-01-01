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

    <div class="row">
        <div class="col-sm-4">
            <?php  echo $this->render('_dynagrid_profile', [
                'dynagridProfileId' => $dynagridProfileId
            ]); ?>
        </div>
        <div class="col-sm-8">
            <?php  echo $this->render('_query_builder', [
//                'rules' => $rules,
//                'queryBuilderProfileId' => $queryBuilderProfileId,
            ]); ?>
        </div>
    </div>

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