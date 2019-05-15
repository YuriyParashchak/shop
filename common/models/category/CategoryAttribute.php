<?php

namespace common\models\category;

use Yii;

/**
 * This is the model class for table "category_attribute".
 *
 * @property int $category_id
 * @property int $attribute_id
 *
 * @property Category $category
 * @property Attribute $attribute0
 */
class CategoryAttribute extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_attribute';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'attribute_id'], 'required'],
            [['category_id', 'attribute_id'], 'integer'],
            [['category_id', 'attribute_id'], 'unique', 'targetAttribute' => ['category_id', 'attribute_id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attribute::class, 'targetAttribute' => ['attribute_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'attribute_id' => 'Attribute ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute0()
    {
        return $this->hasOne(Attribute::class, ['id' => 'attribute_id']);
    }

    public static function create(int $attrId, int $categoryId)
    {
        $model = new static();
        $model->attribute_id = $attrId;
        $model->category_id = $categoryId;

        return $model;
    }
}
