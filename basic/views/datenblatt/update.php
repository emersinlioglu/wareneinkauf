<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelDatenblatt app\models\Datenblatt */

$this->title = Yii::t('app', '{modelClass}-ID: ', [
        'modelClass' => 'Datenblatt',
    ]) . ' ' . $modelDatenblatt->id . ', Debitorennummer: ' . $modelDatenblatt->intern_debitor_nr;
//$this->title = '';
$url = ['/datenblatt'];
if ($modelDatenblatt->projekt) {
    $url['DatenblattSearch[projekt_name]'] = $modelDatenblatt->projekt->name;
}
$this->params['breadcrumbs'][] = ['label' => 'Datenblätter'];
$this->params['breadcrumbs'][] = ['label' => $modelDatenblatt->id, 'url' => ['view', 'id' => $modelDatenblatt->id]];

?>
<div class="datenblatt-update">

    <h3>Datenblatt Details</h3>

    <?= $this->render('_form', [
        'modelDatenblatt' => $modelDatenblatt,
        //'modelsZahlung'  => $modelsZahlungs,
        'modelKaeufer' => $modelKaeufer,

        'kaufpreisTotal' => $kaufpreisTotal,
        'sonderwuenscheTotal' => $sonderwuenscheTotal,
        'canEditBasicData' => $canEditBasicData,
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
