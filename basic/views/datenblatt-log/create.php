<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DatenblattLog */

$this->title = 'Create Datenblatt Log';
$this->params['breadcrumbs'][] = ['label' => 'Datenblatt Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="datenblatt-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
