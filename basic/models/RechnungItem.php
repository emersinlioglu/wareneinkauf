<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rechnung_item".
 *
 * @property integer $id
 * @property integer $rechnung_id
 * @property integer $anzahl
 * @property string $netto_einzel_betrag
 * @property string $kunde_rechnungsnr
 * @property string $bemerkung
 * @property string $benutzernummer
 * @property string $seriennummer
 * @property integer $kunde_id
 * @property integer $artikel_id
 *
 * @property Artikel $artikel
 * @property Kunde $kunde
 * @property Rechnung $rechnung
 */
class RechnungItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rechnung_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rechnung_id', 'anzahl', 'kunde_id', 'artikel_id'], 'integer'],
            [['netto_einzel_betrag'], 'number'],
            [['bemerkung'], 'string'],
            [['kunde_rechnungsnr', 'benutzernummer', 'seriennummer'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rechnung_id' => 'Rechnung ID',
            'anzahl' => 'Anzahl',
            'netto_einzel_betrag' => 'Netto Einzel Betrag',
            'kunde_rechnungsnr' => 'Kunde Rechnungsnr',
            'bemerkung' => 'Bemerkung',
            'benutzernummer' => 'Benutzernummer',
            'seriennummer' => 'Seriennummer',
            'kunde_id' => 'Kunde ID',
            'artikel_id' => 'Artikel ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArtikel()
    {
        return $this->hasOne(Artikel::className(), ['id' => 'artikel_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKunde()
    {
        return $this->hasOne(Kunde::className(), ['id' => 'kunde_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRechnung()
    {
        return $this->hasOne(Rechnung::className(), ['id' => 'rechnung_id']);
    }
}
