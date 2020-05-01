<?php
namespace app\modules\shopcity\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * PartnersSearch represents the model behind the search form about `app\models\Partners`.
 */
class ShopCitySearch extends ShopCity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
        $query = ShopCity::find()->orderBy('weight');
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

        return $dataProvider;
    }
}