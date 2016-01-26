<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Haus;

/**
 * HausSearch represents the model behind the search form about `app\models\Haus`.
 */
class HausSearch extends Haus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'projekt_id', 'reserviert', 'verkauft', 'rechnung_vertrieb'], 'integer'],
            [['plz', 'ort', 'strasse', 'hausnr'], 'safe'],
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
        $query = Haus::find();

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
            'projekt_id' => $this->projekt_id,
            'reserviert' => $this->reserviert,
            'verkauft' => $this->verkauft,
            'rechnung_vertrieb' => $this->rechnung_vertrieb,
        ]);

        $query->andFilterWhere(['like', 'plz', $this->plz])
            ->andFilterWhere(['like', 'ort', $this->ort])
            ->andFilterWhere(['like', 'strasse', $this->strasse])
            ->andFilterWhere(['like', 'hausnr', $this->hausnr]);

        return $dataProvider;
    }
}
