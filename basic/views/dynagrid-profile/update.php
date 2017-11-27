<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DynagridProfile */

$this->title = 'Update Dynagrid Profile: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Dynagrid Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dynagrid-profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
