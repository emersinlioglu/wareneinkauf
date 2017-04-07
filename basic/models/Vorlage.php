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
            [['name', 'betreff', 'text'], 'required'],
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
            'text' => 'Text',
            'deleted' => 'Gelöscht',
        ];
    }
}
