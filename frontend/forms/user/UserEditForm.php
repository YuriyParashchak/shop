<?php
namespace frontend\forms\user;

use common\models\User;
use common\models\user\UserAddress;
use common\models\user\UserPhone;
use common\models\user\UserProfile;
use Yii;

class UserEditForm extends \yii\base\Model
{

    public $lastName;
    public $firstName;
    public $email;
    public $phones = [];
    public $imageFile;

    public $country;
    public $street;
    public $region;
    public $city;

    public $birthday;


    public function __construct()
    {
        $id = Yii::$app->user->id;
        $profile = UserProfile::findOne(['user_id' => $id]);
        if($profile)
        {
            $this->lastName = $profile->last_name;
            $this->firstName = $profile->first_name;
            $this->birthday = $profile->birthday;
        }



       $user_address = UserAddress::findOne(['user_id' => $id]);
       if($user_address ) {
           $this->country = $user_address->country ?? ' ';
           $this->street = $user_address->street ?? ' ';
           $this->region = $user_address->region ?? ' ';
           $this->city = $user_address->city ?? ' ';
       }



        $userEmail=User::findOne($id);
        $this->email=$userEmail->email;
    }


    public function rules()
    {
        return [
            [['lastName','firstName'], 'string', 'max'=> 50 ],
            [['lastName','firstName'], 'string', 'min'=> 2 ],

             ['email','email'],
             ['phones','safe'],
             ['birthday','safe'],

            [['country','street','region','city'], 'string', 'max'=> 70 ],
            [['country','street','region','city'], 'string', 'min'=> 3 ],
            //[['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],

        ];
    }
    public function getWithoutDeleted()
    {
        return UserPhone::find()->where(['!=', 'status', UserPhone::PHONE_DELETED])->all();
    }


}