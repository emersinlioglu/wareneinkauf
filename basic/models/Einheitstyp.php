<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "einheitstyp".
 *
 * @property string $id
 * @property string $name
 * @property string $einheit
 *
 * @property Teileigentumseinheit[] $teileigentumseinheits
 */
class Einheitstyp extends \yii\db\ActiveRecord
{
    
    const TYPE_HAUS = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'einheitstyp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['einheit'], 'required'],
            [['name'], 'string', 'max' => 45],
            [['einheit'], 'string', 'max' => 255]
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
            'einheit' => 'Einheit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeileigentumseinheits()
    {
        return $this->hasMany(Teileigentumseinheit::className(), ['einheitstyp_id' => 'id']);
    }

    /**
     * Gesamt Wohnflaesche von allen Projekten Pro Einheitstyp
     *
     * @return array
     */
    public function getWohnflaescheProEinheitstypData() {

        $sql = '
            SELECT 
              et.name, 
              SUM(te.wohnflaeche) as y
            FROM 
              einheitstyp et
            LEFT JOIN teileigentumseinheit te on te.einheitstyp_id = et.id
            GROUP BY et.id
        ';
        $rows = Yii::$app->getDb()->createCommand($sql)->queryAll();

        return $rows;
    }

    /**
     * Gesamt Wohnflaesche von einem Projekt Pro Einheitstyp
     *
     * @param null $projektId
     * @return array
     */
    public function getProjektVerkaufsentwicklungData($projektId = null) {

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
}
