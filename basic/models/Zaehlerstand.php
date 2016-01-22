<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zaehlerstand".
 *
 * @property string $id
 * @property string $name
 * @property string $stand
 * @property integer $haus_id
 *
 * @property Haus $haus
 */
class Zaehlerstand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zaehlerstand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['haus_id'], 'required'],
            [['haus_id'], 'integer'],
            [['name', 'stand'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'stand' => Yii::t('app', 'Stand'),
            'haus_id' => Yii::t('app', 'Haus ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHaus()
    {
        return $this->hasOne(Haus::className(), ['id' => 'haus_id']);
    }
}
