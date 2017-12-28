<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dynagrid_profile".
 *
 * @property string $id
 * @property string $name
 * @property integer $user_id
 * @property integer $aktive
 *
 * @property User $user
 */
class DynagridProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dynagrid_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name'], 'required'],
            [['user_id', 'aktive'], 'integer'],
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
            'user_id' => 'User ID',
            'aktive' => 'Aktive',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function getProfilesForCurrentUser() {
        return self::findAll([
            'user_id' => User::getCurrentUser()->id
        ]);
    }
}
