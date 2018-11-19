<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Kaeufer */

$this->title = 'Käufer erstellen';
$this->params['breadcrumbs'][] = ['label' => 'Käufer', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kaeufer-create">

    <?= $this->render('_form', [
        'model' => $model,
        'nichtgekauft' => $nichtgekauft,
    ]) ?>

</div>
