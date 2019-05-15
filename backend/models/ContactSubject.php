<?php

namespace backend\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "contact_subject".
 *
 * @property int $id
 * @property string $name
 */
class ContactSubject extends \yii\db\ActiveRecord
{

    public $title_us;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact_subject';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
           // [['$title_us'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }
    public function getTitle($language=null)
    {
        if (!$language)
            return Json::decode($this->name)[/*'uk'*/Yii::$app->session['language'] ?? 'ru'];    // TODO: get default lang
       // return Json::decode($this->name)[Yii::$app->session['language']];
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
