<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Projekt */

$this->title = 'Update Projekt: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projekte', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="projekt-update">

    <!-- <h1> <?//= Html::encode($this->title) ?> </h1> -->

    <?= Html::a(Yii::t('app', 'Konfiguration'), ['konfiguration', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Bestätigung</h4>
            </div>
            <div class="modal-body">
                <p>Möchten Sie die Änderung wirklich durchführen?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                <button type="button" class="btn btn-primary">Abschicken</button>
            </div>
        </div>
    </div>
</div>