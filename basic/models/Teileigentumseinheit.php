<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teileigentumseinheit".
 *
 * @property string $id
 * @property integer $haus_id
 * @property integer $einheitstyp_id
 * @property integer $projekt_id
 * @property string $te_nummer
 * @property integer $gefoerdert
 * @property string $geschoss
 * @property string $zimmer
 * @property string $me_anteil
 * @property double $wohnflaeche
 * @property double $kaufpreis
 * @property double $kp_einheit
 *
 * @property double $forecast_preis
 * @property double $verkaufspreis
 * @property string $verkaufspreis_begruendung
 *
 * @property Einheitstyp $einheitstyp
 * @property Projekt $projekt
 * @property Haus $haus
 */
class Teileigentumseinheit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teileigentumseinheit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['te_nummer', 'einheitstyp_id'], 'required'],
            [['haus_id', 'einheitstyp_id', 'gefoerdert'], 'integer'],
            [['kaufpreis', 'kp_einheit', 'wohnflaeche', 'forecast_preis', 'verkaufspreis'], 'number'],
            [['te_nummer'], 'string', 'max' => 255],
            [['geschoss', 'zimmer', 'me_anteil', ], 'string', 'max' => 45],
            [['forecast_preis', 'verkaufspreis', 'verkaufspreis_begruendung'], 'checkRequirement'],
        ];
    }

    public function checkRequirement($attribute, $params)
    {
        if ($this->forecast_preis != $this->verkaufspreis && strlen($this->verkaufspreis_begruendung) == 0) {
            $this->addError('verkaufspreis_begruendung', 'Das Feld "Begründung" darf nicht leer sein');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'haus_id' => Yii::t('app', 'Haus ID'),
            'einheitstyp_id' => Yii::t('app', 'Einheitstyp'),
            'te_nummer' => Yii::t('app', 'Te Nummer'),
            'gefoerdert' => Yii::t('app', 'Gefoerdert'),
            'geschoss' => Yii::t('app', 'Geschoss'),
            'zimmer' => Yii::t('app', 'Zimmer'),
            'me_anteil' => Yii::t('app', 'Me Anteil'),
            'wohnflaeche' => Yii::t('app', 'Wohnflaeche'),
            'kaufpreis' => Yii::t('app', 'Kaufpreis'),
            'kp_einheit' => Yii::t('app', 'Kp Einheit'),
            'forecast_price' => Yii::t('app', 'Forecast'),
            'verkaufspreis' => Yii::t('app', 'Verkaufspreis'),
            'verkaufspreis_begruendung' => Yii::t('app', 'Begründung'),
        ];
    }

    public function afterFind()
    {
        parent::afterFind(); // TODO: Change the autogenerated stub

        if ($this->wohnflaeche > 0) {
            $this->kp_einheit = (float)$this->kaufpreis / (float)$this->wohnflaeche;
        } else {
            $this->kp_einheit = 0;
        }
    }

        /**
     * @return \yii\db\ActiveQuery
     */
    public function getEinheitstyp()
    {
        return $this->hasOne(Einheitstyp::className(), ['id' => 'einheitstyp_id']);
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
    public function getHaus()
    {
        return $this->hasOne(Haus::className(), ['id' => 'haus_id']);
    }
}
