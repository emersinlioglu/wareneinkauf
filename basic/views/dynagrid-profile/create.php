<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DynagridProfile */

$this->title = 'Profile erstellen';
$this->params['breadcrumbs'][] = ['label' => 'Dynagrid Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dynagrid-profile-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
