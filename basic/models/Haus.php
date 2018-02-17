<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "haus".
 *
 * @property string $id
 * @property string $projekt_id
 * @property string $plz
 * @property string $ort
 * @property string $strasse
 * @property string $hausnr
 * @property string $status
 * @property integer $rechnung_vertrieb
 * @property integer $creator_user_id
 *
 * @property Datenblatt[] $datenblatts
 * @property Projekt $projekt
 * @property Teileigentumseinheit[] $teileigentumseinheits
 * @property Zaehlerstand[] $zaehlerstands
 */
class Haus extends \yii\db\ActiveRecord
{
    const STATUS_FREI = 'frei';
    const STATUS_RESERVIERT = 'reserviert';
    const STATUS_VERKAUFT   = 'verkauft';

    public static function statusOptions() {
        return [
            Haus::STATUS_FREI => 'Frei',
            Haus::STATUS_RESERVIERT => 'Reserviert',
            Haus::STATUS_VERKAUFT => 'Verkauft'
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'haus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['creator_user_id'], 'required'],
            [['projekt_id', 'firma_id', 'rechnung_vertrieb', 'creator_user_id'], 'integer'],
            [['plz', 'ort', 'strasse', 'status'], 'string', 'max' => 255],
            [['hausnr'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'projekt_id' => Yii::t('app', 'Projekt ID'),
            'firma_id' => Yii::t('app', 'Firma ID'),
            'plz' => Yii::t('app', 'Plz'),
            'ort' => Yii::t('app', 'Ort'),
            'strasse' => Yii::t('app', 'Strasse'),
            'hausnr' => Yii::t('app', 'Hausnr'),
            'status' => Yii::t('app', 'Status'),
            'rechnung_vertrieb' => Yii::t('app', 'Rechnung Vertrieb'),
            'creator_user_id' => Yii::t('app', 'Ersteller ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatenblatts()
    {
        return $this->hasMany(Datenblatt::className(), ['haus_id' => 'id']);
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
    public function getFirma()
    {
        return $this->hasOne(Firma::className(), ['id' => 'firma_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeileigentumseinheits()
    {
        return $this->hasMany(Teileigentumseinheit::className(), ['haus_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZaehlerstands()
    {
        return $this->hasMany(Zaehlerstand::className(), ['haus_id' => 'id']);
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
	
    public function getTenummer() {

        $teNummer ='';
         foreach ($this->teileigentumseinheits as $te) {
           
            if ($te->einheitstyp_id == 1) {
                $teNummer= $te->te_nummer;
                break;
            }
        }
        return $teNummer;
    }

    public function getTenummerForEinheitstyp($einheitstypId, $nth = 1) {
        $tenummer = '';
        $found = 0;
        foreach ($this->teileigentumseinheits as $te) {
            if ($te->einheitstyp_id == $einheitstypId) {
                $found++;
                if ($found == $nth) {
                    $tenummer = $te->te_nummer;
                    break;
                }
            }
        }
        return $tenummer;
    }

    public function hatDatenblattMitAngefodertemAbschlag() {
        $result = false;
        /** @var Datenblatt $datenblatt */
        foreach ($this->datenblatts as $datenblatt) {
            $result |= $datenblatt->istAngefordert();
        }
        return $result;
    }

}
