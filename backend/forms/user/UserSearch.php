<?php

namespace backend\forms\user;

use DateTime;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use common\models\User;
use kartik\daterange\DateRangeBehavior;


/**
 * UserSearch represents the model behind the search form of `common\models\User`.
 */
class UserSearch extends User
{

    public $user_reg_date ='';
    public $date_from;
    public $date_to;
    /**
     * {@inheritdoc}
     */


    public function rules()
    {
        return [
            [['id', 'status', 'created_at'], 'integer'],
            [['url_name', 'email', 'user_reg_date'], 'safe'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d'],
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
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

       // $startDt = new DateTime($this->user_reg_date);
       // var_dump($startDt->format('d.m.Y H:i:s'));

        //$endDt = new DateTime($startDt->getTimestamp());
       // $endDt->setTime(23, 59, 59);



        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
//            'created_at' => $this->created_at
        ]);

        $query->andFilterWhere(['like', 'url_name', $this->url_name])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['>=', 'created_at', $this->date_from ? strtotime($this->date_from . ' 00:00:00') : null])
           ->andFilterWhere(['<=', 'created_at', $this->date_to ? strtotime($this->date_to . ' 23:59:59') : null]);

        return $dataProvider;
    }
}
