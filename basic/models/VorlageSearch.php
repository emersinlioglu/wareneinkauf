<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vorlage;

/**
 * VorlageSearch represents the model behind the search form about `app\models\Vorlage`.
 */
class VorlageSearch extends Vorlage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'vorlage_typ_id'], 'integer'],
            [['name', 'betreff', 'text'], 'safe'],
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
        $query = Vorlage::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->with(['vorlageTyp']);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'vorlage_typ_id' => $this->vorlage_typ_id,
        ]);

        $query->andWhere('deleted IS NULL');

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'betreff', $this->betreff])
            ->andFilterWhere(['like', 'text', $this->text])
        ;

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchByQueryBuilder($rules, $projektId, $params)
    {
        $query = Vorlage::find();
        $query->joinWith(['projekt']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->with(['vorlageTyp']);
      //  $query->where(['projekt.id' => $projektId]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'vorlage_typ_id' => $this->vorlage_typ_id,
            'projekt.id' => $projektId,
        ]);

        $query->andWhere('deleted IS NULL');

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'betreff', $this->betreff])
            ->andFilterWhere(['like', 'text', $this->text])
        ;

        return $dataProvider;
    }
}
