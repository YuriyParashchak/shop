<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 27.02.19
 * Time: 17:14
 */

namespace frontend\forms\user;


use common\models\User;
use common\models\user\UserProfile;
use Yii;
use yii\base\Model;

class SupportRequestForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;


      public function __construct()
    {
        $id = Yii::$app->user->id;
        $profile = UserProfile::findOne(['user_id' => $id]);
        if($profile)
            $this->name = $profile->last_name.' '.$profile->first_name;

        $userEmail=User::findOne($id);
        if($userEmail)
        $this->email=$userEmail->email;
    }

        public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],

        ];
    }
    public function attributeLabels()
    {
        return [

            'name' => Yii::t('user','Name'),
            'subject' => Yii::t('user','Topics'),
            'body' => Yii::t('user','Message'),
        ];
    }

}