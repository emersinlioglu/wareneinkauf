<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MailVorlage */

$this->title = 'Update Mail Vorlage: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mail Vorlages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mail-vorlage-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
