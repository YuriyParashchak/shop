<?php

namespace backend\forms;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\item\Goods;

/**
 * SearchGoods represents the model behind the search form of `common\models\item\Goods`.
 */
class SearchGoods extends Goods
{
    public $category;
    public $categoryTitle;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'category_id', 'status', 'type', 'currency_id', 'views', 'likes'], 'integer'],
            [['categoryTitle', 'title', 'slug', 'description', 'img', 'created'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Goods::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'created' => $this->created,
            'status' => $this->status,
            'type' => $this->type,
            'currency_id' => $this->currency_id,
            'views' => $this->views,
            'likes' => $this->likes,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'img', $this->img])
            ->joinWith('category')
            ->andFilterWhere(['like', 'categories.title', $this->categoryTitle]);


        return $dataProvider;
    }
}
