<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kaeufer */

$kaeuferName1 = $model->vorname . ' ' . $model->nachname;
$kaeuferName2 = $model->vorname2 . ' ' . $model->nachname2;
if (strlen($kaeuferName2) > 1) {
    $kaeuferName1 .= ' & ' . $kaeuferName2;
}

$this->title = 'Käufer aktualisieren: (' . $kaeuferName1 . ')';
$this->params['breadcrumbs'][] = ['label' => 'Käufer', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Aktualisieren';
?>
<div class="kaeufer-update">

    <?= $this->render('_form', [
        'model' => $model,
        'nichtgekauft' => $nichtgekauft,
    ]) ?>

</div>
