<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Rechnung */

$this->title = 'Create Rechnung';
$this->params['breadcrumbs'][] = ['label' => 'Rechnungs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rechnung-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
