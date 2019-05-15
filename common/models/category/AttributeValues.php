<?php

namespace common\models\category;

use Yii;

/**
 * This is the model class for table "attribute_values".
 *
 * @property int $id
 * @property int $attribute_data_id
 * @property int $attribute_id
 *
 * @property Attribute $attribute0
 * @property AttributeData $attributeData
 */
class AttributeValues extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attribute_values';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attribute_data_id', 'attribute_id'], 'required'],
            [['attribute_data_id', 'attribute_id'], 'integer'],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attribute::class, 'targetAttribute' => ['attribute_id' => 'id']],
            [['attribute_data_id'], 'exist', 'skipOnError' => true, 'targetClass' => AttributeData::class, 'targetAttribute' => ['attribute_data_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attribute_data_id' => 'Attribute Data ID',
            'attribute_id' => 'Attribute ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute0()
    {
        return $this->hasOne(Attribute::class, ['id' => 'attribute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeData()
    {
        return $this->hasOne(AttributeData::class, ['id' => 'attribute_data_id']);
    }

    public static function create(int $attributeId, int $attributeDataId)
    {
        $attributeValue = new static();
        $attributeValue->attribute_id = $attributeId;
        $attributeValue->attribute_data_id = $attributeDataId;

        return $attributeValue;
    }
}
