<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "slider_image".
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $url
 * @property string $description
 */
class SliderImage extends \yii\db\ActiveRecord
{

    /**
     * @var UploadedFile
     */
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'slider_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           // [['image'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 80],
            [['image', 'url'], 'string', 'max' => 250],
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
            'name' => Yii::t('slider','Name'),
            'image' => Yii::t('slider','Image'),
            'url' => 'Url',
            'description' => Yii::t('slider','Description'),
        ];
    }

    public  function beforeSave($insert)
    {

        if ($this->validate() && $this->imageFile) {
            $nameFile = md5(uniqid()).$this->imageFile->baseName . '.' . $this->imageFile->extension;
            $this->image = $nameFile;

            $this->imageFile->saveAs(Yii::getAlias('@frontendWeb') . '/siteSlider/' . $nameFile);

        }
        return true;

    }
}
