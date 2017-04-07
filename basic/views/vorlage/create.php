<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Vorlage */

$this->title = 'Vorlage erstellen';
$this->params['breadcrumbs'][] = ['label' => 'Mail Vorlages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mail-vorlage-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
