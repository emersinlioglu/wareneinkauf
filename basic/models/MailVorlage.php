<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mail_vorlage".
 *
 * @property integer $id
 * @property string $name
 * @property string $betreff
 * @property string $text
 */
class MailVorlage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mail_vorlage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'betreff', 'text'], 'required'],
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
        ];
    }
}
