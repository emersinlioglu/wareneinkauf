<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Projekt */

$this->title = Yii::t('app', 'Create Projekt');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projekts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projekt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
