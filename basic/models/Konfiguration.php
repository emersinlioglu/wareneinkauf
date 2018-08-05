<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "konfiguration".
 *
 * @property integer $id
 * @property string $name
 * @property string $text
 * @property integer $zustimmung
 * @property string $deleted
 * @property string $konfiguration_typ_id
 *
 * @property KonfigurationTyp $konfigurationTyp
 */
class Konfiguration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'konfiguration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'text'], 'required'],
            [['text'], 'string'],
            [['zustimmung', 'konfiguration_typ_id'], 'integer'],
            [['deleted'], 'safe'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'text' => 'Konfiguration',
            'zustimmung' => 'Zustimmung',
            'deleted' => 'Anzeigen bis',
            'konfiguration_typ_id' => 'Typ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKonfigurationTyp()
    {
        return $this->hasOne(KonfigurationTyp::className(), ['id' => 'konfiguration_typ_id']);
    }

  /*  public static function getKonfigurationen($konfigurationTypId) {
        return Konfiguration::find()
            ->where([
                'deleted' => null,
                'konfiguration_typ_id' => $konfigurationTypId
            ])
            ->all();
    }*/
}
