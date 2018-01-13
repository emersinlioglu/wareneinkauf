<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Datenblatt;
use yii\helpers\ArrayHelper;
use leandrogehlen\querybuilder\Translator;


/**
 * DatenblattSearch represents the model behind the search form about `app\models\Datenblatt`.
 */
class DatenblattSearch extends Datenblatt
{
    /**
     * @inheritdoc
     */
    public $haus;
    public $haus_strasse;
    public $haus_ort;
    public $haus_plz;
    public $haus_hausnr;
    public $kaeufer;
    public $kaeufer_titel;
    public $kaeufer_email;
    public $kaeufer_festnetz;
    public $kaeufer_handy;
    public $kaeufer_debitornr;
    public $kaeufer_nachname;
    public $kaeufer_vorname;
    public $kaeufer_titel2;
    public $kaeufer_nachname2;
    public $kaeufer_vorname2;
    public $projekt;
    public $projekt_name;
    public $firma;
    public $firma_name;
    public $firma_nr;
    public $te_nummer;

    public function rules()
    {
        return [
            [['id', 'firma_id', 'projekt_id', 'haus_id', 'nummer', 'kaeufer_id'], 'integer'],
            [['besondere_regelungen_kaufvertrag', 'sonstige_anmerkungen'], 'safe'],
            [['haus', 'haus_strasse', 'haus_plz', 'haus_ort', 'haus_hausnr', 'te_nummer'], 'safe'],
            [['kaeufer', 'kaeufer_debitornr',
                'kaeufer_titel', 'kaeufer_nachname', 'kaeufer_vorname', 'kaeufer_email', 'kaeufer_festnetz', 'kaeufer_handy',
                'kaeufer_titel2', 'kaeufer_nachname2', 'kaeufer_vorname2',
                'sap_debitor_nr', 'intern_debitor_nr'], 'safe'],
            [['projekt_name', 'firma_name', 'firma_nr'], 'safe'],
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
        $query->joinWith(['haus', 'kaeufer', 'kaeufer.anrede2', 'projekt', 'firma', 'haus.teileigentumseinheits']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10 // in case you want a default pagesize
            ]

        ]);

        if (in_array('all', $_GET)) {
            $dataProvider->pagination = false;
        }

        // toggle display all
        $toggleDataKey = '_tog' . hash('crc32', 'DatenblattSearch');
        $isShowAll = ArrayHelper::getValue($_GET, $toggleDataKey) === 'all';
        if ($isShowAll) {
            $dataProvider->pagination = false;
        }

        // filter by creator_user_id or projekt_user assignments
        if (!Yii::$app->user->isSuperadmin) {
            $query->leftJoin('projekt_user pu', 'pu.projekt_id = projekt.id');
            $query->andFilterWhere(['or',
                ['projekt.creator_user_id' => Yii::$app->user->identity->getId()],
                ['pu.user_id' => Yii::$app->user->identity->getId()],
                ['datenblatt.creator_user_id' => Yii::$app->user->identity->getId()],
            ]);
        }

        //$a = ArrayHelper::getValue($_GET, 'toolbar');
        //$b = ArrayHelper::getValue($_GET, 'tag');
        //error_log(print_r($_GET, 1));
        //error_log(print_r($_POST, 1));
        //return $dataProvider

