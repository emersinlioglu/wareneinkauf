<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Projekt;

/**
 * ProjektSearch represents the model behind the search form about `app\models\Projekt`.
 */
class ProjektSearch extends Projekt
{
    /**
     * @inheritdoc
     */
public $firma;
public $firma_name;
public $firma_nr;   

    public function rules()
    {
        return [
            [['id', 'firma_id'], 'integer'],
            [['name'], 'safe'],
            [['firma', 'firma_name','firma_nr', 'strasse', 'hausnr', 'plz', 'ort', 'mail_header', 'mail_footer'], 'safe'],
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
        $query = Projekt::find();

        $query->joinWith(['firma']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['firma_name'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['firma.name' => SORT_ASC],
            'desc' => ['firma.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['firma_nr'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['firma.nr' => SORT_ASC],
            'desc' => ['firma.nr' => SORT_DESC],
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
        ]);

        // filter by creator_user_id or projekt_user assignments
        if (!Yii::$app->user->isSuperadmin) {
            $query->leftJoin('projekt_user pu', 'pu.projekt_id = projekt.id');
            $query->andFilterWhere(['or',
                ['projekt.creator_user_id' => Yii::$app->user->identity->getId()],
                ['pu.user_id' => Yii::$app->user->identity->getId()]
            ]);
        }

        $query
            ->andFilterWhere(['like', 'projekt.strasse', $this->strasse])
            ->andFilterWhere(['like', 'projekt.hausnr', $this->hausnr])
            ->andFilterWhere(['like', 'projekt.plz', $this->plz])
            ->andFilterWhere(['like', 'projekt.ort', $this->ort])
            ->andFilterWhere(['like', 'projekt.name', $this->name])
            ->andFilterWhere(['like', 'firma.name', $this->firma_name])
            ->andFilterWhere(['like', 'firma.nr', $this->firma_nr])
            ->andFilterWhere(['like', 'projekt.mail_header', $this->mail_header])
            ->andFilterWhere(['like', 'projekt.mail_footer', $this->mail_footer])
        ;

        return $dataProvider;
    }

    /**
     * @return array
     */
    public static function getAllProjectsInfo($userId = null, $projektId = null) {

        $sql = "
            select 
                p.id as projektId,
                p.name,
                (select SUM(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id where h.projekt_id = p.id) 
                as wohnflaechensumme,
                (select SUM(te.kaufpreis) / SUM(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id where h.projekt_id = p.id)  
                as durchschnittlicherPreisProQuadradmeter,
                (select SUM(te.kaufpreis) from teileigentumseinheit te left join haus h on te.haus_id = h.id where h.projekt_id = p.id) 
                as verkuafspreissumme,
                (select count(*) from teileigentumseinheit te left join haus h on te.haus_id = h.id where h.projekt_id = p.id and te.einheitstyp_id = 1) 
                as einheitenGesamt,
                -- (select count(*) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status = 'verkuaft' where h.projekt_id = p.id) as einheitenVerkauft,
                
                (select SUM(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id where h.projekt_id = p.id and h.status = 'frei') 
                as wohnflaechensummeFrei,
                (select count(*) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status = 'frei' where h.projekt_id = p.id and te.einheitstyp_id = 1) 
                as einheitenFreiStück,
                (
                    (
                        (select SUM(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status = 'frei' where h.projekt_id = p.id)
                        /
                        (select SUM(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id where h.projekt_id = p.id)
                    )
                    * 100
                ) 
                as einheitenFreiProzent,
                (select SUM(te.kaufpreis) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status = 'frei' where h.projekt_id = p.id) 
                as einheitenFreiPreisSumme,
                
                (select SUM(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id where h.projekt_id = p.id and h.status = 'reserviert') 
                as wohnflaechensummeReserviert,
                (select count(*) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status = 'reserviert' where h.projekt_id = p.id) 
                as einheitenReserviertStück,
                (
                  (
                    (select SUM(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status = 'reserviert' where h.projekt_id = p.id)
                    /
                    (select SUM(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id where h.projekt_id = p.id)
                  )
                  * 100
                ) as einheitenReserviertProzent,
                (select SUM(te.kaufpreis) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status = 'reserviert' where h.projekt_id = p.id) 
                as einheitenReserviertPreisSumme,
                
                (select SUM(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id where h.projekt_id = p.id and h.status in ('reserviert','verkauft')) 
                as wohnflaechensummeVerkauft,
                (select count(*) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status in ('reserviert','verkauft') where h.projekt_id = p.id and te.einheitstyp_id = 1) 
                as einheitenVerkauftStück,
                (
                  (
                    (select SUM(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status in ('reserviert','verkauft') where h.projekt_id = p.id)
                    /
                    (select SUM(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id where h.projekt_id = p.id)
                  )
                  * 100
                ) as einheitenVerkauftProzent,
                (select SUM(te.kaufpreis) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status in ('reserviert','verkauft') where h.projekt_id = p.id) 
                as einheitenVerkauftPreisSumme,
                
                (
                  (
                      (select SUM(te.kaufpreis) from teileigentumseinheit te left join haus h on te.haus_id = h.id where h.status in ('reserviert','verkauft') and h.projekt_id = p.id) 
                      /
                      (select SUM(te.kaufpreis) from teileigentumseinheit te left join haus h on te.haus_id = h.id where h.projekt_id = p.id)
                  ) * 100
                ) as betragInProzentAngefordert,
                (
                  select SUM(te.kaufpreis) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status in ('reserviert','verkauft') where h.projekt_id = p.id
                ) as betragInEuroAngefordert

            from projekt p
            where
            1
        ";

        if (!is_null($userId)) {
            $sql .= sprintf(
                'and p.id in (select pu.projekt_id from projekt_user pu where pu.user_id = %s)',
                $userId
            );
        }

        if (!is_null($projektId)) {
            $sql .= sprintf(
                'and p.id = %s',
                $projektId
            );
        }

        $rows = Yii::$app->getDb()->createCommand($sql)->queryAll();

        return $rows;
    }

    /**
     * @return array
     */
    public static function getInfoForEinheitstyp($projektId = null, $einheitstypId = null) {

        $einheitstyp = Einheitstyp::findOne(['id' => $einheitstypId]);
        $calculate = $einheitstyp->einheit == 'm2' ? 'SUM' : 'COUNT';

        $sql = "
            select 
            
                (
                    select $calculate(te.wohnflaeche) from teileigentumseinheit te 
                    left join haus h on te.haus_id = h.id 
                    where te.gefoerdert = 0 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId
                ) 
                as wohnflaechensumme,
                (
                    select $calculate(te.wohnflaeche) from teileigentumseinheit te 
                    left join haus h on te.haus_id = h.id 
                    where te.gefoerdert = 1 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId
                ) 
                as wohnflaechensummeGefoerdert,
                
                (select SUM(te.kaufpreis) / $calculate(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id where te.gefoerdert = 0 and  h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId)  
                as durchschnittlicherPreisProQuadradmeter,
                (select SUM(te.kaufpreis) / $calculate(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id where te.gefoerdert = 1 and  h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId)  
                as durchschnittlicherPreisProQuadradmeterGefoerdert,
                (select SUM(te.kaufpreis) from teileigentumseinheit te left join haus h on te.haus_id = h.id where te.gefoerdert = 0 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId) 
                as verkuafspreissumme,
                (select SUM(te.kaufpreis) from teileigentumseinheit te left join haus h on te.haus_id = h.id where te.gefoerdert = 1 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId) 
                as verkuafspreissummeGefoerdert,
                (select count(*) from teileigentumseinheit te left join haus h on te.haus_id = h.id where te.gefoerdert = 0 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId) 
                as einheitenGesamt,
                (select count(*) from teileigentumseinheit te left join haus h on te.haus_id = h.id where te.gefoerdert = 1 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId) 
                as einheitenGesamtGefoerdert,
                -- (select count(*) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status = 'verkuaft' where h.projekt_id = p.id) as einheitenVerkauft,
                
                (select $calculate(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id where te.gefoerdert = 0 and h.projekt_id = p.id and h.status = 'frei' and te.einheitstyp_id = $einheitstypId) 
                as wohnflaechensummeFrei,
                (select $calculate(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id where te.gefoerdert = 1 and h.projekt_id = p.id and h.status = 'frei' and te.einheitstyp_id = $einheitstypId) 
                as wohnflaechensummeFreiGefoerdert,
                (select count(*) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status = 'frei' where te.gefoerdert = 0 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId) 
                as einheitenFreiStück,
                (select count(*) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status = 'frei' where te.gefoerdert = 1 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId) 
                as einheitenFreiStückGefoerdert,
                (
                    (
                        (select SUM(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status = 'frei' where te.gefoerdert = 0 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId)
                        /
                        (select SUM(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id where te.gefoerdert = 0 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId)
                    )
                    * 100
                ) 
                as einheitenFreiProzent,
                (
                    (
                        (select SUM(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status = 'frei' where te.gefoerdert = 1 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId)
                        /
                        (select SUM(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id where te.gefoerdert = 1 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId)
                    )
                    * 100
                ) 
                as einheitenFreiProzentGefoerdert,
                (select SUM(te.kaufpreis) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status = 'frei' where te.gefoerdert = 0 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId) 
                as einheitenFreiPreisSumme,
                (select SUM(te.kaufpreis) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status = 'frei' where te.gefoerdert = 0 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId) 
                as einheitenFreiPreisSummeGefoerdert,
                
                (select $calculate(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id where te.gefoerdert = 0 and h.projekt_id = p.id and h.status = 'reserviert' and te.einheitstyp_id = $einheitstypId) 
                as wohnflaechensummeReserviert,
                (select $calculate(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id where te.gefoerdert = 1 and h.projekt_id = p.id and h.status = 'reserviert' and te.einheitstyp_id = $einheitstypId) 
                as wohnflaechensummeReserviertGefoerdert,
                (select count(*) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status = 'reserviert' where te.gefoerdert = 0 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId) 
                as einheitenReserviertStück,
                (select count(*) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status = 'reserviert' where te.gefoerdert = 1 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId) 
                as einheitenReserviertStückGefoerdert,
                (
                  (
                    (select SUM(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status = 'reserviert' where te.gefoerdert = 0 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId)
                    /
                    (select SUM(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id where te.gefoerdert = 0 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId)
                  )
                  * 100
                ) as einheitenReserviertProzent,
                (
                  (
                    (select SUM(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status = 'reserviert' where te.gefoerdert = 1 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId)
                    /
                    (select SUM(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id where te.gefoerdert = 1 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId)
                  )
                  * 100
                ) as einheitenReserviertProzentGefoerdert,
                (select SUM(te.kaufpreis) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status = 'reserviert' where te.gefoerdert = 0 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId) 
                as einheitenReserviertPreisSumme,
                (select SUM(te.kaufpreis) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status = 'reserviert' where te.gefoerdert = 1 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId) 
                as einheitenReserviertPreisSummeGefoerdert,
                
                (select $calculate(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id where te.gefoerdert = 0 and h.projekt_id = p.id and h.status in ('reserviert','verkauft') and te.einheitstyp_id = $einheitstypId) 
                as wohnflaechensummeVerkauft,
                (select $calculate(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id where te.gefoerdert = 1 and h.projekt_id = p.id and h.status in ('reserviert','verkauft') and te.einheitstyp_id = $einheitstypId) 
                as wohnflaechensummeVerkauftGefoerdert,
                (select count(*) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status in ('reserviert','verkauft') where te.gefoerdert = 0 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId) 
                as einheitenVerkauftStück,
                (select count(*) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status in ('reserviert','verkauft') where te.gefoerdert = 1 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId) 
                as einheitenVerkauftStückGefoerdert,
                (
                  (
                    (select $calculate(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status in ('reserviert','verkauft') where te.gefoerdert = 0 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId)
                    /
                    (select $calculate(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id where te.gefoerdert = 0 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId)
                  )
                  * 100
                ) as einheitenVerkauftProzent,
                (
                  (
                    (select $calculate(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status in ('reserviert','verkauft') where te.gefoerdert = 1 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId)
                    /
                    (select $calculate(te.wohnflaeche) from teileigentumseinheit te left join haus h on te.haus_id = h.id where te.gefoerdert = 1 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId)
                  )
                  * 100
                ) as einheitenVerkauftProzentGefoerdert,
                (select SUM(te.kaufpreis) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status in ('reserviert','verkauft') where te.gefoerdert = 0 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId) 
                as einheitenVerkauftPreisSumme,
                (select SUM(te.kaufpreis) from teileigentumseinheit te left join haus h on te.haus_id = h.id and h.status in ('reserviert','verkauft') where te.gefoerdert = 1 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId) 
                as einheitenVerkauftPreisSummeGefoerdert,
                
                (
                
                    (
                        select SUM(te.kaufpreis) from teileigentumseinheit te left join haus h on te.haus_id = h.id where h.status in ('reserviert','verkauft') and te.gefoerdert = 0 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId
                    )
                    * 100
                    / (select SUM(te.kaufpreis) from teileigentumseinheit te left join haus h on te.haus_id = h.id where te.gefoerdert = 0 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId)
                  
                ) as betragInProzentAngefordert,
                (
                
                    (
                        select SUM(te.kaufpreis) from teileigentumseinheit te left join haus h on te.haus_id = h.id where h.status in ('reserviert','verkauft') and te.gefoerdert = 1 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId
                    )
                    * 100
                    / (select SUM(te.kaufpreis) from teileigentumseinheit te left join haus h on te.haus_id = h.id where te.gefoerdert = 1 and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId)
                    
                ) as betragInProzentAngefordertGefoerdert,
                
                
                (
                    select SUM(te.kaufpreis) from teileigentumseinheit te left join haus h on te.haus_id = h.id where te.gefoerdert = 0 and h.status in ('reserviert','verkauft') and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId
                ) as betragInEuroAngefordert,
                (
                    select SUM(te.kaufpreis) from teileigentumseinheit te left join haus h on te.haus_id = h.id where te.gefoerdert = 1 and h.status in ('reserviert','verkauft') and h.projekt_id = p.id and te.einheitstyp_id = $einheitstypId
                ) as betragInEuroAngefordertGefoerdert

            from projekt p
            where
            1
        ";

        if (!is_null($projektId)) {
            $sql .= sprintf(
                'and p.id = %s',
                $projektId
            );
        }

//        if (!is_null($projektId)) {
//            $sql .= sprintf(
//                'and p.id = %s',
//                $projektId
//            );
//        }
//
//        echo $sql;
//        die;
        $rows = Yii::$app->getDb()->createCommand($sql)->queryOne();

        return $rows;
    }

}
