<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MailVorlage */

$this->title = 'Create Mail Vorlage';
$this->params['breadcrumbs'][] = ['label' => 'Mail Vorlages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mail-vorlage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
