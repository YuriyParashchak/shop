<?php

namespace common\models\category;

use common\models\item\Goods;
use common\queries\category\CategoryQuery;
use paulzi\nestedsets\NestedSetsBehavior;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\helpers\Json;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $slug
 * @property int $lft
 * @property int $rgt
 * @property int $lvl
 *
 * @property CategoryAttribute[] $categoryAttributes
 * @property Attribute[] $attributes0
 * @property Goods[] $goods
 */
class Category extends \yii\db\ActiveRecord
{

    public $title_us;
    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title_us',
                'ensureUnique' => true,
            ],
            'nested' => [
                'class' => NestedSetsBehavior::class,
                'depthAttribute' => 'lvl',
            ]
        ];
    }

    public static function find()
    {
        return new CategoryQuery(static::class);
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lft', 'rgt', 'lvl'], 'integer'],
            [['title', 'title_us', 'slug'], 'required'],
            [['description'], 'string'],
            [['slug'], 'string', 'max' => 100],
            [['title'], 'string', 'max' => 255],
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
            'description' => 'Description',
            'slug' => 'Slug',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'lvl' => 'Lvl',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryAttributes()
    {
        return $this->hasMany(CategoryAttribute::class, ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributes0()
    {
        return $this->hasMany(Attribute::class, ['id' => 'attribute_id'])->viaTable('category_attribute', ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasMany(Goods::class, ['category_id' => 'id']);
    }

    public function childrenExist()
    {
        if(($this->lft +1) === $this->rgt)
            return false;
        else
            return true;
    }

    public function setTitle($title_uk, $title_ru)
    {
        $this->title = Json::encode([
            'en' => $this->title_us,
            'uk' => $title_uk,
            'ru' => $title_ru
            ]);
    }

    public function getTitle($language = null)
    {
        if(!$language)
            $language = Yii::$app->session['language'];

        return Json::decode($this->title)[$language];
    }

    public function getTitles()
    {
        return Json::decode($this->title);
    }
}
