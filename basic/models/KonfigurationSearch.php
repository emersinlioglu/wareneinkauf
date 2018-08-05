<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Konfiguration;

/**
 * KonfigurationSearch represents the model behind the search form about `app\models\Konfiguration`.
 */
class KonfigurationSearch extends Konfiguration
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'zustimmung', 'konfiguration_typ_id'], 'integer'],
            [['name', 'text', 'deleted'], 'safe'],
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
        $query = Konfiguration::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->with(['konfigurationTyp']);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'zustimmung' => $this->zustimmung,
            'konfiguration_typ_id' => $this->konfiguration_typ_id,
           // 'deleted' => $this->deleted,
        ]);

      //  $query->andWhere('deleted IS NULL');

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['<=', 'deleted', $this->deleted]);

        return $dataProvider;
    }
}
