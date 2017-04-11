<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zinsverzug".
 *
 * @property string $id
 * @property integer $datenblatt_id
 * @property string $schreiben_vom
 * @property double $betrag
 * @property string $bemerkung
 *
 * @property Datenblatt $datenblatt
 */
class Zinsverzug extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zinsverzug';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['datenblatt_id'], 'required'],
            [['datenblatt_id'], 'integer'],
            [['schreiben_vom'], 'safe'],
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
            'schreiben_vom' => 'Schreiben Vom',
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


    public function getSchreibenVomLabel()
    {
        if ($this->schreiben_vom === null) {
            $label = '';
        } else {
            $label = Yii::$app->formatter->asDate($this->schreiben_vom);
        }
        return $label;
    }
}
