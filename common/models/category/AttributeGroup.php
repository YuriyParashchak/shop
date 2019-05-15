<?php

namespace common\models\category;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "attribute_group".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Attribute[] $attributes0
 */
class AttributeGroup extends \yii\db\ActiveRecord
{
    public  $title_us;
    public  $title_uk;
    public  $title_ru;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attribute_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'title_us', 'title_uk', 'title_ru'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['title_us', 'title_uk', 'title_ru'], 'string', 'max' => 70],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('menu','Title'),
            'title_us' => Yii::t('menu','Title us'),
            'title_uk' => Yii::t('menu','Title uk'),
            'title_ru' => Yii::t('menu','Title ru'),
            'description' => Yii::t('menu','Description'),
            'created_at' => Yii::t('menu','Created At'),
            'updated_at' => Yii::t('menu','Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributes0()
    {
        return $this->hasMany(Attribute::class, ['attribute_group_id' => 'id']);
    }

    public function getTitle($language = null)
    {
        if(!$language)
            $language = Yii::$app->session['language'];

        return Json::decode($this->title)[$language];
    }

    public function setTitle()
    {
        $this->title = Json::encode([
            'en' => $this->title_us,
            'uk' => $this->title_uk,
            'ru' => $this->title_ru,
        ]);
    }

    public function setTitleLanguage()
    {
        $titleL = Json::decode($this->title);
        $this->title_us = $titleL['en'];
        $this->title_uk = $titleL['uk'];
        $this->title_ru = $titleL['ru'];
    }
}
