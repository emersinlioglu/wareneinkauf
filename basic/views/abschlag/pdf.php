<?php
/** @var \app\models\Abschlag $abschlag */
?>

<div class="footer">
    <?= $abschlag->getPdfHeader() ?>
</div>

<div class="date" style="text-align: right;">
    <?= Yii::$app->formatter->asDate($abschlag->erstell_datum) ?>
    <br />
    <br />
</div>

<div class="content">
    <?= $abschlag->getPdfContent() ?>
</div>

<div class="footer" style="font-size: 9px; text-align: center; position: absolute; bottom: 40px; width: 85%;">
    <?= $abschlag->getPdfFooter() ?>
</div>