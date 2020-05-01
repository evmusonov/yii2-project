<?php
namespace app\modules\article\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\article\models\Article;

use app\modules\article\Module;

/**
 * PartnersSearch represents the model behind the search form about `app\models\Partners`.
 */
class ArticleSearch extends Article
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['weight', 'status'], 'integer'],
            [['title', 'alias', 'date'], 'safe'],
			[['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d'],
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
        $query = Article::find()->orderBy('weight');
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
            'weight' => $this->weight,
            'status' => $this->status,
			'alias' => $this->alias,
        ]);
        $query->andFilterWhere(['like', 'title', $this->title])
			->andFilterWhere(['>=', 'date', $this->date_from ? strtotime($this->date_from . ' 00:00:00') : null])
            ->andFilterWhere(['<=', 'date', $this->date_to ? strtotime($this->date_to . ' 23:59:59') : null])
			->andFilterWhere(['like', 'alias', $this->alias]);
        return $dataProvider;
    }
}