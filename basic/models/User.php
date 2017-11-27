<?php

namespace app\models;

/**
 * Class User
 *
 * @property Projekt[] $projekts
 * @property DynagridProfile[] $dynagridProfiles
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
