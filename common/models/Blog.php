<?php

namespace common\models;


use Imagine\Image\Box;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\data\ActiveDataProvider;
use yii\imagine\Image;
use yii\web\UploadedFile;


/**
 * This is the model class for table "blog".
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $text
 * @property int $status
 * @property string $data
 * @property int $views_count
 * @property string $image_post
 * @property int $category_id
 * @property CommentBlog[] $comments
 */

class Blog extends \yii\db\ActiveRecord
{

    const STATUS_UNPUBLISHED = 1;
    const STATUS_POSTED= 10;

    /**
     * @var UploadedFile
     */
    public $imageFile;


    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'name',
                'ensureUnique' => true,
                'slugAttribute' => 'url',
            ],
        ];
    }

    public static function getStatuses()
    {
        return [

            self::STATUS_UNPUBLISHED =>Yii::t('blog','Unpublished'),
            self::STATUS_POSTED => Yii::t('blog','Posted'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'url', 'text','category_id'], 'required'],
            [['text'], 'string'],
            [['status', 'views_count'], 'integer'],
            [['data'], 'safe'],
            [['name'], 'string', 'max' => 250],
            [['url'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg,jpeg'],
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
            'url' => 'Url',
            'text' => Yii::t('blog','Text'),
            'status' => Yii::t('user','Status'),
            'data' => Yii::t('blog','Data'),
            'views_count' => Yii::t('blog','Views Count'),
           'imageFile' =>Yii::t('blog','Image File'),
            'category'=>Yii::t('blog','Category'),
        ];
    }


    public  function beforeSave($insert)
    {

        if ($this->validate() && $this->imageFile) {
            $nameFile = md5(uniqid()).$this->imageFile->baseName . '.' . $this->imageFile->extension;
            $this->image_post = $nameFile;

            $this->imageFile->saveAs(Yii::getAlias('@frontendWeb') . '/imagePost/' . $nameFile);

            Image::thumbnail(Yii::getAlias('@frontendWeb') . '/imagePost/'. $nameFile, 500, 500)
                ->resize(new Box(500,500))
                ->save(Yii::getAlias('@frontendWeb') . '/imagePost/thumbnail-500x500/'.$nameFile,
                    ['quality' => 90]);
            unlink(Yii::getAlias('@frontendWeb') . '/imagePost/' . $nameFile);
        }
        return true;

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(CategoryBlog::class, ['category_id' => 'id']);
    }

    public function getComments()
    {
        return $this->hasMany(CommentBlog::className(), ['article_id'=>'id']);
    }

    public function getArticleComments()
    {
        return $this->getComments()->where(['status'=>1])->all();
    }
}
