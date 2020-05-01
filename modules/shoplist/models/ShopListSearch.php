<?php
namespace app\modules\shoplist\models;

use app\modules\shopcity\models\ShopCity;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * PartnersSearch represents the model behind the search form about `app\models\Partners`.
 */
class ShopListSearch extends ShopList
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	['city_id', 'string'],
            [['weight', 'status'], 'integer'],
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
        $query = ShopList::find()->orderBy('weight');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'weight' => $this->weight,
            'status' => $this->status,
        ]);

	    $cities = ShopCity::find()->filterWhere(['like', 'title', $this->city_id . '%', false])->all();
        if ($cities) {
        	foreach ($cities as $city) {
		        $query->orWhere(['city_id' => $city->id]);
	        }
        }

        return $dataProvider;
    }
}