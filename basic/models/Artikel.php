<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "artikel".
 *
 * @property integer $id
 * @property string $nummer
 * @property string $bezeichnung
 * @property string $hersteller_artikelnr
 * @property integer $hersteller_id
 * @property integer $warenart_id
 *
 * @property Hersteller $hersteller
 * @property Warenart $warenart
 * @property RechnungItem[] $rechnungItems
 */
class Artikel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'artikel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nummer'], 'required'],
            [['hersteller_id', 'warenart_id'], 'integer'],
            [['nummer', 'hersteller_artikelnr'], 'string', 'max' => 255],
            [['bezeichnung'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nummer' => 'Nummer',
            'bezeichnung' => 'Bezeichnung',
            'hersteller_artikelnr' => 'Hersteller Artikelnr',
            'hersteller_id' => 'Hersteller ID',
            'warenart_id' => 'Warenart ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHersteller()
    {
        return $this->hasOne(Hersteller::className(), ['id' => 'hersteller_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarenart()
    {
        return $this->hasOne(Warenart::className(), ['id' => 'warenart_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRechnungItems()
    {
        return $this->hasMany(RechnungItem::className(), ['artikel_id' => 'id']);
    }
}
