<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Konfiguration */

$this->title = 'Update Konfiguration: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Konfigurations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="konfiguration-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