        $dataProvider->sort->attributes['haus_strasse'] = [
            'asc' => ['haus.strasse' => SORT_ASC],
            'desc' => ['haus.strasse' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['haus_ort'] = [
            'asc' => ['haus.ort' => SORT_ASC],
            'desc' => ['haus.ort' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['haus_hausnr'] = [
            'asc' => ['haus.hausnr' => SORT_ASC],
            'desc' => ['haus.hausnr' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['haus_plz'] = [
            'asc' => ['haus.plz' => SORT_ASC],
            'desc' => ['haus.plz' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['kaeufer_email'] = [
            'asc' => ['kaeufer.email' => SORT_ASC],
            'desc' => ['kaeufer.email' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['kaeufer_festnetz'] = [
            'asc' => ['kaeufer.festnetz' => SORT_ASC],
            'desc' => ['kaeufer.festnetz' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['kaeufer_handy'] = [
            'asc' => ['kaeufer.handy' => SORT_ASC],
            'desc' => ['kaeufer.handy' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['kaeufer_titel'] = [
            'asc' => ['kaeufer.titel' => SORT_ASC],
            'desc' => ['kaeufer.titel' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['kaeufer_nachname'] = [
            'asc' => ['kaeufer.nachname' => SORT_ASC],
            'desc' => ['kaeufer.nachname' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['kaeufer_vorname'] = [
            'asc' => ['kaeufer.vorname' => SORT_ASC],
            'desc' => ['kaeufer.vorname' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['kaeufer_titel2'] = [
            'asc' => ['kaeufer.titel2' => SORT_ASC],
            'desc' => ['kaeufer.titel2' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['kaeufer_nachname2'] = [
            'asc' => ['kaeufer.nachname2' => SORT_ASC],
            'desc' => ['kaeufer.nachname2' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['kaeufer_vorname2'] = [
            'asc' => ['kaeufer.vorname2' => SORT_ASC],
            'desc' => ['kaeufer.vorname2' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['kaeufer_debitornr'] = [
            'asc' => ['kaeufer.debitor_nr' => SORT_ASC],
            'desc' => ['kaeufer.debitor_nr' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['projekt_name'] = [
            'asc' => ['projekt.name' => SORT_ASC],
            'desc' => ['projekt.name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['firma_name'] = [
            'asc' => ['firma.name' => SORT_ASC],
            'desc' => ['firma.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['firma_nr'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['firma.nr' => SORT_ASC],
            'desc' => ['firma.nr' => SORT_DESC],
        ];

        $teNummercolumn = 'min((te_nummer * 1))';
        $dataProvider->sort->attributes['te_nummer'] = [
            'asc' => [$teNummercolumn => SORT_ASC],
            'desc' => [$teNummercolumn => SORT_DESC],
        ];

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
            ->andFilterWhere(['like', 'sap_debitor_nr', $this->sap_debitor_nr])
            ->andFilterWhere(['like', 'intern_debitor_nr', $this->intern_debitor_nr])
            ->andFilterWhere(['like', 'haus.strasse', $this->haus_strasse])
            ->andFilterWhere(['like', 'haus.ort', $this->haus_ort])
            ->andFilterWhere(['like', 'haus.hausnr', $this->haus_hausnr])
            ->andFilterWhere(['like', 'haus.plz', $this->haus_plz])
            ->andFilterWhere(['like', 'kaeufer.debitor_nr', $this->kaeufer_debitornr])
            ->andFilterWhere(['like', 'kaeufer.email', $this->kaeufer_email])
            ->andFilterWhere(['like', 'kaeufer.festnetz', $this->kaeufer_festnetz])
            ->andFilterWhere(['like', 'kaeufer.handy', $this->kaeufer_handy])
            ->andFilterWhere(['like', 'kaeufer.nachname', $this->kaeufer_nachname])
            ->andFilterWhere(['like', 'kaeufer.vorname', $this->kaeufer_vorname])
            ->andFilterWhere(['like', 'kaeufer.titel', $this->kaeufer_titel])
            ->andFilterWhere(['like', 'kaeufer.titel2', $this->kaeufer_titel2])
            ->andFilterWhere(['like', 'kaeufer.nachname2', $this->kaeufer_nachname2])
            ->andFilterWhere(['like', 'kaeufer.vorname2', $this->kaeufer_vorname2])
            ->andFilterWhere(['like', 'projekt.name', $this->projekt_name])
            ->andFilterWhere(['like', 'firma.name', $this->firma_name])
            ->andFilterWhere(['like', 'firma.nr', $this->firma_nr])
            ->andFilterWhere(['like', 'sonstige_anmerkungen', $this->sonstige_anmerkungen])
            ->andFilterWhere(['like', 'te_nummer', $this->te_nummer]);

        $query->groupBy([
            'datenblatt.id'
        ]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchByQueryBuilder($rules, $projektName)
    {
        $query = Datenblatt::find();
        $query->joinWith(['haus', 'kaeufer', 'projekt', 'firma', 'haus.teileigentumseinheits']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10 // in case you want a default pagesize
            ]
        ]);

        $query->where(['projekt.name' => $projektName]);

        if ($rules) {
            $translator = new Translator($rules);
            $query->andWhere($translator->where())
                ->addParams($translator->params());
        }

//        // toggle display all
//        $toggleDataKey = '_tog' . hash('crc32', 'DatenblattSearch');
//        $isShowAll = ArrayHelper::getValue($_GET, $toggleDataKey) === 'all';
//        if ($isShowAll) {
//            $dataProvider->pagination = false;
//        }

//        // filter by creator_user_id or projekt_user assignments
//        if (!Yii::$app->user->isSuperadmin) {
//            $query->leftJoin('projekt_user pu', 'pu.projekt_id = projekt.id');
//            $query->andFilterWhere(['or',
//                ['projekt.creator_user_id' => Yii::$app->user->identity->getId()],
//                ['pu.user_id' => Yii::$app->user->identity->getId()],
//                ['datenblatt.creator_user_id' => Yii::$app->user->identity->getId()],
//            ]);
//        }

        //$a = ArrayHelper::getValue($_GET, 'toolbar');
        //$b = ArrayHelper::getValue($_GET, 'tag');
        //error_log(print_r($_GET, 1));
        //error_log(print_r($_POST, 1));
        //return $dataProvider

        $dataProvider->sort->attributes['haus_strasse'] = [
            'asc' => ['haus.strasse' => SORT_ASC],
            'desc' => ['haus.strasse' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['haus_ort'] = [
            'asc' => ['haus.ort' => SORT_ASC],
            'desc' => ['haus.ort' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['haus_hausnr'] = [
            'asc' => ['haus.hausnr' => SORT_ASC],
            'desc' => ['haus.hausnr' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['haus_plz'] = [
            'asc' => ['haus.plz' => SORT_ASC],
            'desc' => ['haus.plz' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['kaeufer_email'] = [
            'asc' => ['kaeufer.email' => SORT_ASC],
            'desc' => ['kaeufer.email' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['kaeufer_festnetz'] = [
            'asc' => ['kaeufer.festnetz' => SORT_ASC],
            'desc' => ['kaeufer.festnetz' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['kaeufer_handy'] = [
            'asc' => ['kaeufer.handy' => SORT_ASC],
            'desc' => ['kaeufer.handy' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['kaeufer_nachname'] = [
            'asc' => ['kaeufer.nachname' => SORT_ASC],
            'desc' => ['kaeufer.nachname' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['kaeufer_vorname'] = [
            'asc' => ['kaeufer.vorname' => SORT_ASC],
            'desc' => ['kaeufer.vorname' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['kaeufer_nachname2'] = [
            'asc' => ['kaeufer.nachname2' => SORT_ASC],
            'desc' => ['kaeufer.nachname2' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['kaeufer_vorname2'] = [
            'asc' => ['kaeufer.vorname2' => SORT_ASC],
            'desc' => ['kaeufer.vorname2' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['kaeufer_debitornr'] = [
            'asc' => ['kaeufer.debitor_nr' => SORT_ASC],
            'desc' => ['kaeufer.debitor_nr' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['projekt_name'] = [
            'asc' => ['projekt.name' => SORT_ASC],
            'desc' => ['projekt.name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['firma_name'] = [
            'asc' => ['firma.name' => SORT_ASC],
            'desc' => ['firma.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['firma_nr'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['firma.nr' => SORT_ASC],
            'desc' => ['firma.nr' => SORT_DESC],
        ];

        $teNummercolumn = 'min((te_nummer * 1))';
        $dataProvider->sort->attributes['te_nummer'] = [
            'asc' => [$teNummercolumn => SORT_ASC],
            'desc' => [$teNummercolumn => SORT_DESC],
        ];

        $query->groupBy([
            'datenblatt.id'
        ]);

        return $dataProvider;
    }
}
