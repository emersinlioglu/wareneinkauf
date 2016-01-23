<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Haus */

$this->title = Yii::t('app', 'Bearbeiten {modelClass}: ', [
    'modelClass' => 'Haus',
]) . ' ' . $model->id;
//$this->title = '';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hauses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="haus-update">

    <!--<h3><?= Html::encode($this->title) ?></h3>-->

    <?= $this->render('_form', [
        'model' => $model,
        'modelsTeilieigentum' => $modelsTeilieigentum
    ]) ?>

</div>
