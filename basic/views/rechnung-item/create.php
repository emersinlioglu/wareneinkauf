<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RechnungItem */

$this->title = 'Create Rechnung Item';
$this->params['breadcrumbs'][] = ['label' => 'Rechnung Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rechnung-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
