<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lieferant".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Rechnung[] $rechnungs
 */
class Lieferant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lieferant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 124],
            [['name'], 'unique']
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRechnungs()
    {
        return $this->hasMany(Rechnung::className(), ['lieferant_id' => 'id']);
    }
}
