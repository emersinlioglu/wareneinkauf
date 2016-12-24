<?php

namespace app\models;
use webvimark\modules\UserManagement\models\User;

use Yii;

/**
 * This is the model class for table "projekt".
 *
 * @property string $id
 * @property string $name
 * @property string $firma_id
 * @property string $creator_user_id
 *
 * @property Haus[] $hauses
 * @property Firma $firma
 */
class Projekt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projekt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firma_id', 'creator_user_id'], 'required'],
            [['firma_id', 'creator_user_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Projektname'),
            'firma_id' => Yii::t('app', 'Firma ID'),
            'creator_user_id' => Yii::t('app', 'Ersteller ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHauses()
    {
        return $this->hasMany(Haus::className(), ['projekt_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFirma()
    {
        return $this->hasOne(Firma::className(), ['id' => 'firma_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers() {
        return $this->hasMany(User::className(), ['id' => 'user_id'])
          ->viaTable('projekt_user', ['projekt_id' => 'id']);
    }

    /**
     * Checks if projekt is existing for the firma
     * @return bool
     */
    public function isProjektExistingForFirma() {

        $count = self::find()->where(array('name' => $this->name, 'firma_id' => $this->firma_id))->count();
        if ($count > 0) {
            $this->addError('name', 'Die Firma hat bereits ein Projekt unter dem Namen.');
            return true;
        }

        return false;
    }

}
