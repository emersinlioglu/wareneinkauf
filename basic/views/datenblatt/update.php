<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Datenblatt */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Datenblatt',
]) . ' ' . $modelDatenblatt->id;
//$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Datenblätter', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelDatenblatt->id, 'url' => ['view', 'id' => $modelDatenblatt->id]];

?>
<div class="datenblatt-update">

    <h3>Datenblatt Details</h3>

    <?= $this->render('_form', [
        'modelDatenblatt' => $modelDatenblatt,
        //'modelsZahlung'  => $modelsZahlungs,
        'modelKaeufer' => $modelKaeufer,

        'kaufpreisTotal' => $kaufpreisTotal,
        'sonderwuenscheTotal' => $sonderwuenscheTotal,
    ]) ?>

</div>

