<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "abschlag".
 *
 * @property integer $id
 * @property integer $datenblatt_id
 * @property integer $sonderwunch_id
 *
 * @property Datenblatt $datenblatt
 * @property Sonderwunch $sonderwunch
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
            [['id', 'datenblatt_id', 'sonderwunch_id'], 'required'],
            [['id', 'datenblatt_id', 'sonderwunch_id'], 'integer']
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
            'sonderwunch_id' => Yii::t('app', 'Sonderwunch ID'),
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
    public function getSonderwunch()
    {
        return $this->hasOne(Sonderwunch::className(), ['id' => 'sonderwunch_id']);
    }
}
