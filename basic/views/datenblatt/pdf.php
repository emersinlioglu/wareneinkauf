﻿<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Datenblatt */

$this->title = 'Datenblatt ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Datenblätter', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="datenblatt-view">
<table>
       
        <tr>
            <td width="219"><strong>Projekt:</strong></td>
            <td width="56"><?php echo $model->projekt? $model->projekt->name : ''; ?></td>
            <td width="86"></td>
            <td width="71"><strong>Firmen-Nr.</strong></td>
            <td width="91"><?php if ($model->projekt && $model->projekt->firma) echo $model->projekt->firma->nr; ?></td>
            <td width="144"><strong>Teileigentumseinheit:</strong></td>
            <td colspan="2">
                <?php
                    if ($model->haus) {
                        foreach ($model->haus->teileigentumseinheits as $teigen) {
                            if ($teigen->einheitstyp_id == 1) {
                                echo $teigen->te_nummer;
                                break;
                            }
                        }
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td width="121"></td>
            <td width="72"></td>
        </tr>
        <tr>
            <td><strong>Anschrift</strong></td>
            <td><strong>PLZ/Ort :</strong></td>
            <td>
                <?php
                if ($model->haus) {
                    echo $model->haus->plz;
                }
                ?>
            </td>
            <td>
                <?php
                if ($model->haus) {
                    echo $model->haus->ort;
                }
                ?>
            </td>
            <td><strong>Straße + Hausnr. :</strong></td>
            <td>
                <?php
                if ($model->haus) {
                    echo $model->haus->strasse;
                }
                ?>
            </td>
            <td colspan="2">
                <?php
                if ($model->haus) {
                    echo $model->haus->hausnr;
                }
                ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td></td>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>reserviert</strong></td>
            <td>
                <?php
                    if ($model->haus && $model->haus->reserviert) {
                        echo 'X';
                    }
                ?>
            </td>
            <td><strong>verkauft</strong></td>
            <td>
                <?php
                if ($model->haus && $model->haus->verkauft) {
                    echo 'X';
                }
                ?>
            </td>
            <td></td>
            <td><strong>Rechnung Vertrieb</strong></td>
            <td colspan="2">
                <?php
                if ($model->haus && $model->haus->rechnung_vertrieb) {
                    echo 'X';
                }
                ?>
            </td>
        </tr>
        
</table><br>
        <strong><u>Beschreibung Teileigentumseinheit</u></strong><br>
        <table>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td align="right"><strong>TE</strong></td>
            <td align="center"><strong>gefördert</strong></td>
            <td align="center"><strong>Geschoss</strong></td>
            <td align="center"><strong>Zimmer</strong></td>
            <td align="right"><strong>ME-Anteil</strong></td>
            <td align="right"><strong>Wohnfläche</strong></td>
            <td align="right"><strong>Kaufpreis KP/Einheit</strong></td>
        </tr>

        <?php $kaufpreisSumme = 0; ?>

        <?php foreach ($model->haus->teileigentumseinheits as $te): ?>
            <tr>
                <td><?= $te->einheitstyp->name ?></td>
                <td align="right"><?= $te->te_nummer ?></td>
                <td align="center">
                    <?= $te->gefoerdert ? 'J' : 'N' ?>
                </td>
                <td align="center"><?= $te->geschoss ?></td>
                <td align="center"><?= $te->zimmer ?></td>
                <td align="right"><?= $te->me_anteil ?></td>
                <td align="right"><?= number_format((float)$te->wohnflaeche, 2, ',', '.') ?> <?= $te->einheitstyp->einheit ?></td>
              <td align="right"><?= number_format((float)$te->kaufpreis, 2, ',', '.') ?> €</td>
            </tr>
            <?php $kaufpreisSumme += (float)$te->kaufpreis; ?>
        <?php endforeach; ?>

        <tr>
            <td></td>
            <td align="right"></td>
            <td align="center"></td>
            <td align="center"></td>
            <td align="center"></td>
            <td align="right"></td>
            <td align="right"></td>
          <td align="right"><?= number_format((float)$kaufpreisSumme, 2, ',', '.') ?> €</td>
        </tr>
        </table>

        <br>
        <strong><u>Zählerangaben</u></strong>
        <table>
        
         <tr>
           
            <td><strong>Medium</strong></td>
            
            <td align="center"><strong>-Nr.</strong></td>
           
            <td align="right"><strong>Zähler -Stand</strong></td>
            
            <td align="right"><strong>-Datum</strong></td>
        </tr>
        <?php
        foreach ($model->haus->zaehlerstands as $zaehlerstand): ?>
          <tr>
            
            <td><?= $zaehlerstand->name ?></td>
           
            <td align="center"><?= $zaehlerstand->nummer ?></td>
            
            <td align="right"><?= $zaehlerstand->stand ?></td>
            
            <td align="right"><?= Yii::$app->formatter->asDate($zaehlerstand->datum) ?></td>
          </tr>
           <?php endforeach; ?>
        </table>
       
       
       
      <br>
       <strong><u>Käuferdaten</u></strong>
<table width="100%" border="0">
  <tr>
    <td><strong>Debitor-Nr.</strong></td>
    <td><?= $model->kaeufer ? $model->kaeufer->debitor_nr : ''; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Beurkundung am: </strong></td>
    <td> <?php
                    if ($model->kaeufer && $model->beurkundung_am) {
                        echo Yii::$app->formatter->asDate($model->beurkundung_am);
                    }
                ?> </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Termine: <br>- verbindliche Fertigstellung</strong>;</td>
    <td><?php if ($model->kaeufer &&$model->verbindliche_fertigstellung) { echo Yii::$app->formatter->asDate($model->verbindliche_fertigstellung);} ?></td>
    <td><strong> -Abnahme SE</strong></td>
    <td><?php
                if ($model->kaeufer && $model->abnahme_se) {
                    echo Yii::$app->formatter->asDate($model->abnahme_se);
                }
                ?></td>
    <td><strong> - Auflassung</strong></td>
    <td><?php
                if ($model->kaeufer && $model->auflassung) {
                    echo 'X';

                }
                ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>-Übergang BNL</strong></td>
    <td> <?php
                if ($model->kaeufer && $model->uebergang_bnl) {
                    echo Yii::$app->formatter->asDate($model->uebergang_bnl);
                }
                ?></td>
    <td><strong> -Abnahme GE</strong></td>
    <td> <?php
                if ($model->kaeufer && $model->abnahme_ge) {
                    echo Yii::$app->formatter->asDate($model->abnahme_ge);
                }
                ?></td>
    <td>&nbsp;</td>
  </tr>
  
</table>
<table width="100%" border="0">
  <tr>
    <td><strong>Anrede, Titel, <br>
            Vorname, Nachname</strong></td>
    <td><?php
                if ($model->kaeufer) {
                    switch($model->kaeufer->anrede) {
                        case 0: echo 'Herr'; break;
                        case 1: echo 'Frau'; break;
                    }   
                }
                ?></td>
    <td><?php
                if ($model->kaeufer) {
                    echo $model->kaeufer->titel;
                }
                ?></td>
    <td><?php
                if ($model->kaeufer) {
                    echo $model->kaeufer->vorname;
                }
                ?></td>
    <td> <?php
                if ($model->kaeufer) {
                    echo $model->kaeufer->nachname;
                }
                ?></td>
  </tr>
  <tr>
    <td><strong>Anrede, Titel, <br>
            Vorname, Nachname</strong></td>
    <td> <?php
                if ($model->kaeufer) {
                    switch($model->kaeufer->anrede2) {
                        case 0: echo 'Herr'; break;
                        case 1: echo 'Frau'; break;
                    }
                }
                ?></td>
    <td> <?php
                if ($model->kaeufer) {
                    echo $model->kaeufer->titel2;
                }
                ?></td>
    <td> <?php
                if ($model->kaeufer) {
                    echo $model->kaeufer->vorname2;
                }
                ?></td>
    <td> <?php
                if ($model->kaeufer) {
                    echo $model->kaeufer->nachname2;
                }
                ?></td>
  </tr>
  <tr>
    <td><strong>Straße + Hausnummer</strong></td>
    <td colspan="4"><?= $model->kaeufer ? $model->kaeufer->strasse : ''; ?> <?= $model->kaeufer ? $model->kaeufer->hausnr : ''; ?></td>
    
  </tr>
  <tr>
    <td><strong>PLZ/Ort</strong></td>
    <td colspan="4"><?= $model->kaeufer ? $model->kaeufer->plz : ''; ?> <?= $model->kaeufer ? $model->kaeufer->ort : ''; ?></td>
  </tr>
  <tr>
    <td><strong>Tel. Festnetz/mobil</strong></td>
    <td colspan="2"><?= ($model->kaeufer->festnetz) ? $model->kaeufer->festnetz : $model->kaeufer->handy ? $model->kaeufer->handy : '' ; ?></td>
    <td colspan="2"><?= ($model->kaeufer->festnetz) ? ($model->kaeufer->handy) : ''; ?></td>
  </tr>
  <tr>
    <td><strong>E-Mail</strong></td>
    <td colspan="4"><?= $model->kaeufer ? $model->kaeufer->email : ''; ?></td>
  </tr>
</table>

 <p></p><p></p>
<p></p>
       
       
       
        <strong><u>besondere Regelungen Kaufvertrag</u></strong>
        <table>
        <tr>
          <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            
            <td colspan="7"><?= $model->besondere_regelungen_kaufvertrag; ?></td>
          </tr>
        </table><br>
        <strong><u>Sonderwünsche</u></strong>

<table>
       <tr></tr>
        <tr>
            <td></td>
            <td colspan="2" align="center"><strong>Angebot</strong></td>
            <td colspan="2" align="center"><strong>beauftragt</strong></td>
            <td colspan="3" align="center"><strong>Rechnungsstellung </strong></td>
  </tr>
        <tr>
            <td></td>
            <td align="center"><strong> - Datum</strong></td>
            <td align="center"><strong> - Betrag</strong></td>
            <td align="center"><strong> - Datum</strong></td>
            <td align="center"><strong> - Betrag</strong></td>
            <td align="center"><strong> - Datum</strong></td>
            <td align="center"><strong> - Betrag</strong></td>
            <td align="center"><strong> - Rg.-Nr.</strong></td>
        </tr>

        <?php $rechnungsstellungBetragSumme = 0; ?>
        <?php foreach ($model->sonderwunsches as $sonderwunsch): ?>
            <tr>
                <td><?= $sonderwunsch->name ?></td>
                <td align="center"><?= Yii::$app->formatter->asDate($sonderwunsch->angebot_datum) ?></td>
                <td align="center"><?= number_format((float)$sonderwunsch->angebot_betrag, 2, ',', '.') ?> €</td>
                <td align="center"><?= Yii::$app->formatter->asDate($sonderwunsch->beauftragt_datum) ?></td>
                <td align="center"><?= number_format((float)$sonderwunsch->beauftragt_betrag, 2, ',', '.') ?> €</td>
                <td align="center"><?= Yii::$app->formatter->asDate($sonderwunsch->rechnungsstellung_datum) ?></td>
                <td align="center"><?= number_format((float)$sonderwunsch->rechnungsstellung_betrag, 2, ',', '.') ?> €</td>
                <td align="center"><?= $sonderwunsch->rechnungsstellung_rg_nr ?></td>
            </tr>
        <?php $rechnungsstellungBetragSumme += (float)$sonderwunsch->rechnungsstellung_betrag; ?>
        <?php endforeach; ?>

        <tr>
            <td><strong>Summe</strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td align="center"><?= number_format((float)$rechnungsstellungBetragSumme, 2, ',', '.') ?> €</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="8">&nbsp;</td>
            
        </tr>
        
</table>


        <table width="100%">
                <tr>
            <td width="20%"><strong><u>Kaufpreisabrechnung</u></strong></td>
            <td width="8%"></td>
            <td width="13%"></td>
            <td width="13%"></td>
            <td width="8%"></td>
            <td width="13%"></td>
            <td width="13%"></td>
            <td width="12%"></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3" align="center"><strong>Kaufvertrag</strong></td>
            <td colspan="3" align="center"><strong>Sonderwünsche/Ausstattung</strong></td>
            <td align="center"><strong> Summe</strong></td>
        </tr>
        <tr>
          <td></td>
            <td align="right" style=" padding-right:15px"><strong> - in %</strong></td>
          <td align="center"><strong> - Betrag</strong></td>
          <td align="center"><strong> -angefordert</strong></td>
            <td align="right" style=" padding-right:15px"><strong> - in %</strong></td>
            <td align="center"><strong> - Betrag</strong></td>
            <td align="center"><strong>-angefordert</strong></td>
            <td></td>
        </tr>
        
        <?php
        $kvSummeProzent = 0;
        $kvSummeBetrag = 0;
        $swSummeProzent = 0;
        $swSummeBetrag = 0;
        $kaufvertragProzentTotal  = 0;
        $kaufvertragBetragTotal   = 0;
        $sonderwunschProzentTotal = 0;
        $sonderwunschBetragTotal  = 0;
        ?>
        
        <?php foreach($model->abschlags as $key => $abschlag): ?>
        <tr>
            <td><strong><?= $abschlag->name ?></strong></td>
            <td align="right" style="padding-right:15px"><?= number_format((float)$abschlag->kaufvertrag_prozent, 2, ',', '.') ?> %</td>
          <td align="right" ><?= number_format((float)$abschlag->kaufvertrag_betrag, 2, ',', '.') ?> €</td>
            <td align="center">
                <?php 
                    if ($abschlag->kaufvertrag_angefordert) {
                        echo Yii::$app->formatter->asDate($abschlag->kaufvertrag_angefordert);
                    }
                ?>
            </td>
          <td align="right" style="padding-right:15px"><?= number_format((float)$abschlag->sonderwunsch_prozent, 2, ',', '.') ?> %</td>
            <td align="right" ><?= number_format((float)$abschlag->sonderwunsch_betrag, 2, ',', '.') ?> €</td>
            <td align="center">
                <?php 
                    if ($abschlag->sonderwunsch_angefordert) {
                        echo Yii::$app->formatter->asDate($abschlag->sonderwunsch_angefordert);
                    }
                ?>
            </td>
            <td align="right"><?= number_format((float)$abschlag->summe, 2, ',', '.') ?> €</td>
        </tr>
        
        <?php 
            // berechnung
            $kaufvertragProzentTotal += $abschlag->kaufvertrag_prozent;
            if($abschlag->kaufvertrag_angefordert) {
                $kaufvertragBetragTotal += (float)$abschlag->kaufvertrag_betrag;
            } 
            $kvSummeBetrag += (float)$abschlag->kaufvertrag_betrag;
            $sonderwunschProzentTotal += $abschlag->sonderwunsch_prozent;
            if($abschlag->sonderwunsch_angefordert) {
                $sonderwunschBetragTotal += $abschlag->sonderwunsch_betrag;
            } 
            $swSummeBetrag += $abschlag->sonderwunsch_betrag;
        ?>
        
        <?php endforeach; ?>
        
        <tr>
            <td><strong>Summe</strong></td>
            <td align="right" style="padding-right:15px"><?= number_format($kaufvertragProzentTotal, 2, ',', '.')   ?> %</td>
            <td align="right" ><?= number_format($kvSummeBetrag, 2, ',', '.')  ?> €</td>
            <td></td>
          <td align="right" style="padding-right:15px"><?= number_format($sonderwunschProzentTotal, 2, ',', '.') ?> %</td>
            <td align="right" ><?= number_format($swSummeBetrag, 2, ',', '.')  ?> €</td>
            <td></td>
            <td align="right"><?= number_format($kaufvertragBetragTotal + $sonderwunschBetragTotal, 2, ',', '.') ?> €</td>
        </tr>
        </table>
        <br>
        <strong><u>./. Minderungen/Nachlaß</u></strong>
        <table>
        <tr>
            <td width="15%"></td>
            <td width="15%"></td>
            
           
            <td width="70%" align="right">
                <?php
                    $totalNachlass = .0;
                    foreach($model->nachlasses as $nachlass) {
                        $totalNachlass += (float) $nachlass->betrag;
                    }
                    echo number_format($totalNachlass,2, ',', '.');
                ?>  €
            </td>
        </tr>
        <tr>
          <td width="15%"><strong>Schreiben vom :</strong></td>
              <td width="15%" align="right" style="padding-left: 15px; padding-right:15px"><strong>Betrag</strong></td>
              <td width="70%"><strong>Bemerkung</strong></td>
          </tr>
        <?php foreach($model->nachlasses as $key => $modelNachlass): ?>
            
            <tr>
                <td width="15%">
                    <?php
                    echo Yii::$app->formatter->asDate($modelNachlass->schreiben_vom);
                    ?>
                </td>
                <td width="15%" align="right" style="padding-left: 15px; padding-right:15px">
                    <?= number_format($modelNachlass->betrag,2, ',', '.') ?> €
                </td>
                <td width="70%">
                    <?= $modelNachlass->bemerkung ?>
                </td>
          </tr>
        <?php endforeach; ?>
        </table><br>
        <br>
        <strong><u>./. Verzugszins</u></strong>
        <table>
        <tr>
            <td width="15%"></td>
            <td width="15%"></td>
            
           
            <td width="70%" align="right">
                <?php
                    $totalZinsverzug = .0;
                    foreach($model->zinsverzugs as $zinsverzug) {
                        $totalZinsverzug += (float) $zinsverzug->betrag;
                    }
                    echo number_format($totalZinsverzug,2, ',', '.');
                ?>  €
            </td>
        </tr>
        <tr>
          <td width="15%"><strong>Schreiben vom :</strong></td>
              <td width="15%" align="right" style="padding-left: 15px; padding-right:15px"><strong>Betrag</strong></td>
              <td width="70%"><strong>Bemerkung</strong></td>
          </tr>
        <?php foreach($model->zinsverzugs as $key => $modelZinsverzug): ?>
            
            <tr>
                <td width="15%">
                    <?php
                    echo Yii::$app->formatter->asDate($modelZinsverzug->schreiben_vom);
                    ?>
                </td>
                <td width="15%" align="right" style="padding-left: 15px; padding-right:15px">
                    <?= number_format($modelZinsverzug->betrag,2, ',', '.') ?> €
                </td>
                <td width="70%">
                    <?= $modelZinsverzug->bemerkung ?>
                </td>
          </tr>
        <?php endforeach; ?>
        </table><br>
        <strong><u>Zwischensumme</u></strong>
        <table>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td align="right"><?php
                    //echo number_format($kaufvertragBetragTotal + $sonderwunschBetragTotal - $totalNachlass, 2, ',', '.');
                    echo number_format($model->getZwischenSumme(), 2, ',', '.');
                ?> €
            </td>
        </tr>
       </table><br>
       <strong><u>Zahlungen</u></strong>
       
       <table>
       
        <tr>
            <td width="15%"><strong>Datum</strong></td>
            <td width="70%"><strong>Bemerkung</strong></td>
            <td width="15%" align="right"><strong>Betrag</strong></td>
        </tr>
        
        <?php foreach ($model->zahlungs as $key => $modelZahlung): ?>
            <tr>
                <td width="15%">
                    <?php
                    echo Yii::$app->formatter->asDate($modelZahlung->datum);
                    ?>
                </td>
                
                <td width="70%">
                    <?= $modelZahlung->bemerkung ?>
                </td>
                <td width="15%" align="right">
                    <?php echo number_format($modelZahlung->betrag,2, ',', '.'); ?>
                €</td>
         </tr>
        <?php endforeach; ?>
        
        
        <tr>
            <td width="15%"><strong>bereits gezahlt</strong></td>
            <td width="70%"></td>
            <td width="15%" align="right"> <?php
                    //echo $kaufvertragBetragTotal + $sonderwunschBetragTotal - $totalNachlass;
                    $totalZahlungen = 0;
                    foreach($model->zahlungs as $zahlung) {
                        $totalZahlungen += (float) $zahlung->betrag;
                    }
                    echo number_format($totalZahlungen,2, ',', '.');
                ?> €</td>
            
        </tr>
        <tr>
            <td width="15%"><strong><u>offene Posten</u></strong></td>
            <td width="70%"></td>
            <td width="15%" align="right">
                <?php
                    //echo number_format($kaufvertragBetragTotal + $sonderwunschBetragTotal - $totalNachlass - $totalZahlungen, 2, ',', '.');
                    echo number_format($model->getOffenePosten(), 2, ',', '.');
                ?> €</td>
            
        </tr>
        
        <tr>
            <td width="15%"><strong>sonstige Anmerkungen</strong></td>
            <td colspan="2"><?php $model->sonstige_anmerkungen; ?></td>
        </tr>
        
       
  </table>