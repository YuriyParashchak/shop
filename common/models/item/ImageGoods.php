<?php

namespace common\models\category;

use common\models\item\Goods;
use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property string $file
 * @property string $slug
 * @property int $goods_id
 * @property int $reverse
 *
 * @property Goods $goods
 */
class ImageGoods extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'ensureUnique' => true,
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file', 'slug', 'reverse'], 'required'],
            [['goods_id', 'reverse'], 'integer'],
            [['file', 'slug'], 'string', 'max' => 70],
            [['goods_id'], 'exist', 'skipOnError' => true, 'targetClass' => Goods::class, 'targetAttribute' => ['goods_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file' => 'File',
            'slug' => 'Slug',
            'goods_id' => 'Goods ID',
            'reverse' => 'Reverse',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasOne(Goods::class, ['id' => 'goods_id']);
    }
}
