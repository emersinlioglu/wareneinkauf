<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "abschlag_meilenstein".
 *
 * @property string $id
 * @property string $meilenstein_id
 * @property string $abschlag_id
 *
 * @property Abschlag $abschlag
 * @property Meilenstein $meilenstein
 */
class AbschlagMeilenstein extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'abschlag_meilenstein';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meilenstein_id', 'abschlag_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'meilenstein_id' => 'Meilenstein ID',
            'abschlag_id' => 'Abschlag ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbschlag()
    {
        return $this->hasOne(Abschlag::className(), ['id' => 'abschlag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeilenstein()
    {
        return $this->hasOne(Meilenstein::className(), ['id' => 'meilenstein_id']);
    }
}
