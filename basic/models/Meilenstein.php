<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "meilenstein".
 *
 * @property string $id
 * @property string $name
 * @property string $number
 * @property double $kaufvertrag_prozent
 * @property string $projekt_id
 * @property string $projekt_abschlag_id
 *
 * @property AbschlagMeilenstein[] $abschlagMeilensteins
 * @property Projekt $projekt
 * @property ProjektAbschlag $projektAbschlag
 */
class Meilenstein extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meilenstein';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
            [['kaufvertrag_prozent'], 'number'],
            [['number', 'projekt_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kaufvertrag_prozent' => 'Kaufvertrag Prozent',
            'number' => 'Number',
            'name' => 'Name',
            'projekt_id' => 'Projekt ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbschlagMeilensteins()
    {
        return $this->hasMany(AbschlagMeilenstein::className(), ['meilenstein_id' => 'id']);
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
    public function getProjektAbschlag()
    {
        return $this->hasOne(ProjektAbschlag::className(), ['id' => 'projekt_abschlag_id']);
    }
}
