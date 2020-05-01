<?php

namespace app\modules\minislider\models;

use app\modules\minislider\models\MiniSlider;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PartnersSearch represents the model behind the search form about `app\models\Partners`.
 */
class MiniSliderSearch extends MiniSlider
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'weight', 'status'], 'integer'],
            [['title'], 'safe'],
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
        $query = MiniSlider::find()->orderBy('weight');

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
            'weight' => $this->weight,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
