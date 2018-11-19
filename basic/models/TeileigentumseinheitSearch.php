<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Teileigentumseinheit;

/**
 * TeileigentumseinheitSearch represents the model behind the search form about `app\models\Teileigentumseinheit`.
 */
class TeileigentumseinheitSearch extends Teileigentumseinheit
{
    public $firma_name;
    public $firma_nr;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'haus_id', 'einheitstyp_id', 'gefoerdert', 'projekt_id'], 'integer'],
            [['projekt_id', 'rechnung_vertrieb', 'zaehler_abgemeldet', 'status', 'firma_name', 'firma_nr', 'hausnr', 'te_nummer', 'geschoss', 'zimmer', 'me_anteil', 'wohnflaeche', 'gefoerdert', 'verkaufspreis_begruendung'], 'safe'],
            [['kaufpreis', 'kp_einheit', 'forecast_preis', 'verkaufspreis'], 'number'],
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
        $query = Teileigentumseinheit::find();
        $query->joinWith(['projekt', 'projekt.firma', 'haus']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $dataProvider->sort->attributes['firma_name'] = [
            'asc' => ['firma.name' => SORT_ASC],
            'desc' => ['firma.name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['firma_nr'] = [
            'asc' => ['firma.nr' => SORT_ASC],
            'desc' => ['firma.nr' => SORT_DESC],
        ];
        $activeProjekt = User::getActiveProjekt();

        $query->andFilterWhere([
            'id' => $this->id,
            'haus_id' => $this->haus_id,
            'einheitstyp_id' => $this->einheitstyp_id,
            'gefoerdert' => $this->gefoerdert,
            'kaufpreis' => $this->kaufpreis,
            'kp_einheit' => $this->kp_einheit,
//            'cast(me_anteil as decimal(11,2))' => str_replace(',', '.', $this->me_anteil),
            'teileigentumseinheit.status' => $this->status,
            'teileigentumseinheit.rechnung_vertrieb' => $this->rechnung_vertrieb,
            'teileigentumseinheit.zaehler_abgemeldet' => $this->zaehler_abgemeldet,
            'teileigentumseinheit.projekt_id' => $activeProjekt ? $activeProjekt->id : 0,
        ]);

        $query
            ->andFilterWhere(['like', 'firma.name', $this->firma_name])
            ->andFilterWhere(['like', 'firma.nr', $this->firma_nr])
            ->andFilterWhere(['like', 'hausnr', $this->hausnr])
            ->andFilterWhere(['like', 'te_nummer', $this->te_nummer])
            ->andFilterWhere(['like', 'geschoss', $this->geschoss])
            ->andFilterWhere(['like', 'zimmer', $this->zimmer])
            ->andFilterWhere(['like', 'cast(me_anteil as decimal(11,2))', str_replace(',', '.', $this->me_anteil)])
            ->andFilterWhere(['like', 'verkaufspreis_begruendung', $this->verkaufspreis_begruendung])
            ->andFilterWhere(['like', 'wohnflaeche', $this->wohnflaeche]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchForecast($params)
    {
        $query = Teileigentumseinheit::find();
        $query->joinWith(['haus', 'haus.projekt']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // filter by creator_user_id or projekt_user assignments
        if (!Yii::$app->user->isSuperadmin) {
            $query->leftJoin('projekt_user pu', 'pu.projekt_id = projekt.id');
            $query->andFilterWhere(['or',
                ['projekt.creator_user_id' => Yii::$app->user->identity->getId()],
                ['pu.user_id' => Yii::$app->user->identity->getId()]
            ]);
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'haus_id' => $this->haus_id,
            'einheitstyp_id' => $this->einheitstyp_id,
            'gefoerdert' => $this->gefoerdert,
            'kaufpreis' => $this->kaufpreis,
            'kp_einheit' => $this->kp_einheit,
            'forecast_preis' => $this->forecast_preis,
            'verkaufspreis' => $this->verkaufspreis,
        ]);

        $query->andWhere('forecast_preis <> verkaufspreis');

        $query
            ->andFilterWhere(['like', 'hausnr', $this->hausnr])
            ->andFilterWhere(['like', 'te_nummer', $this->te_nummer])
            ->andFilterWhere(['like', 'geschoss', $this->geschoss])
            ->andFilterWhere(['like', 'zimmer', $this->zimmer])
            ->andFilterWhere(['like', 'me_anteil', $this->me_anteil])
            ->andFilterWhere(['like', 'verkaufspreis_begruendung', $this->verkaufspreis_begruendung])
            ->andFilterWhere(['like', 'wohnflaeche', $this->wohnflaeche]);

        return $dataProvider;
    }
}
