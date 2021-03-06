<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 27.02.19
 * Time: 12:42
 */

namespace backend\forms\subject;

use backend\models\ContactSubject;
use Yii;
use yii\base\Model;

class ContactSubjectForm extends Model
{
    public  $title_us;
    public  $title_uk;
    public  $title_ru;


    public function __construct(ContactSubject $subject = null, array $config = [])
    {
        if($subject){
            $this->title_us = $subject->getTitle('en');
            $this->title_uk = $subject->getTitle('uk');
            $this->title_ru = $subject->getTitle('ru');

        }
        parent::__construct($config);
    }
    public function rules()
    {
        return [
            [['title_us', 'title_uk', 'title_ru'], 'required'],
            [['title_ru', 'title_uk', 'title_us'], 'string', 'max' => 70],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [

            'title_us' => Yii::t('menu','Title us'),
            'title_uk' => Yii::t('menu','Title uk'),
            'title_ru' => Yii::t('menu','Title ru'),

        ];
    }

    public function getTitle($language)
    {
        switch ($language){
            case 'uk':
                return $this->title_uk;
            case 'ru':
                return $this->title_ru;
            default:
                return $this->title_us;
        }
    }
}