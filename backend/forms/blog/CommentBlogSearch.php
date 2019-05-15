<?php

namespace backend\forms\blog;

use common\models\Blog;
use DateTime;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CommentBlog;
use yii\helpers\ArrayHelper;

/**
 * CommentBlogSearch represents the model behind the search form of `common\models\CommentBlog`.
 */
class CommentBlogSearch extends CommentBlog
{
    public $date;
    public $article;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status'], 'integer'],
            [['text', 'date','article'], 'safe'],
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
        $query = CommentBlog::find();

        //$query2=Blog::find();
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

        if($this->article)
        {
          //  $foundID = Blog::find()->where(['like', 'name', $this->article])->select('id')->all();
            $resIDS = (new \yii\db\Query())->select('id')->from('blog')->where(['like', 'name', $this->article])->all();
//            var_dump($resIDS); exit;
            $ids = ArrayHelper::getColumn($resIDS, 'id');
           // var_dump( $ids); exit;
            $query->andFilterWhere(['IN', 'article_id',  $ids]);

        }


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'article_id' => $this->article_id,
            'status' => $this->status,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text]);



        if(!empty($this->date))
        {
            try {
                $startDt = new DateTime($this->date);
                $startDt->setTime(0,0,0);

                $endDt = new DateTime();
                $endDt->setTimestamp($startDt->getTimestamp());
                $endDt->setTime(23,59, 59);

                $query->andFilterWhere(['between', 'date', $startDt->format('Y-m-d H:i:s'),$endDt->format('Y-m-d H:i:s') ]);
            }
            catch (\Exception $e){

            }
        }

        return $dataProvider;
    }
}
