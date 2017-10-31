<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "abschlag".
 *
 * @property string $id
 * @property integer $datenblatt_id
 * @property string $name
 * @property double $kaufvertrag_prozent
 * @property string $kaufvertrag_betrag
 * @property string $kaufvertrag_angefordert
 * @property double $sonderwunsch_prozent
 * @property string $sonderwunsch_betrag
 * @property string $sonderwunsch_angefordert
 * @property string $summe
 * @property integer $vorlage_id
 * @property string $erstell_datum
 * @property string $mail_gesendet
 *
 * @property Datenblatt $datenblatt
 * @property Vorlage $vorlage
 */
class Abschlag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'abschlag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['datenblatt_id'], 'required'],
            [['datenblatt_id', 'vorlage_id'], 'integer'],
            [['kaufvertrag_prozent', 'sonderwunsch_prozent'], 'number'],
            [['kaufvertrag_angefordert', 'sonderwunsch_angefordert', 'erstell_datum', 'mail_gesendet'], 'safe'],
            [['name', 'kaufvertrag_betrag', 'sonderwunsch_betrag', 'summe'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'datenblatt_id' => Yii::t('app', 'Datenblatt ID'),
            'name' => Yii::t('app', 'Name'),
            'kaufvertrag_prozent' => Yii::t('app', 'Kaufvertrag Prozent'),
            'kaufvertrag_betrag' => Yii::t('app', 'Kaufvertrag Betrag'),
            'kaufvertrag_angefordert' => Yii::t('app', 'Kaufvertrag Angefordert'),
            'sonderwunsch_prozent' => Yii::t('app', 'Sonderwunsch Prozent'),
            'sonderwunsch_betrag' => Yii::t('app', 'Sonderwunsch Betrag'),
            'sonderwunsch_angefordert' => Yii::t('app', 'Sonderwunsch Angefordert'),
            'summe' => Yii::t('app', 'Summe'),
            'vorlage_id' => Yii::t('app', 'Vorlage'),
            'mail_gesendet' => Yii::t('app', 'Mail gesendet am'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatenblatt()
    {
        return $this->hasOne(Datenblatt::className(), ['id' => 'datenblatt_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVorlage()
    {
        return $this->hasOne(Vorlage::className(), ['id' => 'vorlage_id']);
    }

    public function getPdfHeader()
    {
        $projekt = $this->datenblatt->projekt;
        return $projekt->mail_header;
    }

    public function getPdfFooter()
    {
        $projekt = $this->datenblatt->projekt;
        return $projekt->mail_footer;
    }

    public function getPdfContent()
    {
        $text = $this->vorlage ? $this->vorlage->text : '';

        $datenblatt = $this->datenblatt;
        $projekt = $datenblatt->projekt;

        $abschlagNr = 0;
        foreach($datenblatt->abschlags as $abschlag) {
            $abschlagNr++;
            if($abschlag->id == $this->id) {
                break;
            }
        }

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
        //foreach ($kaeuferDaten as $name) {
        //    $kaeuferNamen .= $name . '<br />';
        //}

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
            '[kaufpreisabrechnung-kaufvertrag-in-prozent]' => number_format($this->kaufvertrag_prozent, 2, ',', '.'),
            '[kaufpreisabrechnung-kaufvertrag-betrag]' => number_format($this->kaufvertrag_betrag, 2, ',', '.'),
            '[erstell-datum]' => Yii::$app->formatter->asDate($this->erstell_datum, 'medium'),
            '[abschlag-nr]' => $abschlagNr,
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
            '[aktuelles-datum]' => date('d.m.Y'),
        ];

        $content = $projekt->mail_header;
        $content .= strtr($text, $replaceData);
        $content .=
            '<div class="footer" style="font-size: 9px; text-align: center; position: absolute; bottom: 40px; width: 85%;">'
            . $abschlag->getPdfFooter()
            . '</div>';

        return $content;
    }

}
