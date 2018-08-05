<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "konfiguration_typ".
 *
 * @property string $id
 * @property string $name
 *
 * @property Konfiguration[] $konfigurations
 */
class KonfigurationTyp extends \yii\db\ActiveRecord
{
    const TYPE_INFORMATION = 1;
    const TYPE_DATENSCHUTZ = 2;
    const TYPE_LIZENZBERECHTIGUNG = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'konfiguration_typ';
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
    public function getKonfigurations()
    {
        return $this->hasMany(Konfiguration::className(), ['konfiguration_typ_id' => 'id']);
    }
}
