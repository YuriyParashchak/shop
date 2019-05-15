<?php

namespace common\models\item;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property int $id
 * @property string $title
 * @property string $name
 * @property string $classes
 *
 * @property Goods[] $goods
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'name'], 'required'],
            [['title'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 40],
            [['classes'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'name' => 'Name',
            'classes' => 'Classes',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasMany(Goods::class, ['currency_id' => 'id']);
    }
}
