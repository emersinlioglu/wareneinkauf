<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "konfiguration_user".
 *
 * @property integer $id
 * @property integer $konfiguration_id
 * @property integer $user_id
 * @property string $zustimmung_datum
 *
 * @property Konfiguration $konfiguration
 * @property User $user
 */
class KonfigurationUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'konfiguration_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['konfiguration_id', 'user_id'], 'integer'],
            [['zustimmung_datum'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'konfiguration_id' => 'Konfiguration ID',
            'user_id' => 'User ID',
            'zustimmung_datum' => 'Zustimmung Datum',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKonfiguration()
    {
        return $this->hasOne(Konfiguration::className(), ['id' => 'konfiguration_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
