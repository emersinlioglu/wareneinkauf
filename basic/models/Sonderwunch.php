<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sonderwunch".
 *
 * @property integer $id
 * @property integer $datenblatt_id
 *
 * @property Abschlag[] $abschlags
 * @property Datenblatt $datenblatt
 */
class Sonderwunch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sonderwunch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'datenblatt_id'], 'required'],
            [['id', 'datenblatt_id'], 'integer']
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
    public function getAbschlags()
    {
        return $this->hasMany(Abschlag::className(), ['sonderwunch_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatenblatt()
    {
        return $this->hasOne(Datenblatt::className(), ['id' => 'datenblatt_id']);
    }
}
