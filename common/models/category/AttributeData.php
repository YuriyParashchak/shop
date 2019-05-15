<?php

namespace common\models\category;

use backend\forms\category\AttributeDataForm;
use Yii;

/**
 * This is the model class for table "attribute_data".
 *
 * @property int $id
 * @property string $v_string
 * @property double $v_number
 * @property int $v_boolean
 * @property string $created_at
 *
 * @property AttributeValues[] $attributeValues
 * @property Attribute $attribute
 */
class AttributeData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attribute_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['v_number'], 'number'],
            [['v_boolean'], 'integer'],
            [['created_at'], 'safe'],
            [['v_string'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'v_string' => Yii::t('menu','String'),
            'v_number' => Yii::t('menu','Number'),
            'v_boolean' => Yii::t('menu','Boolean'),
            'created_at' => Yii::t('menu','Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeValues()
    {
        return $this->hasMany(AttributeValues::class, ['attribute_data_id' => 'id']);
    }

    public function getAttributeName()
    {
        return $this->hasOne(Attribute::class, ['id' => 'attribute_id'])->via('attributeValues');
    }

}
