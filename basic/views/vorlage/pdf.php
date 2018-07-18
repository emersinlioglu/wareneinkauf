<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vorlage */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Vorlagen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>

<div class="vorlage-view">

    <p>  
        <?= Html::decode($model->text) ?>            
    </p>

</div>