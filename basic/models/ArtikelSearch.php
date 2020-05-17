<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Artikel;

/**
 * ArtikelSearch represents the model behind the search form about `app\models\Artikel`.
 */
class ArtikelSearch extends Artikel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'hersteller_id', 'warenart_id'], 'integer'],
            [['nummer', 'bezeichnung', 'seriennummer', 'hersteller_artikelnr'], 'safe'],
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
        $query = Artikel::find();

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
            'hersteller_id' => $this->hersteller_id,
            'warenart_id' => $this->warenart_id,
        ]);

        $query->andFilterWhere(['like', 'nummer', $this->nummer])
            ->andFilterWhere(['like', 'bezeichnung', $this->bezeichnung])
            ->andFilterWhere(['like', 'seriennummer', $this->seriennummer])
            ->andFilterWhere(['like', 'hersteller_artikelnr', $this->hersteller_artikelnr]);

        return $dataProvider;
    }
}
