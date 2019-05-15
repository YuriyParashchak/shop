<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\helpers\Json;

/**
 * This is the model class for table "category_blog".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 *
 * @property Blog[] $blogs
 */
class CategoryBlog extends \yii\db\ActiveRecord
{
    public $title_us;
    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title_us',
                'ensureUnique' => true,
                'slugAttribute' => 'slug',
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_blog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['slug'], 'string', 'max' => 70],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('blog','Name'),
            'slug' => Yii::t('blog','Slug'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlog()
    {
        return $this->hasMany(Blog::className(), ['category_id' => 'id']);
    }

    public function getTitle($language = null)
    {
        if (!$language)
            return Json::decode($this->name)[Yii::$app->language ?? 'ru'];

        else  return Json::decode($this->name)[$language];
    }

    public function setTitle($title_uk, $title_ru)
    {
        $this->name= Json::encode([
            'en' => $this->title_us,
            'uk' => $title_uk,
            'ru' => $title_ru,
        ]);
    }
}
