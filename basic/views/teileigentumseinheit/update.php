<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Teileigentumseinheit */

$this->title = 'Teileigentumseinheit: ' . ' ' . $model->te_nummer;
$this->params['breadcrumbs'][] = ['label' => 'Teileigentumseinheiten', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Aktualisieren';
?>
<div class="teileigentumseinheit-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
