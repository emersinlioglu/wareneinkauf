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

//    public static function getProjects() {
//        $projekts = User::hasRole('admin') ? \app\models\Projekt::find()->all() : \app\models\User::getProjektsFromCurrentUser();
//        return $projekts;
//    }
}
