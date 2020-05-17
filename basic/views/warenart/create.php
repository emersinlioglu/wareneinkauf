<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Warenart */

$this->title = 'Create Warenart';
$this->params['breadcrumbs'][] = ['label' => 'Warenarts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warenart-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
