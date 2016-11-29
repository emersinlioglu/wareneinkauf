<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Haus */

$this->title = 'Teileigentumseinheit erstellen';
$this->params['breadcrumbs'][] = ['label' => 'Teileigentumseinheiten', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="haus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
