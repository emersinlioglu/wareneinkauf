<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "protokoll".
 *
 * @property string $id
 * @property integer $user_id
 * @property integer $datenblatt_id
 * @property string $erstellt_am
 * @property string $bemerkung
 *
 * @property Datenblatt $datenblatt
 * @property User $user
 */
class Protokoll extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'protokoll';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'datenblatt_id'], 'required'],
            [['user_id', 'datenblatt_id'], 'integer'],
            [['erstellt_am'], 'safe'],
            [['bemerkung'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'datenblatt_id' => 'Datenblatt ID',
            'erstellt_am' => 'Erstellt Am',
            'bemerkung' => 'Bemerkung',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatenblatt()
    {
        return $this->hasOne(Datenblatt::className(), ['id' => 'datenblatt_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
