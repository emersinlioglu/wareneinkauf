<?php

namespace app\models;

/**
 * Class User
 *
 * @property Projekt[] $projekts
 * @property DynagridProfile[] $dynagridProfiles
 * @property QueryBuilderProfile[] $queryBuilderProfiles
 *
 * @package app\models
 */
class User extends \webvimark\modules\UserManagement\models\User {

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjekts() {
        return $this->hasMany(Projekt::className(), ['id' => 'projekt_id'])
            ->viaTable('projekt_user', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDynagridProfiles() {
        return $this->hasMany(DynagridProfile::className(), ['user_id' => 'id']);
    }

    public static function getProjktsFromCurrentUser() {
        $projekts = [];
        $currentUser = self::getCurrentUser();
        if ($currentUser) {
            $user = User::findOne($currentUser->id);
            $projekts = $user->projekts;
        }
        return $projekts;
    }

    public function getQueryBuilderProfiles() {
        return $this->hasMany(QueryBuilderProfile::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktiveDynagridProfileId() {
        $dynagridProfileId = '';
        /** @var DynagridProfile $dynagridProfile */
        foreach ($this->dynagridProfiles as $dynagridProfile) {
            if ($dynagridProfile->aktive) {
                $dynagridProfileId = $dynagridProfile->id;
            }
        }
        return $dynagridProfileId;
    }

}
