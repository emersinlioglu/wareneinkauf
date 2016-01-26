<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Datenblatt;

/**
 * DatenblattSearch represents the model behind the search form about `app\models\Datenblatt`.
 */
class DatenblattSearch extends Datenblatt
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'firma_id', 'projekt_id', 'haus_id', 'nummer', 'kaeufer_id'], 'integer'],
            [['besondere_regelungen_kaufvertrag', 'sonstige_anmerkungen'], 'safe'],
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
        $query = Datenblatt::find();

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
        ]);

        $query->andFilterWhere(['like', 'besondere_regelungen_kaufvertrag', $this->besondere_regelungen_kaufvertrag])
            ->andFilterWhere(['like', 'sonstige_anmerkungen', $this->sonstige_anmerkungen]);

        return $dataProvider;
    }
}
