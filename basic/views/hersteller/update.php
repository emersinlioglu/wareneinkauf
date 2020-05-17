<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Hersteller */

$this->title = 'Update Hersteller: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Herstellers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hersteller-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
