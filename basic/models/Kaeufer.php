<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kaeufer".
 *
 * @property integer $id
 *
 * @property KaeuferHasDatenblatt[] $kaeuferHasDatenblatts
 * @property Datenblatt[] $datenblatts
 */
class Kaeufer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kaeufer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKaeuferHasDatenblatts()
    {
        return $this->hasMany(KaeuferHasDatenblatt::className(), ['kaeufer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatenblatts()
    {
        return $this->hasMany(Datenblatt::className(), ['id' => 'datenblatt_id'])->viaTable('kaeufer_has_datenblatt', ['kaeufer_id' => 'id']);
    }
}
