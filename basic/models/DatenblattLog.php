<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "datenblatt_log".
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
 * @property integer $deleted_by
 *
 * @property Abschlag[] $abschlags
 * @property Firma $firma
 * @property Kaeufer $kaeufer
 * @property Projekt $projekt
 * @property User $deletedBy
 * @property User $createdBy
 */
class DatenblattLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'datenblatt_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
    public function getFirma()
    {
        return $this->hasOne(Firma::className(), ['id' => 'firma_id']);
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
    public function getTeileigentumseinheits()
    {
        return $this->hasMany(TeileigentumseinheitLog::className(), ['datenblatt_log_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeletedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'deleted_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'creator_user_id']);
    }

    /**
     * @return string
     */
    public function getTenummerHtml() {

        $wohnungsTenummer = array();
        $teNummers = array();

        foreach ($this->teileigentumseinheits as $te) {
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

        return implode('/ ', $teNummers);
    }

    /**
     * @return string
     */
    public function getTenummerList() {

        $wohnungsTenummer = array();
        $teNummers = array();

        foreach ($this->teileigentumseinheits as $te) {
            $teNummers[] = $te->te_nummer;
            if ($te->einheitstyp_id == 1) {
                $wohnungsTenummer[] = $te->te_nummer;
            }
        }
        asort($teNummers);

        return $teNummers;
    }

    public function calculate()
    {
        // calculate kaufpreis
        $kaufpreisTotal = 0;
        /* @var $teileh Teileigentumseinheit */
        foreach ($this-->teileigentumseinheits as $item) {
            $kaufpreisTotal += (float)$item->kaufpreis;
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
            foreach($this->teileigentumseinheits as $teileigentumseinheit) {
                $internDebitorNr .=
                    $teileigentumseinheit->einheitstyp->prefix_debitor_nr . $teileigentumseinheit->te_nummer;
            }
        }

        $this->intern_debitor_nr = $internDebitorNr;

        $this->save();
    }

    public function getKaeuferDaten() {
        $kaeuferDaten = array();
        $kaeufer = $this->kaeufer;
        if ($kaeufer) {

            if (strlen($kaeufer->vorname . $kaeufer->nachname) > 0) {
                $kaeuferDaten[] = [
                    'anrede' => $kaeufer->anrede,
                    'vorname' => $kaeufer->vorname,
                    'nachname' => $kaeufer->nachname
                ];
            }
            if (strlen($kaeufer->vorname2 . $kaeufer->nachname2) > 0) {
                $kaeuferDaten[] = [
                    'anrede' => $kaeufer->anrede2,
                    'vorname' => $kaeufer->vorname2,
                    'nachname' => $kaeufer->nachname2
                ];
            }
            if ($kaeufer->anrede == 0 && $kaeufer->anrede2 == 1) {
                $kaeuferDaten = array_reverse($kaeuferDaten);
            }
        }
        return $kaeuferDaten;
    }

    public function getBriefanrede() {
        return 'Sehr geehrte Damen und Herren,<br>';
    }

    public function getPersoenlicheBriefanrede() {
        //Sehr geehrte Frau XXX,
        //Sehr geehrter Herr XXX,
        //Sehr geehrte Frau XXX, sehr geehrter Herr XXX,
        //Sehr geehrter Herr XXX, sehr geehrter Herr XXX
        //Sehr geehrte Frau XXX, sehr geehrter Frau XXX,

        $persoenlicheBriefanrede = '';
        foreach ($this->getKaeuferDaten() as $key => $data) {
            $anredeSatz = $data['anrede'] == 1 ? 'sehr geehrte Frau' : 'sehr geehrter Herr';
            if ($key == 0) {
                $anredeSatz = ucfirst($anredeSatz);
            }
//            $persoenlicheBriefanrede .= $anredeSatz . ' ' . $data['vorname'] . ' ' . $data['nachname'] . ', ';
            $persoenlicheBriefanrede .= $anredeSatz . ' ' . $data['nachname'] . ', ';
        }
        $persoenlicheBriefanrede .= '<br>';

        return $persoenlicheBriefanrede;
    }

    public function getKaufpreisSumme() {
        $kaufvertragSumme = .0;
        foreach($this->abschlags as $abschlag) {
            $kaufvertragSumme += (float) $abschlag->kaufvertrag_betrag;
        }
        return $kaufvertragSumme;
    }

    public function getKaufpreisSummeFormatted() {
        return number_format($this->getKaufpreisSumme(), 2, ',', '.') . ' €';
    }
}
