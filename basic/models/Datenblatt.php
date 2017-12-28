<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "datenblatt".
 *
 * @property integer $id
 * @property string $firma_id
 * @property string $projekt_id
 * @property string $haus_id
 * @property integer $nummer
 * @property string $kaeufer_id
 * @property string $besondere_regelungen_kaufvertrag
 * @property string $sonstige_anmerkungen
 * @property integer $aktiv
 *
 * @property string $beurkundung_am
 * @property string $verbindliche_fertigstellung
 * @property string $uebergang_bnl
 * @property string $abnahme_se
 * @property string $abnahme_ge
 * @property integer $auflassung
 * @property integer $creator_user_id
 * @property string $sap_debitor_nr
 * @property string $intern_debitor_nr
 *
 *
 * @property Abschlag[] $abschlags
 * @property Firma $firma
 * @property Haus $haus
 * @property Kaeufer $kaeufer
 * @property Projekt $projekt
 * @property Nachlass[] $nachlasses
 * @property Sonderwunsch[] $sonderwunsches
 * @property Zahlung[] $zahlungs
 * @property Zinsverzug[] $zinsverzugs
 */
class Datenblatt extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'datenblatt';
    }

    public function afterFind()
    {
        parent::afterFind(); // TODO: Change the autogenerated stub

        // calculate kaufpreis
        $kaufpreisTotal = 0;
        /* @var $teileh Teileigentumseinheit */
        if ($this->haus) {
            foreach ($this->haus->teileigentumseinheits as $item) {
                $kaufpreisTotal += (float)$item->kaufpreis;
            }
        }

        // calculate sonderwünche
        $sonderwuenscheTotal = 0;
        /* @var $item Sonderwunsch */
        foreach ($this->sonderwunsches as $item) {
            $sonderwuenscheTotal += (float)$item->rechnungsstellung_betrag;
        }

        // calculate abschlags
        /* @var $item \app\models\Abschlag */
        foreach ($this->abschlags as $item) {

            $zeilenSumme = 0;
            if ($item->kaufvertrag_angefordert) {
                $zeilenSumme += ((float)$item->kaufvertrag_prozent * $kaufpreisTotal / 100);
            }
            if ($item->sonderwunsch_angefordert) {
                $zeilenSumme += ((float)$item->sonderwunsch_prozent * $sonderwuenscheTotal / 100);
            }
            $item->kaufvertrag_betrag = (string)((float)$item->kaufvertrag_prozent * $kaufpreisTotal / 100);
            $item->sonderwunsch_betrag = (string)((float)$item->sonderwunsch_prozent * $sonderwuenscheTotal / 100);

            $item->summe = (string)$zeilenSumme;
        }
    }

        public function __get($attribute) {

        if (substr($attribute, 0, 9) == 'teeinheit' && strpos($attribute, '__')) {

            $parts = explode('__', $attribute);
            $relatedObject = $parts[0];
            $nth = $parts[1];
            $attributeName = $parts[2];

            $value = '';
            if ($this->haus && count($this->haus->teileigentumseinheits) > $nth) {
                $te = $this->haus->teileigentumseinheits[$nth];

                switch($attributeName) {

                	case 'kaufpreis':
                        $value = number_format((float)$te->{$attributeName}, 2, ',', '.') . ' €';
                        break;
                    case 'te_name':
                        $value = $te->einheitstyp ? $te->einheitstyp->name : '';
                        break;
                    case 'gefoerdert':
                        $value = $te->{$attributeName} ? 'J' : 'N';
                        break;
                    default:                
                        $value = $te->{$attributeName};
                        break;
                }

            }

            return $value;
        }
        
        if (substr($attribute, 0, 12) == 'sonderwunsch' && strpos($attribute, '__')) {

            $parts = explode('__', $attribute);
            $relatedObject = $parts[0];
            $nth = $parts[1];
            $attributeName = $parts[2];

            $value = '';
            if (count($this->sonderwunsches) > $nth) {
                
                $sonerwunsch = $this->sonderwunsches[$nth];
                switch($attributeName) {
                    case 'rechnungsstellung_betrag':
                        $value = number_format((float)$sonerwunsch->{$attributeName}, 2, ',', '.') . ' €';
                        break;
                    default:                
                        $value = $sonerwunsch->{$attributeName};
                        break;
                }
            }

            return $value;
        }
        
        if (substr($attribute, 0, 8) == 'abschlag' && strpos($attribute, '__')) {

            $parts = explode('__', $attribute);
            $relatedObject = $parts[0];
            $nth = $parts[1];
            $attributeName = $parts[2];

            $value = '';
            if (count($this->abschlags) > $nth) {

                $abschlag = $this->abschlags[$nth];
                switch($attributeName) {
                    case 'kaufvertrag_prozent':
                        $value = $abschlag->{$attributeName} . ' %';
                        break;
                    case 'kaufvertrag_betrag':
                        $value = number_format((float)$abschlag->{$attributeName}, 2, ',', '.') . ' €';
                        break;
                    default:                
                        $value = $abschlag->{$attributeName};
                        break;
                }
            }

            return $value;
        }

        if (substr($attribute, 0, 8) == 'nachlass' && strpos($attribute, '__')) {

            $parts = explode('__', $attribute);
            $relatedObject = $parts[0];
            $nth = $parts[1];
            $attributeName = $parts[2];

            $value = '';
            if (count($this->nachlasses) > $nth) {

                $nachlass = $this->nachlasses[$nth];
                switch($attributeName) {
                    
                    default:                
                        $value = $nachlass->{$attributeName};
                        break;
                }
            }

            return $value;
        }

        if (substr($attribute, 0, strlen('zinsverzug')) == 'zinsverzug' && strpos($attribute, '__')) {

            $parts = explode('__', $attribute);
            $relatedObject = $parts[0];
            $nth = $parts[1];
            $attributeName = $parts[2];

            $value = '';
            if (count($this->zinsverzugs) > $nth) {

                $zinsverzug = $this->zinsverzugs[$nth];
                switch($attributeName) {

                    default:
                        $value = $zinsverzug->{$attributeName};
                        break;
                }
            }

            return $value;
        }

        if (substr($attribute, 0, 7) == 'zahlung' && strpos($attribute, '__')) {

            $parts = explode('__', $attribute);
            $relatedObject = $parts[0];
            $nth = $parts[1];
            $attributeName = $parts[2];

            $value = '';
            if (count($this->zahlungs) > $nth) {

                $zahlung = $this->zahlungs[$nth];
                switch($attributeName) {
                    case 'kaufvertrag_prozent':
                        $value = $zahlung->{$attributeName};
                        break;
                    case 'kaufvertrag_betrag':
                        $value = $zahlung->{$attributeName};
                        break;
                    case 'kaufvertrag_angefordert':
                        $value = $zahlung->{$attributeName};
                        break;
                    default:                
                        $value = $zahlung->{$attributeName};
                        break;
                }
            }

            return $value;
        }
        

        return parent::__get($attribute);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['kaeufer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kaeufer::className(), 'targetAttribute' => 'id'],
            [['creator_user_id'], 'required'],
            [['beurkundung_am', 'verbindliche_fertigstellung', 'uebergang_bnl', 'abnahme_se', 'abnahme_ge'], 'safe'],
            [['firma_id', 'projekt_id', 'haus_id', 'nummer', 'kaeufer_id', 'aktiv', 'auflassung', 'creator_user_id'], 'integer'], //'kaeufer_id',
            [['besondere_regelungen_kaufvertrag', 'sonstige_anmerkungen', 'sap_debitor_nr', 'intern_debitor_nr'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'firma_id' => Yii::t('app', 'Firma ID'),
            'projekt_id' => Yii::t('app', 'Projekt ID'),
            'haus_id' => Yii::t('app', 'Haus ID'),
            'nummer' => Yii::t('app', 'Nummer'),
            'kaeufer_id' => Yii::t('app', 'Kaeufer ID'),
            'besondere_regelungen_kaufvertrag' => Yii::t('app', 'Besondere Regelungen Kaufvertrag'),
            'sonstige_anmerkungen' => Yii::t('app', 'Sonstige Anmerkungen'),
            'aktiv' => Yii::t('app', 'Aktiv'),

            'beurkundung_am' => Yii::t('app', 'Beurkundung am'),
            'verbindliche_fertigstellung' => Yii::t('app', 'Verbindliche Fertigstellung'),
            'uebergang_bnl' => Yii::t('app', 'Übergang Besitz Nutzen Lasten'),
            'abnahme_se' => Yii::t('app', 'Abnahme Sondereigentum'),
            'abnahme_ge' => Yii::t('app', 'Abnahme Gemeinschaftseigentum'),
            'auflassung' => Yii::t('app', 'Auflassung'),
            'creator_user_id' => Yii::t('app', 'Ersteller ID'),
            'sap_debitor_nr' => Yii::t('app', 'SAP-Debitor Nr.'),
            'intern_debitor_nr' => Yii::t('app', 'Interne-Debitor Nr.'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbschlags()
    {
        return $this->hasMany(Abschlag::className(), ['datenblatt_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFirma()
    {
        return $this->hasOne(Firma::className(), ['id' => 'firma_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHaus()
    {
        return $this->hasOne(Haus::className(), ['id' => 'haus_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKaeufer()
    {
        return $this->hasOne(Kaeufer::className(), ['id' => 'kaeufer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjekt()
    {
        return $this->hasOne(Projekt::className(), ['id' => 'projekt_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNachlasses()
    {
        return $this->hasMany(Nachlass::className(), ['datenblatt_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZinsverzugs()
    {
        return $this->hasMany(Zinsverzug::className(), ['datenblatt_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSonderwunsches()
    {
        return $this->hasMany(Sonderwunsch::className(), ['datenblatt_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZahlungs()
    {
        return $this->hasMany(Zahlung::className(), ['datenblatt_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getTenummerHtml() {

        $wohnungsTenummer = array();
        $teNummers = array();

        if ($this->haus) {
            foreach ($this->haus->teileigentumseinheits as $te) {
                $teNummers[] = $te->te_nummer;
                if ($te->einheitstyp_id == 1) {
                    $wohnungsTenummer[] = $te->te_nummer;
                }
            }
            asort($teNummers);

            foreach($teNummers as $key => $tenummer) {
                if (in_array($tenummer, $wohnungsTenummer)) {
                    $teNummers[$key] = '<strong>' . $tenummer . '</strong>';
                } else {
                    $teNummers[$key] = '<small>' . $tenummer . '</small>';
                }
            }
        }

        return implode('/ ', $teNummers);
    }

    public function getSonderwunschAngebotSumme() {

        $total = 0;
        foreach ($this->sonderwunsches as $sonderwunsch) {
            $total += $sonderwunsch->rechnungsstellung_betrag;
        }

        return $total;
    }

    public function getSonderwunschBeauftragtSumme() {

        $total = 0;
        foreach ($this->sonderwunsches as $sonderwunsch) {
            $total += $sonderwunsch->beauftragt_betrag;
        }

        return $total;
    }

    public function getNachlassSumme() {

        $total = 0;
        foreach ($this->nachlasses as $nachlass) {
            $total += $nachlass->betrag;
        }

        return $total;
    }

    public function getZinsverzugSumme() {

        $total = 0;
        foreach ($this->zinsverzugs as $zinsverzug) {
            $total += $zinsverzug->betrag;
        }

        return $total;
    }

    public function getZahlungSumme() {

        $total = 0;
        foreach ($this->zahlungs as $zahlung) {
            $total += $zahlung->betrag;
        }

        return $total;
    }

    public function getZwischenSumme() {

        $this->calculate();

        $total = $this->getAbschlagSumme()
            + $this->getZinsverzugSumme()
            - $this->getNachlassSumme();

        return $total;
    }

    public function getOffenePosten() {

        $this->calculate();

        $total = $this->getAbschlagSumme()
            + $this->getZinsverzugSumme()
            - $this->getNachlassSumme()
            - $this->getZahlungSumme();

        return $total;
    }

    public function getAbschlagSumme() {
        
        $this->calculate();

        $total = 0;
        foreach ($this->abschlags as $abschlag) {
            $total += $abschlag->summe;
        }

        return $total;
    }


    public function calculate()
    {
        // calculate kaufpreis
        $kaufpreisTotal = 0;
        /* @var $teileh app\models\Teileigentumseinheit */
        if ($this->haus) {
            foreach ($this->haus->teileigentumseinheits as $item) {
                $kaufpreisTotal += (float)$item->kaufpreis;
            }
        }

        // calculate sonderwünche
        $sonderwuenscheTotal = 0;
        /* @var $item app\models\Sonderwunsch */
        foreach ($this->sonderwunsches as $item) {
            $sonderwuenscheTotal += (float)$item->rechnungsstellung_betrag;
        }

        // calculate abschlags
        /* @var $item \app\models\Abschlag */
        foreach ($this->abschlags as $item) {

            $zeilenSumme = 0;
            if ($item->kaufvertrag_angefordert) {
                $zeilenSumme += ((float)$item->kaufvertrag_prozent * $kaufpreisTotal / 100);
            }
            if ($item->sonderwunsch_angefordert) {
                $zeilenSumme += ((float)$item->sonderwunsch_prozent * $sonderwuenscheTotal / 100);
            }
            $item->kaufvertrag_betrag = ((float)$item->kaufvertrag_prozent * $kaufpreisTotal / 100);
            $item->sonderwunsch_betrag = ((float)$item->sonderwunsch_prozent * $sonderwuenscheTotal / 100);

            $item->summe = $zeilenSumme;
        }
    }

    public function getUebergangBnlLabel()
    {
        if ($this->uebergang_bnl === null) {
            $label = '';
        } else {
            $label = Yii::$app->formatter->asDate($this->uebergang_bnl);
        }
        return $label;
    }

    public function getBeurkundungAmLabel()
    {
        if ($this->beurkundung_am === null) {
            $label = '';
        } else {
            $label = Yii::$app->formatter->asDate($this->beurkundung_am);
        }
        return $label;
    }

    public function getAbnahmeSeLabel()
    {
        if ($this->abnahme_se === null) {
            $label = '';
        } else {
            $label = Yii::$app->formatter->asDate($this->abnahme_se);
        }
        return $label;
    }

    public function getAbnahmeGeLabel()
    {
        if ($this->abnahme_ge === null) {
            $label = '';
        } else {
            $label = Yii::$app->formatter->asDate($this->abnahme_ge);
        }
        return $label;
    }

    public function updateInternDebitorNr() {

        $internDebitorNr = $this->sap_debitor_nr . '-';
        if ($this->haus) {
            foreach($this->haus->teileigentumseinheits as $teileigentumseinheit) {
                $internDebitorNr .=
                    $teileigentumseinheit->einheitstyp->prefix_debitor_nr . $teileigentumseinheit->te_nummer;
            }
        }

        $this->intern_debitor_nr = $internDebitorNr;

        $this->save();
    }

    public function isAbschlagAngefordert() {
        $istAngefordert = false;
        /** @var Abschlag $abschlag */
        foreach ($this->abschlags as $abschlag) {
            if (strlen($abschlag->kaufvertrag_angefordert) > 0) {
                $istAngefordert = true;
            }
        }

        return $istAngefordert;
    }

    public function hasAngeforderteSonderwuensche() {
        $result = false;
        foreach ($this->sonderwunsches as $sonderwunsch) {
            $result |= !empty($sonderwunsch->beauftragt_datum);
        }
        return $result;
    }

    /**
     * @return array
     */
    public function getReplaceData() {

        $datenblatt = $this;
        $projekt = $datenblatt->projekt;

//        $abschlagNr = 0;
//        foreach($datenblatt->abschlags as $abschlag) {
//            $abschlagNr++;
//            if($abschlag->id == $this->id) {
//                break;
//            }
//        }

        $kaeuferDaten = array();
        $kaeufer = $datenblatt->kaeufer;
        if (strlen($kaeufer->vorname . $kaeufer->nachname) > 0) {
            $kaeuferDaten[] = ($kaeufer->anrede == 1 ? 'Frau' : 'Herrn') . ' ' . $kaeufer->vorname . ' ' . $kaeufer->nachname;
        }
        if (strlen($kaeufer->vorname2 . $kaeufer->nachname2) > 0) {
            $kaeuferDaten[] = ($kaeufer->anrede2 == 1 ? 'Frau' : 'Herrn') . ' ' . $kaeufer->vorname2 . ' ' . $kaeufer->nachname2;
        }
        if ($kaeufer->anrede == 0 && $kaeufer->anrede2 == 1) {
            $kaeuferDaten = array_reverse($kaeuferDaten);
        }

        $kaeuferNamen = '';
        $cnt = count($kaeuferDaten);
        if ($cnt==2){
            $kaeuferNamen=implode('<br>', $kaeuferDaten);
        } else {
            $kaeuferNamen =
                ($kaeufer->anrede == 1 ? 'Frau' : 'Herrn') . '<br>'
                . $kaeufer->vorname . ' ' . $kaeufer->nachname;
        }

        $einheitstypStellplatz = Einheitstyp::findOne(Einheitstyp::TYP_STELLPLATZ);
        $einheitstypLagerraum = Einheitstyp::findOne(Einheitstyp::TYP_LAGERRAUM);
        $einheitstypGarage = Einheitstyp::findOne(Einheitstyp::TYP_GARAGE);
        $einheitstypAussenstellplatz = Einheitstyp::findOne(Einheitstyp::TYP_AUSSENSTELLPLATZ);
        $einheitstypKeller = Einheitstyp::findOne(Einheitstyp::TYP_KELLER);



        $replaceData = [
            '[projekt-name]' => $projekt->name,
            '[projekt-strasse]' => $projekt->strasse . $projekt->hausnr,
            '[projekt-ort]' => $projekt->ort,
            '[wohnung-nr]' => $datenblatt->haus->tenummer,
    //            '[kaufpreisabrechnung-kaufvertrag-in-prozent]' => number_format($this->kaufvertrag_prozent, 2, ',', '.'),
    //            '[kaufpreisabrechnung-kaufvertrag-betrag]' => number_format($this->kaufvertrag_betrag, 2, ',', '.'),
    //            '[erstell-datum]' => Yii::$app->formatter->asDate($this->erstell_datum, 'medium'),
    //            '[abschlag-nr]' => $abschlagNr,
            '[debitor-nr]' => $datenblatt->kaeufer->debitor_nr,
//            '[kaeufer-anrede]' => $datenblatt->kaeufer->anrede == 1 ? 'Frau' : 'Herrn',
//            '[kaeufer-vorname]' => $datenblatt->kaeufer->vorname,
//            '[kaeufer-nachname]' => $datenblatt->kaeufer->nachname,
            '[kaeufer-strasse]' => $datenblatt->kaeufer->strasse,
            '[kaeufer-strassen-nr]' => $datenblatt->kaeufer->hausnr,
            '[kaeufer-plz]' => $datenblatt->kaeufer->plz,
            '[kaeufer-ort]' => $datenblatt->kaeufer->ort,
            '[kaeufer]' => $kaeuferNamen,
            '\r\n' => '<br>',
            '\n\    r' => '<br>',
            '[tenummer-stellplatz]' => $datenblatt->haus->getTenummerForEinheitstyp(Einheitstyp::TYP_STELLPLATZ),
            '[tenummer-lagerraum]' => $datenblatt->haus->getTenummerForEinheitstyp(Einheitstyp::TYP_LAGERRAUM),
            '[tenummer-garage]' => $datenblatt->haus->getTenummerForEinheitstyp(Einheitstyp::TYP_GARAGE),
            '[tenummer-aussenstellplatz]' => $datenblatt->haus->getTenummerForEinheitstyp(Einheitstyp::TYP_AUSSENSTELLPLATZ),
            '[tenummer-keller]' => $datenblatt->haus->getTenummerForEinheitstyp(Einheitstyp::TYP_KELLER),
            '[einheitstypname-stellplatz]' => $einheitstypStellplatz->name,
            '[einheitstypname-lagerraum]' => $einheitstypLagerraum->name,
            '[einheitstypname-garage]' => $einheitstypGarage->name,
            '[einheitstypname-aussenstellplatz]' => $einheitstypAussenstellplatz->name,
            '[einheitstypname-keller]' => $einheitstypKeller->name,
            '[sonderwuensche-zusammenfassung]' => $datenblatt->getSonderwunschZusammenfassungTabelle(),
            '[aktuelles-datum]' => date('d.m.Y'),
        ];

        return $replaceData;
    }

    public function getSonderwunschPdfContent(Vorlage $vorlage) {

        $content = $this->projekt->mail_header;
        $content .= strtr($vorlage->text, $this->getReplaceData());
        $content .=
            '<div class="footer" style="font-size: 9px; text-align: center; position: absolute; bottom: 40px; width: 85%;">'
            . $this->projekt->mail_footer
            . '</div>';

        return $content;
    }

    public function getAngeforderteSonderwuensche() {
        $result = [];
        foreach ($this->sonderwunsches as $sonderwunsch) {
            if (!empty($sonderwunsch->beauftragt_datum)) {
                $result[] = $sonderwunsch;
            }
        }
        return $result;
    }

    public function getSonderwunschZusammenfassungTabelle() {
        $sonderwuenscheZusammenfassung = '<table style="width: 60%; margin: 0 auto;">';
        foreach ($this->getAngeforderteSonderwuensche() as $sonderwunsch) {
            $sonderwuenscheZusammenfassung .= '<tr>';
            $sonderwuenscheZusammenfassung .= '<td>';
            $sonderwuenscheZusammenfassung .= "Beauftragt vom " . Yii::$app->formatter->asDate($sonderwunsch->beauftragt_datum). " ($sonderwunsch->name)";
            $sonderwuenscheZusammenfassung .= '</td>';
            $sonderwuenscheZusammenfassung .= '<td style="text-align: right;">';
            $sonderwuenscheZusammenfassung .= Yii::$app->formatter->asCurrency($sonderwunsch->beauftragt_betrag);
            $sonderwuenscheZusammenfassung .= '</td>';
            $sonderwuenscheZusammenfassung .= '</tr>';
        }
        $sonderwuenscheZusammenfassung .= '<tr class="bordertop">';
        $sonderwuenscheZusammenfassung .= '<td>';
        $sonderwuenscheZusammenfassung .= "<b>Zahlungsbetrag Gesamt</b>";
        $sonderwuenscheZusammenfassung .= '</td>';
        $sonderwuenscheZusammenfassung .= '<td style="text-align: right;">';
        $sonderwuenscheZusammenfassung .= "<b>".Yii::$app->formatter->asCurrency($this->getSonderwunschBeauftragtSumme()) . "</b>";
        $sonderwuenscheZusammenfassung .= '</td>';
        $sonderwuenscheZusammenfassung .= '</tr>';
        $sonderwuenscheZusammenfassung .= '</table>';

        return $sonderwuenscheZusammenfassung;
    }

}
