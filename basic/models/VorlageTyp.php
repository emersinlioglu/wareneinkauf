<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vorlage_typ".
 *
 * @property string $id
 * @property string $name
 *
 * @property Vorlage[] $vorlages
 */
class VorlageTyp extends \yii\db\ActiveRecord
{
    const TYPE_ABSCHLAG = 1;
    const TYPE_SONDERWUNSCH = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vorlage_typ';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVorlages()
    {
        return $this->hasMany(Vorlage::className(), ['vorlage_typ_id' => 'id']);
    }
}
