<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "warenart".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Artikel[] $artikels
 */
class Warenart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warenart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
        return $this->hasMany(Artikel::className(), ['warenart_id' => 'id']);
    }
}
