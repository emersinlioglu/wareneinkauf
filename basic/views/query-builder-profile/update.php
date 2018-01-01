<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\QueryBuilderProfile */

$this->title = 'Update Query Builder Profile: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Query Builder Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="query-builder-profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
