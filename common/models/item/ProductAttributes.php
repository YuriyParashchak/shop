<?php

namespace common\models\item;

use Yii;

/**
 * This is the model class for table "product_attributes".
 *
 * @property int $id
 * @property int $goods_id
 * @property int $attribute_id
 * @property int $value_id
 *
 * @property Attribute $attribute0
 * @property Goods $goods
 * @property AttributeValues $value
 */
class ProductAttributes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_attributes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['goods_id', 'attribute_id', 'value_id'], 'required'],
            [['goods_id', 'attribute_id', 'value_id'], 'integer'],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attribute::className(), 'targetAttribute' => ['attribute_id' => 'id']],
            [['goods_id'], 'exist', 'skipOnError' => true, 'targetClass' => Goods::className(), 'targetAttribute' => ['goods_id' => 'id']],
            [['value_id'], 'exist', 'skipOnError' => true, 'targetClass' => AttributeValues::className(), 'targetAttribute' => ['value_id' => 'id']],
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
            'attribute_id' => 'Attribute ID',
            'value_id' => 'Value ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute0()
    {
        return $this->hasOne(Attribute::className(), ['id' => 'attribute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasOne(Goods::className(), ['id' => 'goods_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValue()
    {
        return $this->hasOne(AttributeValues::className(), ['id' => 'value_id']);
    }
}
