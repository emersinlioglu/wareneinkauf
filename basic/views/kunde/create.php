<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Kunde */

$this->title = 'Create Kunde';
$this->params['breadcrumbs'][] = ['label' => 'Kundes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kunde-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
