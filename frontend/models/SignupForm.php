<?php
namespace frontend\models;

use common\models\user\UserTmp;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $url_name;
    public $email;
    public $password;
    public $password_repeat;
    public $confirmed = false;
    public $firstName;
    public $lastName;



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['url_name', 'string'],
//            ['username', 'required'],
            ['url_name', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This url_name has already been taken.'],
//            ['username', 'string', 'min' => 2, 'max' => 255],
            ['confirmed', 'boolean'],

            ['lastName', 'trim'],
            ['firstName', 'trim'],
            [['lastName', 'firstName'], 'required'],
            [['lastName', 'firstName'], 'string', 'min' => 2, 'max' => 70],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'firstName' => Yii::t('menu', 'First Name'),
            'lastName' => Yii::t('menu', 'Last Name'),
            'password'=> Yii::t('menu', 'Password'),
            'confirmed'=> Yii::t('menu', 'Confirmed'),
            'password_repeat' => Yii::t('menu', 'Password Repeat')
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }

    /**
     * @throws \yii\base\Exception
     */
    public function getUserTmp()
    {
        $user = new UserTmp();
        $user->username = $this->url_name;
        $user->email = $this->email;
        $user->first_name = $this->firstName;
        $user->last_name = $this->lastName;
        $user->password = $user->setPassword($this->password);

        return $user;
    }
}
