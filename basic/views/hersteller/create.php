<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Hersteller */

$this->title = 'Create Hersteller';
$this->params['breadcrumbs'][] = ['label' => 'Herstellers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hersteller-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
