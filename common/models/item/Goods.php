<?php

namespace common\models\item;

use common\models\category\Category;
use common\models\category\ImageGoods;
use common\models\User;
use common\models\user\UserPhone;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\helpers\Json;

/**
 * This is the model class for table "goods".
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $img
 * @property double $price
 * @property \DateTime $created
 * @property int $status
 * @property int $type
 * @property int $currency_id
 * @property int $views
 * @property int $likes
 *
 * @property Category $category
 * @property Currency $currency
 * @property User $user
 * @property GoodsPhone[] $goodsPhones
 * @property ImageGoods[] $images
 * @property UserPhone[] $phones
 * @property Preference[] $preferences
 */
class Goods extends \yii\db\ActiveRecord
{
    const STATUS_WAIT = 1;
    const STATUS_AVAILABLE = 2;
    const STATUS_UNAVAILABLE = 3;
    const STATUS_SOLD = 8;
    const STATUS_BUN = 10;

    const TYPE_USER = 1;
    const TYPE_SHOP = 2;

    public static function getStatuses()
    {
        return [
            self::STATUS_WAIT => Yii::t('menu', 'Wait'),
            self::STATUS_AVAILABLE => Yii::t('menu', 'Available'),
            self::STATUS_UNAVAILABLE => Yii::t('menu', 'Unavailable'),
            self::STATUS_SOLD => Yii::t('menu', 'Sold'),
            self::STATUS_BUN => Yii::t('menu', 'Bun'),
            ];
    }

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
        return 'goods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'currency_id', 'category_id', 'title', 'slug', 'description', 'price'], 'required'],
            [['user_id', 'category_id', 'currency_id'], 'integer'],
            [['description'], 'string'],
            [['status', 'type', 'views', 'likes'], 'number'],
            [['status'], 'default', 'value' => self::STATUS_WAIT],
            [['type'], 'default', 'value' => self::TYPE_USER],
            [['price'], 'number'],
            [['created', 'img'], 'safe'],
            [['title', 'slug'], 'string', 'max' => 70],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::class, 'targetAttribute' => ['currency_id' => 'id']],
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
            'user_id' => 'User ID',
            'category_id' => 'Category',
            'title' => Yii::t('menu', 'Title'),
            'slug' => 'Slug',
            'description' => Yii::t('menu', 'Description'),
            'price' => Yii::t('menu','Price'),
            'currency_id' => Yii::t('menu','Currency'),
            'status' => Yii::t('menu', 'Status'),
            'views' => Yii::t('menu', 'Views'),
            'likes' => Yii::t('menu', 'Likes'),
            'created' => Yii::t('menu', 'Created'),
        ];
    }

    public function getImages()
    {
        return Json::decode($this->img);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getCurrency()
    {
        return Currency::findOne($this->currency_id);
        //return $this->hasOne(Currency::class, ['id', 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoodsPhones()
    {
        return $this->hasMany(GoodsPhone::class, ['goods_id' => 'id']);
    }

    public function getPhones()
    {
        return $this->hasMany(UserPhone::class, ['id' => 'phone_id'])->via('goodsPhones');
    }

    public function getPreferences()
    {
        return $this->hasMany(Preference::class, ['product_id' => 'id']);
    }
}
