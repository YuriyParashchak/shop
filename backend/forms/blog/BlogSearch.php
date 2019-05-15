<?php

namespace backend\forms\blog;

use DateTime;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Blog;

/**
 * BlogSearch represents the model behind the search form of `common\models\Blog`.
 */
class BlogSearch extends Blog
{
    public $data;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'views_count'], 'integer'],
            [['name', 'url', 'text', 'data'], 'safe'],
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
        $query = Blog::find();

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
            'status' => $this->status,
           // 'data' => $this->data,
            'views_count' => $this->views_count,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'text', $this->text]);

       if(!empty($this->data))
        {
            try {
                $startDt = new DateTime($this->data);
                $startDt->setTime(0,0,0);

                $endDt = new DateTime();
                $endDt->setTimestamp($startDt->getTimestamp());
                $endDt->setTime(23,59, 59);

               $query->andFilterWhere(['between', 'data', $startDt->format('Y-m-d H:i:s'),$endDt->format('Y-m-d H:i:s') ]);
            }
            catch (\Exception $e){

            }
        }


        return $dataProvider;
    }
}