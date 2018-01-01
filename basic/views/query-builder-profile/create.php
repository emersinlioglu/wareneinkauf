<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\QueryBuilderProfile */

$this->title = 'Create Query Builder Profile';
$this->params['breadcrumbs'][] = ['label' => 'Query Builder Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="query-builder-profile-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
