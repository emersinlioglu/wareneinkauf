<?php
/** @var \app\models\Abschlag $abschlag */
?>

<div class="footer">
    <?= $abschlag->getPdfHeader() ?>
</div>

<div class="content">
    <?= $abschlag->getPdfContent() ?>
</div>

<div class="footer" style="font-size: 9px; text-align: center; position: absolute; bottom: 40px; width: 85%;">
    <?= $abschlag->getPdfFooter() ?>
</div>