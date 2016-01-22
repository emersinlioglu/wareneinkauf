<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nachlass".
 *
 * @property string $id
 * @property integer $datenblatt_id
 *
 * @property Datenblatt $datenblatt
 */
class Nachlass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nachlass';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['datenblatt_id'], 'required'],
            [['datenblatt_id'], 'integer']
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
