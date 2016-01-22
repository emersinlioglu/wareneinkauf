<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "datenblatt".
 *
 * @property integer $id
 * @property integer $haus_id
 * @property integer $nummer
 *
 * @property Abschlag[] $abschlags
 * @property Haus $haus
 * @property KaeuferHasDatenblatt[] $kaeuferHasDatenblatts
 * @property Kaeufer[] $kaeufers
 * @property Nachlass[] $nachlasses
 * @property Sonderwunch[] $sonderwunches
 * @property Zahlung[] $zahlungs
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['haus_id', 'nummer'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'haus_id' => Yii::t('app', 'Haus ID'),
            'nummer' => Yii::t('app', 'Nummer'),
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
    public function getHaus()
    {
        return $this->hasOne(Haus::className(), ['id' => 'haus_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKaeuferHasDatenblatts()
    {
        return $this->hasMany(KaeuferHasDatenblatt::className(), ['datenblatt_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKaeufers()
    {
        return $this->hasMany(Kaeufer::className(), ['id' => 'kaeufer_id'])->viaTable('kaeufer_has_datenblatt', ['datenblatt_id' => 'id']);
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
    public function getSonderwunches()
    {
        return $this->hasMany(Sonderwunch::className(), ['datenblatt_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZahlungs()
    {
        return $this->hasMany(Zahlung::className(), ['datenblatt_id' => 'id']);
    }
}
