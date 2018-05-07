<?php

namespace app\models;
use yii\helpers\ArrayHelper;

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

    public static function getProjektsFromCurrentUser() {
        $projekts = [];
        $currentUser = self::getCurrentUser();
        if ($currentUser) {

            $user = User::findOne($currentUser->id);
            $projekts = User::hasRole('admin') ? \app\models\Projekt::find()->all() : $user->projekts;
        }

        return $projekts;
    }

    public static function getFirmenFromCurrentUser() {
        $firmen = [];
        $currentUser = self::getCurrentUser();
        if ($currentUser) {

            $user = User::findOne($currentUser->id);

            /** @var Projekt $projekt */
            $projetks = User::hasRole('admin') ? \app\models\Projekt::find()->all() : $user->projekts;
            foreach ($projetks as $projekt) {
                $firmen[$projekt->firma_id] = $projekt->firma;
            }
        }

        return $firmen;
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

    public static function getProjects() {
        $projekts = User::hasRole('admin') ? \app\models\Projekt::find()->all() : \app\models\User::getProjektsFromCurrentUser();
        return $projekts;
    }

    public static function getAccessableProjektIds() {
        return ArrayHelper::map(User::getProjects(), 'id', 'id');;
    }

    public static function setActiveProjekt($projektId) {
        \Yii::$app->session->set('activeProjektId', $projektId);
    }

    public static function getActiveProjekt() {
        $activeProjektId = \Yii::$app->session->get('activeProjektId');
        $activeProjekt = null;
        if (!$activeProjektId) {
            $projekts = User::getProjects();
            if (count($projekts)) {
                $activeProjekt = $projekts[0];
                self::setActiveProjekt($activeProjekt->id);
            }
        } else {
            $activeProjekt = Projekt::findOne($activeProjektId);
        }
        return $activeProjekt;
    }

    public static function getActiveProjektName() {
        if ($activeProjekt = self::getActiveProjekt()) {
            return $activeProjekt->name;
        }
        return '';
    }

    public static function hasAccessToProject() {
        $query = Projekt::find();
        $projektId = User::getActiveProjekt() ? User::getActiveProjekt()->id : null;
        if (!\Yii::$app->user->isSuperadmin) {
            $query->leftJoin('projekt_user pu', 'pu.projekt_id = projekt.id AND projekt.id = ' . $projektId);
            $query->andFilterWhere(['or',
                ['projekt.creator_user_id' => \Yii::$app->user->identity->getId()],
                ['pu.user_id' => \Yii::$app->user->identity->getId()]
            ]);

            return $query->count() > 0;
        } else {
            return true;
        }
    }

}
