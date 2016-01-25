<?php

?>

<h3>Beschreibung Teileigentumseinheit</h3>
    
<table class="table">
    <tr>
        <th></th>
        <th>TE</th>
        <th>gefördert</th>
        <th>Geschoss</th>
        <th>Zimmer</th>
        <th>ME-Anteil</th>
        <th>Wohnfläche</th>
        <th>Kaufpreis</th>
        <th>KP/Einheit</th>
    </tr>
    <?php 
    /* @var $teileigentumseinheit app\models\Teileigentumseinheit */
    if ($modelDatenblatt->haus):
    foreach ($modelDatenblatt->haus->teileigentumseinheits as $teileigentumseinheit): ?>
        <tr>
            <td><?= $teileigentumseinheit->einheitstyp->name ?></td>
            <td><?= $teileigentumseinheit->te_nummer ?></td>
            <td><?= $teileigentumseinheit->gefoerdert ? 'ja' : 'nein' ?></td>
            <td><?= $teileigentumseinheit->geschoss ?></td>
            <td><?= $teileigentumseinheit->zimmer ?></td>
            <td><?= $teileigentumseinheit->me_anteil ?></td>
            <td><?= $teileigentumseinheit->wohnflaeche ?></td>
            <td>€ <?= number_format ((float)$teileigentumseinheit->kaufpreis, 2); ?></td>
            <td>€ <?= number_format ((float)$teileigentumseinheit->kp_einheit, 2); ?></td>
        </tr>
    <?php 
    endforeach; 
    endif;
    ?>
</table>