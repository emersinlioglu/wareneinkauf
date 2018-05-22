<?php
/** @var \app\models\Datenblatt $modelDatenblatt */
?>

<div class="box-group" id="accordion">
    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
    <div class="panel box box-primary">
        <div class="box-header with-border">
            <h4 class="box-title">
                <a data-toggle="collapse" data-parent="#collapse-te" href="#collapse-te" aria-expanded="true" class="">
                    Beschreibung Teileigentumseinheit:
                </a>
            </h4>
        </div>
        <div id="collapse-te" class="panel-collapse collapse in" aria-expanded="false">
            <div class="box-body">

                <div class="row <?= $modelDatenblatt->isAbschlagAngefordert() ? 'hide' : '' ?>">
                    <div class="col-sm-3">
                        <div class="form-group field-search-teileigentumseinheit">
                            <label class="control-label" for="search-teileigentumseinheit">Suche</label>
                            <input type="text"
                                   id="search-teileigentumseinheit"
                                   class="form-control ui-autocomplete-input"
                                   name="suche" value="" maxlength="255">
                        </div>
                    </div>
                </div>
    
                <table class="table te-einheiten">
                    <thead>
                        <tr>
                            <th>Hausnr.</th>
                            <th>TE-Typ</th>
                            <th>TE</th>
                            <th>gefördert</th>
                            <th>Geschoss</th>
                            <th>Zimmer</th>
                            <th class="text-align-right">ME-Anteil</th>
                            <th class="text-align-right">Wohnfläche</th>
                            <th class="text-align-right">Kaufpreis</th>
                            <th class="text-align-right">KP/Einheit</th>
                            <th class="text-align-right <?= $modelDatenblatt->isAbschlagAngefordert() ? 'hide' : '' ?>" style="width: 5%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        /* @var $teileigentumseinheit app\models\Teileigentumseinheit */
                        if ($modelDatenblatt->haus):
                        foreach ($modelDatenblatt->haus->teileigentumseinheits as $teileigentumseinheit): ?>
                            <tr
                                data-prefix-debitor-nr="<?= $teileigentumseinheit->einheitstyp->prefix_debitor_nr ?>"
                                data-te-nummer="<?= $teileigentumseinheit->te_nummer ?>">
                                <td><?= $teileigentumseinheit->hausnr ?></td>
                                <td><?= $teileigentumseinheit->einheitstyp->name ?></td>
                                <td><?= $teileigentumseinheit->te_nummer ?></td>
                                <td><?= $teileigentumseinheit->gefoerdert ? 'ja' : 'nein' ?></td>
                                <td><?= $teileigentumseinheit->geschoss ?></td>
                                <td><?= $teileigentumseinheit->zimmer ?></td>
                                <td class="text-align-right"><?= Yii::$app->formatter->asDecimal($teileigentumseinheit->me_anteil,2) ?></td>
                                <td class="text-align-right"><?= Yii::$app->formatter->asDecimal($teileigentumseinheit->wohnflaeche) ?> <?= $teileigentumseinheit->einheitstyp->einheit ?></td>
                                <td class="text-align-right"><?= number_format ((float)$teileigentumseinheit->kaufpreis, 2, ',', '.'); ?> €</td>
                                <td class="text-align-right"><?= number_format ((float)$teileigentumseinheit->kp_einheit, 2, ',', '.'); ?> €</td>
                                <?php if(!isset($hideActions)): ?>
                                    <td class="text-align-right <?= $modelDatenblatt->isAbschlagAngefordert() ? 'hide' : '' ?>">
                                        <?= \yii\helpers\Html::a('<span class="fa fa-minus"></span>',
                                            Yii::$app->urlManager->createUrl(["datenblatt/remove-teileigentumseinheit", 'datenblattId' => $modelDatenblatt->id , 'teId' => $teileigentumseinheit->id]),
                                            ['class' => 'delete-button delete-zahlung btn btn-danger btn-xl']) ?>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php
                        endforeach;
                        endif;
                        ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>