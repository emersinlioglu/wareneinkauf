<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rechnung".
 *
 * @property integer $id
 * @property string $datum
 * @property string $nummer
 * @property integer $lieferant_id
 *
 * @property Lieferant $lieferant
 * @property RechnungItem[] $rechnungItems
 */
class Rechnung extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rechnung';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['datum', 'nummer'], 'required'],
            [['datum'], 'safe'],
            [['lieferant_id'], 'integer'],
            [['nummer'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'datum' => 'Datum',
            'nummer' => 'Nummer',
            'lieferant_id' => 'Lieferant ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLieferant()
    {
        return $this->hasOne(Lieferant::className(), ['id' => 'lieferant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRechnungItems()
    {
        return $this->hasMany(RechnungItem::className(), ['rechnung_id' => 'id']);
    }
}
