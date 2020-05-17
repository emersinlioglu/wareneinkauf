<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rechnung;

/**
 * RechnungSearch represents the model behind the search form about `app\models\Rechnung`.
 */
class RechnungSearch extends Rechnung
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lieferant_id'], 'integer'],
            [['datum', 'nummer'], 'safe'],
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
        $query = Rechnung::find();

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
            'datum' => $this->datum,
            'lieferant_id' => $this->lieferant_id,
        ]);

        $query->andFilterWhere(['like', 'nummer', $this->nummer]);

        return $dataProvider;
    }
}
