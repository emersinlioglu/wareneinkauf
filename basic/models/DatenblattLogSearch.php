<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DatenblattLog;

/**
 * DatenblattLogSearch represents the model behind the search form about `app\models\DatenblattLog`.
 */
class DatenblattLogSearch extends DatenblattLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'firma_id', 'projekt_id', 'haus_id', 'nummer', 'kaeufer_id', 'aktiv', 'auflassung', 'creator_user_id', 'deleted_by'], 'integer'],
            [['besondere_regelungen_kaufvertrag', 'sonstige_anmerkungen', 'beurkundung_am', 'verbindliche_fertigstellung', 'uebergang_bnl', 'abnahme_se', 'abnahme_ge', 'sap_debitor_nr', 'intern_debitor_nr'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = DatenblattLog::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'firma_id' => $this->firma_id,
            'projekt_id' => $this->projekt_id,
            'haus_id' => $this->haus_id,
            'nummer' => $this->nummer,
            'kaeufer_id' => $this->kaeufer_id,
            'aktiv' => $this->aktiv,
            'beurkundung_am' => $this->beurkundung_am,
            'verbindliche_fertigstellung' => $this->verbindliche_fertigstellung,
            'uebergang_bnl' => $this->uebergang_bnl,
            'abnahme_se' => $this->abnahme_se,
            'abnahme_ge' => $this->abnahme_ge,
            'auflassung' => $this->auflassung,
            'creator_user_id' => $this->creator_user_id,
            'deleted_by' => $this->deleted_by,
        ]);

        $query->andFilterWhere(['like', 'besondere_regelungen_kaufvertrag', $this->besondere_regelungen_kaufvertrag])
            ->andFilterWhere(['like', 'sonstige_anmerkungen', $this->sonstige_anmerkungen])
            ->andFilterWhere(['like', 'sap_debitor_nr', $this->sap_debitor_nr])
            ->andFilterWhere(['like', 'intern_debitor_nr', $this->intern_debitor_nr]);

        return $dataProvider;
    }
}
