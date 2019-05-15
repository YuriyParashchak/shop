<?php

namespace frontend\forms;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\item\Goods;

/**
 * ProductSearch represents the model behind the search form of `common\models\item\Goods`.
 */
class ProductSearch extends Goods
{
    public $search_category_id;

    public $order_price ='up';
    public $order_date ='up';

    public $price_min;
    public $price_max;

    public $cat_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['title','created', 'order_price', 'order_date','cat_id'], 'safe'],
            [['price'], 'number'],
            [['price_min','price_max'], 'integer'],
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
        $query = Goods::find()->where(['status' => Goods::STATUS_AVAILABLE]);

        if($this->search_category_id)
            $query->andWhere(['category_id'=> $this->search_category_id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 14,
            ],
        ]);

        $this->load($params,'');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->orderBy(['price' =>  $this->order_price == 'up' ? SORT_ASC: SORT_DESC ]);
        $query->addOrderBy(['created' =>  $this->order_date == 'up' ? SORT_ASC: SORT_DESC ]);
     //   $query->andFilterWhere(['like', 'price', $this->price])->orderBy(['id' => SORT_DESC]);
        if(!empty($this->cat_id))
        {
            $query->andWhere(['category_id'=> $this->cat_id]);
        }

        if(!empty($this->price_max)||!empty($this->price_min))
        {
                if(empty($this->price_max))
                    $query->andFilterWhere(['>', 'price',$this->price_min]);
                else if(empty($this->price_min))
                    $query->andFilterWhere(['<', 'price',$this->price_max]);
                else
                    $query->andFilterWhere(['between', 'price',$this->price_min, $this->price_max]);
        }

        return $dataProvider;
    }

    public function categories()
    {
        $query = Goods::find()->where(['status' => Goods::STATUS_AVAILABLE]);

        $query->andFilterWhere(['like', 'title', $this->title]);


        if(!empty($this->price_max)||!empty($this->price_min))
        {
            if(empty($this->price_max))
                $query->andFilterWhere(['>', 'price',$this->price_min]);
            else if(empty($this->price_min))
                $query->andFilterWhere(['<', 'price',$this->price_max]);
            else
                $query->andFilterWhere(['between', 'price',$this->price_min, $this->price_max]);
        }

        $res =  $query->select('category_id')->distinct()->asArray()->all();
        $arrID = [];

        foreach ($res as $r)
            $arrID[] = intval($r['category_id']);

        return $arrID;

    }


    /**
        Swaps query parameter for sort direction
     * @return array
     */
    public function getPriceOrderUrl()
    {
        $res = Yii::$app->request->queryParams;
        //  $res[0] = 'product-search';
        $res[0]='product/category';
        $res['order_price'] = $this->order_price == 'up'? 'down': 'up';
        return $res;
    }

    /**
        Swaps query parameter for sort direction
     * @return array
     */
    public function getDateOrderUrl()
    {
        $res = Yii::$app->request->queryParams;
      //  $res[0] = 'product-search';
        $res[0]='product/category';
        $res['order_date'] = $this->order_date == 'up'? 'down': 'up';
        return $res;
    }
}