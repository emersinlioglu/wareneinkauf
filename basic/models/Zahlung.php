<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zahlung".
 *
 * @property string $id
 * @property integer $datenblatt_id
 * @property double $betrag
 * @property string $datum
 *
 * @property Datenblatt $datenblatt
 */
class Zahlung extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zahlung';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['datenblatt_id', 'datum'], 'required'],
            [['datenblatt_id'], 'required'],
            [['datenblatt_id'], 'integer'],
            [['betrag'], 'number'],
            [['datum'], 'safe']
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
            'betrag' => Yii::t('app', 'Betrag'),
            'datum' => Yii::t('app', 'Datum'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatenblatt()
    {
        return $this->hasOne(Datenblatt::className(), ['id' => 'datenblatt_id']);
    }
}
