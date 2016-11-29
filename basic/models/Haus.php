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
 * @property integer $reserviert
 * @property integer $verkauft
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
            [['projekt_id', 'firma_id', 'reserviert', 'verkauft', 'rechnung_vertrieb', 'creator_user_id'], 'integer'],
            [['plz', 'ort', 'strasse'], 'string', 'max' => 255],
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
            'reserviert' => Yii::t('app', 'Reserviert'),
            'verkauft' => Yii::t('app', 'Verkauft'),
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
}
