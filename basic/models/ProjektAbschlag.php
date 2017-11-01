<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projekt_abschlag".
 *
 * @property string $id
 * @property string $name
 * @property double $kaufvertrag_prozent
 * @property string $projekt_id
 *
 * @property Meilenstein[] $meilensteins
 * @property Projekt $projekt
 */
class ProjektAbschlag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projekt_abschlag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kaufvertrag_prozent'], 'number'],
            [['projekt_id'], 'integer'],
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
            'kaufvertrag_prozent' => 'Kaufvertrag Prozent',
            'projekt_id' => 'Projekt ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeilensteins()
    {
        return $this->hasMany(Meilenstein::className(), ['projekt_abschlag_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjekt()
    {
        return $this->hasOne(Projekt::className(), ['id' => 'projekt_id']);
    }

    public function getKaufvertragProzentSumme() {
        $summe = 0;
        foreach ($this->meilensteins as $meilenstein) {
            $summe += $meilenstein->kaufvertrag_prozent;
        }
        return $summe;
    }

    public function getZuordnungenAsString() {
        $ids = [];
        foreach ($this->meilensteins as $meilenstein) {
            $ids[] = $meilenstein->id;
        }
        return implode(',', $ids);
    }
}
