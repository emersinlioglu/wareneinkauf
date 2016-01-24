<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sonderwunsch".
 *
 * @property string $id
 * @property integer $datenblatt_id
 * @property string $name
 * @property string $angebot_datum
 * @property double $angebot_betrag
 * @property string $beauftragt_datum
 * @property double $beauftragt_betrag
 * @property string $rechnungsstellung_datum
 * @property double $rechnungsstellung_betrag
 * @property string $rechnungsstellung_rg_nr
 *
 * @property Datenblatt $datenblatt
 */
class Sonderwunsch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sonderwunsch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['datenblatt_id'], 'required'],
            [['datenblatt_id'], 'integer'],
            [['angebot_datum', 'beauftragt_datum', 'rechnungsstellung_datum'], 'safe'],
            [['angebot_betrag', 'beauftragt_betrag', 'rechnungsstellung_betrag'], 'number'],
            [['name', 'rechnungsstellung_rg_nr'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'datenblatt_id' => Yii::t('app', 'Datenblatt ID'),
            'name' => Yii::t('app', 'Name'),
            'angebot_datum' => Yii::t('app', 'Angebot Datum'),
            'angebot_betrag' => Yii::t('app', 'Angebot Betrag'),
            'beauftragt_datum' => Yii::t('app', 'Beauftragt Datum'),
            'beauftragt_betrag' => Yii::t('app', 'Beauftragt Betrag'),
            'rechnungsstellung_datum' => Yii::t('app', 'Rechnungsstellung Datum'),
            'rechnungsstellung_betrag' => Yii::t('app', 'Rechnungsstellung Betrag'),
            'rechnungsstellung_rg_nr' => Yii::t('app', 'Rechnungsstellung Rg Nr'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatenblatt()
    {
        return $this->hasOne(Datenblatt::className(), ['id' => 'datenblatt_id']);
    }
}
