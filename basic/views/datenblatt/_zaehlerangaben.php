<?php 


?>

<h3>Zählerangaben</h3>
    
<table class="table">
    <tr>
        <th>Medium-Nr.</th>
        <th>Zählerstand</th>
        <th>Datum</th>
    </tr>
    <?php 
    /* @var $zaehlerstand app\models\Zaehlerstand */
    if ($modelDatenblatt->haus):
    foreach ($modelDatenblatt->haus->zaehlerstands as $zaehlerstand): ?>
        <tr>
            <td><?= $zaehlerstand->name ?></td>
            <td><?= $zaehlerstand->stand ?></td>
            <td><?php 
            $datum = DateTime::createFromFormat('Y-m-d H:i:s', $zaehlerstand->datum);
            echo $datum->format('d.m.Y');
            ?>
            </td>
        </tr>
    <?php 
    endforeach; 
    endif;
    ?>
</table>