<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "haus".
 *
 * @property integer $id
 * @property string $projekt_id
 *
 * @property Datenblatt[] $datenblatts
 * @property Projekt $projekt
 * @property Teileigentumseinheit[] $teileigentumseinheits
 * @property Zaehlerstand[] $zaehlerstands
 */
class Haus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'haus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['projekt_id'], 'required'],
            [['projekt_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'projekt_id' => Yii::t('app', 'Projekt ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatenblatts()
    {
        return $this->hasMany(Datenblatt::className(), ['haus_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjekt()
    {
        return $this->hasOne(Projekt::className(), ['id' => 'projekt_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeileigentumseinheits()
    {
        return $this->hasMany(Teileigentumseinheit::className(), ['haus_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZaehlerstands()
    {
        return $this->hasMany(Zaehlerstand::className(), ['haus_id' => 'id']);
    }
}
