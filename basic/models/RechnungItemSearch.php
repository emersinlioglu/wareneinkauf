<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RechnungItem;

/**
 * RechnungItemSearch represents the model behind the search form about `app\models\RechnungItem`.
 */
class RechnungItemSearch extends RechnungItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'rechnung_id', 'anzahl', 'kunde_id', 'artikel_id'], 'integer'],
            [['netto_einzel_betrag'], 'number'],
            [['kunde_rechnungsnr', 'bemerkung', 'benutzernummer'], 'safe'],
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
        $query = RechnungItem::find();

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
            'rechnung_id' => $this->rechnung_id,
            'anzahl' => $this->anzahl,
            'netto_einzel_betrag' => $this->netto_einzel_betrag,
            'kunde_id' => $this->kunde_id,
            'artikel_id' => $this->artikel_id,
        ]);

        $query->andFilterWhere(['like', 'kunde_rechnungsnr', $this->kunde_rechnungsnr])
            ->andFilterWhere(['like', 'bemerkung', $this->bemerkung])
            ->andFilterWhere(['like', 'benutzernummer', $this->benutzernummer]);

        return $dataProvider;
    }
}
