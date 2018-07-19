<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vorlage".
 *
 * @property integer $id
 * @property string $name
 * @property string $betreff
 * @property string $text
 * @property string $deleted
 *
 * @property VorlageTyp $vorlageTyp
 * @property Projekt $projekt
 */
class Vorlage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vorlage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'betreff', 'text', 'vorlage_typ_id'], 'required'],
            [['vorlage_typ_id', 'projekt_id'], 'integer'],
            [['deleted'], 'safe'],
            [['text'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['betreff'], 'string', 'max' => 512]
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
            'betreff' => 'Betreff',
            'text' => 'Vorlage',
            'deleted' => 'Gelöscht',
            'vorlage_typ_id' => 'Typ',
            'projekt_id' => 'Projekt',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbschlags()
    {
        return $this->hasMany(Abschlag::className(), ['vorlage_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVorlageTyp()
    {
        return $this->hasOne(VorlageTyp::className(), ['id' => 'vorlage_typ_id']);
    }

    public static function getVorlagen($vorlageTypId, $projektId) {
        return Vorlage::find()
            ->where([
                'deleted' => null,
                'vorlage_typ_id' => $vorlageTypId,
                'projekt_id' => $projektId,
            ])
            ->all();
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjekt()
    {
        return $this->hasOne(Projekt::className(), ['id' => 'projekt_id']);
    }
}
