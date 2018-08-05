<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Konfiguration */

$this->title = 'Konfiguration erstellen';
$this->params['breadcrumbs'][] = ['label' => 'Konfigurations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="konfiguration-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
