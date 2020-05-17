<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hersteller".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Artikel[] $artikels
 */
class Hersteller extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hersteller';
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
    public function getArtikels()
    {
        return $this->hasMany(Artikel::className(), ['hersteller_id' => 'id']);
    }
}
