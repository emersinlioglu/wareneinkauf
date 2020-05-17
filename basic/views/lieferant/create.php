<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Lieferant */

$this->title = 'Create Lieferant';
$this->params['breadcrumbs'][] = ['label' => 'Lieferants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lieferant-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
