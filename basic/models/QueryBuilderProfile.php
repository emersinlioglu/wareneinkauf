<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "query_builder_profile".
 *
 * @property string $id
 * @property string $name
 * @property string $filter_rules
 * @property integer $aktive
 * @property integer $user_id
 *
 * @property User $user
 */
class QueryBuilderProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'query_builder_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name'], 'required'],
            [['user_id', 'aktive'], 'integer'],
            [['filter_rules'], 'string'],
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
            'filter_rules' => 'Filter Rules',
            'aktive' => 'Aktive',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function getAktiveProfile() {
        return $model = self::find()->where([
            'aktive' => 1,
            'user_id' => User::getCurrentUser()->id,
        ])->one();
    }

    public static function getAktiveProfileId() {
        $model = self::getAktiveProfile();
        return $model ? $model->id : '';
    }

    public static function getProfilesForCurrentUser() {
        return self::find()->where([
            'user_id' => User::getCurrentUser()->id,
        ])->all();
    }

    public static function getActiveFilterRules() {
        $model = self::findOne([
            'user_id' => User::getCurrentUser()->id,
            'aktive' => true
        ]);
        return $model ? $model->filter_rules : '';
    }

}
