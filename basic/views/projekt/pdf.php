<?php
use app\models\ProjektSearch;
use \app\models\Einheitstyp;
?>

<h3>Verkaufs- u. Reservierungsstatus:</h3>

<table class="table table-bordered projects">
    <thead>
    <tr>
        <th></th>
        <th bgcolor="#f2f2f2">Fläche/Plätze</th>
        <th bgcolor="#f2f2f2" colspan="2">Verkaufspreis</th>
        <th bgcolor="#d9d9d9">Einheiten/Soll</th>
        <th bgcolor="#d9d9d9">Einheiten/Ist</th>
        <th bgcolor="#c4d89b">Status Einheiten frei</th>
        <th bgcolor="#c4d89b">Status Einheiten in %</th>
        <th bgcolor="#ffff00">Status € in %</th>
        <th bgcolor="#ffff00">Status €</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($projectDashboardData as $key => $data): ?>
        <tr style="background-color: #cecece; font-weight: bold" key="<?= $key ?>" class="projekt">
            <td><?= $data['name'] ?></td>
            <td bgcolor="#f2f2f2">
                <!--                            --><?php //echo Yii::$app->formatter->format($data['wohnflaechensumme'], ['decimal', 2]) ?><!-- m²-->
            </td>
            <td bgcolor="#f2f2f2">
                <!--                            --><?php //echo Yii::$app->formatter->format($data['durchschnittlicherPreisProQuadradmeter'], ['decimal', 2]) ?><!-- €/m²-->
            </td>
            <td bgcolor="#f2f2f2"><?= Yii::$app->formatter->format($data['verkuafspreissumme'], ['decimal', 2]) ?> €</td>

            <td bgcolor="#d9d9d9"><?= Yii::$app->formatter->format($data['einheitenGesamt'], ['decimal', 0]) ?></td>
            <td bgcolor="#d9d9d9"><?= number_format($data['einheitenVerkauftStück'], 0) ?></td>

            <td bgcolor="#c4d89b"><?= number_format($data['einheitenFreiStück'], 0) ?></td>
            <td bgcolor="#c4d89b"><?= number_format($data['einheitenVerkauftProzent'], 2) ?> %</td>

            <td bgcolor="#ffff00"><?= number_format($data['betragInProzentAngefordert'], 2) ?> %</td>
            <td bgcolor="#ffff00"><?= Yii::$app->formatter->format((float)$data['betragInEuroAngefordert'], ['decimal', 2]) ?> €</td>

        </tr>

        <?php foreach(Einheitstyp::find()->all() as $einheitstyp):

            $einheitstypData = ProjektSearch::getInfoForEinheitstyp(
                $data['projektId'],
                $einheitstyp->id
            );

            if(!is_array($einheitstypData)) continue;
            ?>

            <?php if((float)$einheitstypData['wohnflaechensumme'] + (float)$einheitstypData['verkuafspreissumme'] > 0): ?>
            <tr class="einheitstypen <?= $key == 0 ? '' : 'hide' ?>">
                <td>
                    <?= $einheitstyp->name ?><br>
                    -frei finanziert-
                </td>
                <?php
                $decimal = $einheitstyp->einheit == 'm2' ? 2 : 0;
                ?>
                <td bgcolor="#f2f2f2"><?= Yii::$app->formatter->format((float)$einheitstypData['wohnflaechensumme'], ['decimal', $decimal]) ?> <?= $einheitstyp->einheit ?></td>
                <td bgcolor="#f2f2f2"><?= Yii::$app->formatter->format((float)$einheitstypData['durchschnittlicherPreisProQuadradmeter'], ['decimal', 2]) ?> €/<?= $einheitstyp->einheit ?></td>
                <td bgcolor="#f2f2f2"><?= Yii::$app->formatter->format((float)$einheitstypData['verkuafspreissumme'], ['decimal', 2]) ?> €</td>

                <td bgcolor="#d9d9d9"><?= Yii::$app->formatter->format($einheitstypData['einheitenGesamt'], ['decimal', 0]) ?></td>
                <td bgcolor="#d9d9d9"><?= number_format($einheitstypData['einheitenVerkauftStück'], 0) ?></td>

                <td bgcolor="#c4d89b"><?= number_format($einheitstypData['einheitenFreiStück'], 0) ?></td>
                <td bgcolor="#c4d89b"><?= number_format($einheitstypData['einheitenVerkauftProzent'], 2) ?> %</td>

                <td bgcolor="#ffff00"><?php echo number_format($einheitstypData['betragInProzentAngefordert'], 2) ?> %</td>
                <td bgcolor="#ffff00"><?php echo Yii::$app->formatter->format((float)$einheitstypData['betragInEuroAngefordert'], ['decimal', 2]) ?> €</td>
            </tr>
        <?php endif; ?>

            <?php if((float)$einheitstypData['wohnflaechensummeGefoerdert'] + (float)$einheitstypData['verkuafspreissummeGefoerdert'] > 0): ?>
            <tr class="einheitstypen <?= $key == 0 ? '' : 'hide' ?>">
                <td>
                    <?= $einheitstyp->name ?><br>
                    -gefördert-
                </td>
                <?php
                $decimal = $einheitstyp->einheit == 'm2' ? 2 : 0;
                ?>
                <td bgcolor="#f2f2f2"><?= Yii::$app->formatter->format((float)$einheitstypData['wohnflaechensummeGefoerdert'], ['decimal', $decimal]) ?> <?= $einheitstyp->einheit ?></td>
                <td bgcolor="#f2f2f2"><?= Yii::$app->formatter->format((float)$einheitstypData['durchschnittlicherPreisProQuadradmeterGefoerdert'], ['decimal', 2]) ?> €/<?= $einheitstyp->einheit ?></td>
                <td bgcolor="#f2f2f2"><?= Yii::$app->formatter->format((float)$einheitstypData['verkuafspreissummeGefoerdert'], ['decimal', 2]) ?> €</td>

                <td bgcolor="#d9d9d9"><?= Yii::$app->formatter->format($einheitstypData['einheitenGesamtGefoerdert'], ['decimal', 0]) ?></td>
                <td bgcolor="#d9d9d9"><?= number_format($einheitstypData['einheitenVerkauftStückGefoerdert'], 0) ?></td>

                <td bgcolor="#c4d89b"><?= number_format($einheitstypData['einheitenFreiStückGefoerdert'], 0) ?></td>
                <td bgcolor="#c4d89b"><?= number_format($einheitstypData['einheitenVerkauftProzentGefoerdert'], 2) ?> %</td>

                <td bgcolor="#ffff00"><?php echo number_format($einheitstypData['betragInProzentAngefordertGefoerdert'], 2) ?> %</td>
                <td bgcolor="#ffff00"><?php echo Yii::$app->formatter->format((float)$einheitstypData['betragInEuroAngefordertGefoerdert'], ['decimal', 2]) ?> €</td>
            </tr>
        <?php endif; ?>
        <?php endforeach; ?>

    <?php endforeach; ?>
    </tbody>
</table>