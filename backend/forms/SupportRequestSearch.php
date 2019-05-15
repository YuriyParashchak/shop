<?php

namespace backend\forms;

use DateTime;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SupportRequest;

/**
 * SupportRequestSearch represents the model behind the search form of `common\models\SupportRequest`.
 */
class SupportRequestSearch extends SupportRequest
{
    public $date_message;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'subject_id','status'], 'integer'],
            [['name', 'email', 'body','date_message'], 'safe'],
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
        $query = SupportRequest::find();

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
            'subject_id' => $this->subject_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
           // ->andFilterWhere(['like', 'date_message', $this->date_message])
            ->andFilterWhere(['like', 'body', $this->body]);

        if(!empty($this->date_message))
        {
            try {
                $startDt = new DateTime($this->date_message);
                $startDt->setTime(0,0,0);

                $endDt = new DateTime();
                $endDt->setTimestamp($startDt->getTimestamp());
                $endDt->setTime(23,59, 59);
                $query->andFilterWhere(['between', 'date_message', $startDt->format('Y-m-d H:i:s'),$endDt->format('Y-m-d H:i:s') ]);
            }
            catch (\Exception $e){

            }
        }


        return $dataProvider;
    }
}
