<?php

namespace common\models\item;

use common\models\User;
use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "product_hit".
 *
 * @property int $id
 * @property int $event_type 1-view, 2-like
 * @property int $goods_id
 * @property int $user_id
 * @property string $ip_address
 * @property string $click_date
 *
 * @property Goods $goods
 * @property User $user
 */
class ProductHit extends \yii\db\ActiveRecord
{

    const TYPE_VIEW = 1;
    const TYPE_LIKE = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_hit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_type', 'goods_id', 'ip_address'], 'required'],
            [['event_type', 'goods_id', 'user_id'], 'integer'],
            [['click_date'], 'safe'],
            [['ip_address'], 'string', 'max' => 30],
            [['goods_id'], 'exist', 'skipOnError' => true, 'targetClass' => Goods::class, 'targetAttribute' => ['goods_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_type' => 'Event Type',
            'goods_id' => 'Goods ID',
            'user_id' => 'User ID',
            'ip_address' => 'Ip Address',
            'click_date' => 'Click Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasOne(Goods::class, ['id' => 'goods_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function beforeSave($insert)
    {
        $this->ip_address = Html::encode($this->ip_address);

        return parent::beforeSave($insert);
    }

    public static function createPostHit($user_id, int $goods_id, $type)
    {
        $view_event = new static();
        $view_event->event_type = $type;
        $view_event->user_id = $user_id;
        $view_event->goods_id = $goods_id;
        $view_event->ip_address = Yii::$app->request->userIP;

        return $view_event;
    }
}
