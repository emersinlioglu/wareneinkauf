<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vorlage */

$this->title = 'Vorlage bearbeiten: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mail Vorlages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mail-vorlage-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
