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
 * @property string $plz
 * @property string $ort
 * @property string $strasse
 * @property string $hausnr
 * @property string $mail_header
 * @property string $mail_footer
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
            [['mail_header', 'mail_footer'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['plz', 'ort', 'strasse'], 'string', 'max' => 255],
            [['hausnr'], 'string', 'max' => 45]
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
            'plz' => Yii::t('app', 'Plz'),
            'ort' => Yii::t('app', 'Ort'),
            'strasse' => Yii::t('app', 'Strasse'),
            'hausnr' => Yii::t('app', 'Hausnr'),
            'mail_header' => 'Mail Header',
            'mail_footer' => 'Mail Footer',
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

    /**
     * Gesamt wohnfläche eines Projektes
     *
     * @param null $projektId
     * @return array
     */
    public function getWohnflaechenData($projektId = null) {

        $sql = '
            SELECT
              et.name as projektName,
              SUM(te.wohnflaeche) as summeWohnflaeche,
              p.id as projektId,
              et.id as einheitstypId
            FROM
              einheitstyp et
            LEFT JOIN teileigentumseinheit te on te.einheitstyp_id = et.id
            LEFT JOIN haus h on h.id = te.haus_id
            LEFT JOIN projekt p on p.id = h.projekt_id
            WHERE
              p.id = :projektId
            GROUP BY et.id
        ';
        $rows = Yii::$app->getDb()->createCommand($sql, [':projektId' => $projektId])->queryAll();

        return $rows;
    }

    /**
     * Gesamt wohnfläche von allen Projekten
     *
     * @return array
     */
    public function getWohnflaeschenDataFuerAlleProjekte() {
        $sql = '
            SELECT
              p.id as projektId,
              p.name as name,
              (
                SELECT 
                  SUM(te.wohnflaeche)
                FROM 
                  teileigentumseinheit te
                LEFT JOIN haus h on h.id = te.haus_id
                WHERE 
                  h.projekt_id = p.id
              ) as summeWohnflaeche
            FROM
              projekt p
        ';
        $rows = Yii::$app->getDb()->createCommand($sql)->queryAll();

        return $rows;
    }

}
