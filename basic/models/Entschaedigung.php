<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entschaedigung".
 *
 * @property string $id
 * @property integer $datenblatt_id
 * @property string $datum
 * @property double $betrag
 * @property string $bemerkung
 *
 * @property Datenblatt $datenblatt
 */
class Entschaedigung extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entschaedigung';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['datenblatt_id'], 'required'],
            [['datenblatt_id'], 'integer'],
            [['datum'], 'safe'],
            [['betrag'], 'number'],
            [['bemerkung'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'datenblatt_id' => 'Datenblatt ID',
            'datum' => 'Datum',
            'betrag' => 'Betrag',
            'bemerkung' => 'Bemerkung',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatenblatt()
    {
        return $this->hasOne(Datenblatt::className(), ['id' => 'datenblatt_id']);
    }

    public function getDatumLabel()
    {
        if ($this->datum === null) {
            $label = '';
        } else {
            $label = Yii::$app->formatter->asDate($this->datum);
        }
        return $label;
    }
}
