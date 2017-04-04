<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "abschlag".
 *
 * @property string $id
 * @property integer $datenblatt_id
 * @property string $name
 * @property double $kaufvertrag_prozent
 * @property string $kaufvertrag_betrag
 * @property string $kaufvertrag_angefordert
 * @property double $sonderwunsch_prozent
 * @property string $sonderwunsch_betrag
 * @property string $sonderwunsch_angefordert
 * @property string $summe
 * @property integer $mail_vorlage_id
 * @property string $mail_datum
 *
 * @property Datenblatt $datenblatt
 * @property MailVorlage $mailVorlage
 */
class Abschlag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'abschlag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['datenblatt_id'], 'required'],
            [['datenblatt_id', 'mail_vorlage_id'], 'integer'],
            [['kaufvertrag_prozent', 'sonderwunsch_prozent'], 'number'],
            [['kaufvertrag_angefordert', 'sonderwunsch_angefordert', 'mail_datum'], 'safe'],
            [['name', 'kaufvertrag_betrag', 'sonderwunsch_betrag', 'summe'], 'string', 'max' => 255]
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
            'kaufvertrag_prozent' => Yii::t('app', 'Kaufvertrag Prozent'),
            'kaufvertrag_betrag' => Yii::t('app', 'Kaufvertrag Betrag'),
            'kaufvertrag_angefordert' => Yii::t('app', 'Kaufvertrag Angefordert'),
            'sonderwunsch_prozent' => Yii::t('app', 'Sonderwunsch Prozent'),
            'sonderwunsch_betrag' => Yii::t('app', 'Sonderwunsch Betrag'),
            'sonderwunsch_angefordert' => Yii::t('app', 'Sonderwunsch Angefordert'),
            'summe' => Yii::t('app', 'Summe'),
            'mail_vorlage_id' => Yii::t('app', 'Mail-Vorlage-Id'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatenblatt()
    {
        return $this->hasOne(Datenblatt::className(), ['id' => 'datenblatt_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailVorlage()
    {
        return $this->hasOne(MailVorlage::className(), ['id' => 'mail_vorlage_id']);
    }

}
