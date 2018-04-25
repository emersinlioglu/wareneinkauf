<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kaeufer_projekt".
 *
 * @property string $id
 * @property string $kaeufer_id
 * @property string $projekt_id
 *
 * @property Kaeufer $kaeufer
 * @property Projekt $projekt
 */
class KaeuferProjekt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kaeufer_projekt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kaeufer_id', 'projekt_id'], 'required'],
            [['kaeufer_id', 'projekt_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kaeufer_id' => 'Kaeufer ID',
            'projekt_id' => 'Projekt ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKaeufer()
    {
        return $this->hasOne(Kaeufer::className(), ['id' => 'kaeufer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjekt()
    {
        return $this->hasOne(Projekt::className(), ['id' => 'projekt_id']);
    }
}
