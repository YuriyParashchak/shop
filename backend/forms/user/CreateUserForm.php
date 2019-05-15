<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 20.02.19
 * Time: 13:15
 */

namespace backend\forms\user;


use common\components\manager\TransactionManager;
use common\models\auth\AuthItem;
use common\models\User;
use common\models\user\UserProfile;
use Yii;
use yii\base\Model;

class CreateUserForm extends Model
{

    public $lastName;
    public $firstName;
    public $email;
    public $status;
    public $password;


    private $_user;

    public function __construct( $config = [])
    {
        $this->_user = new User();;

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['lastName','firstName'], 'string', 'max'=> 50 ],
            [['lastName','firstName'], 'string', 'min'=> 2 ],

            ['email','email'],
            ['status','safe'],

            ['password', 'string', 'min' => 6],

        ];
    }


    public function createUser()
    {

        TransactionManager::wrap(function ()  {

        $user = $this->_user;
        $user->email = $this->email;

        $user->setPassword($this->password);
        $user->generateAuthKey();

        if(!$user->save())
            throw new \RuntimeException('User not created');

        $user->url_name='id_'.$user->id;
        if(!$user->save())
            throw new \RuntimeException('User not created');

        $userProfile = new UserProfile();
        $userProfile->user_id = $user->id;
        $userProfile->last_name =$this->lastName;
        $userProfile->first_name =$this->firstName;
        if(!$userProfile->save())
            throw new \RuntimeException('UserProfile not created');

            Yii::$app->authManager->assign(AuthItem::findOne( 'user'), $user->id);

           // return $user ;
        });

    }
}