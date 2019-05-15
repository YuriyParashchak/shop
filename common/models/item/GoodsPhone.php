<?php

namespace common\models\item;

use common\models\item\Goods;
use common\models\user\UserPhone;
use Yii;

/**
 * This is the model class for table "goods_phone".
 *
 * @property int $id
 * @property int $goods_id
 * @property int $phone_id
 *
 * @property Goods $goods
 * @property UserPhone $phone
 */
class GoodsPhone extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'goods_phone';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['goods_id', 'phone_id'], 'required'],
            [['goods_id', 'phone_id'], 'integer'],
            [['goods_id'], 'exist', 'skipOnError' => true, 'targetClass' => Goods::class, 'targetAttribute' => ['goods_id' => 'id']],
            [['phone_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserPhone::class, 'targetAttribute' => ['phone_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_id' => 'Goods ID',
            'phone_id' => 'Phone ID',
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
    public function getPhone()
    {
        return $this->hasOne(UserPhone::class, ['id' => 'phone_id']);
    }
}
