<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 20.02.19
 * Time: 11:56
 */

namespace backend\forms\user;


use common\models\auth\AuthAssignment;
use common\models\auth\AuthItem;
use common\models\User;
use Yii;
use yii\base\Model;

class UpdateUserForm extends Model
{
    public $newPassword;
    public $status;
    public $role;


    /**
     * @var User
     */
    private $_user;

    /**
     * @param User $user
     * @param array $config
     */

    public function __construct(User $user, $config = [])
    {

        $this->_user = $user;
       $this->status=$user->status;
       if(AuthAssignment::findOne(['user_id' => $user->id]))
       $this->role = AuthAssignment::findOne(['user_id' => $user->id])->item_name;
       else $this->role='user';

        parent::__construct($config);
    }


    public function rules()
    {
        return [


            ['newPassword', 'string', 'min' => 6],
            ['status','safe'],
            ['role','safe']
        ];

    }


    public function updateUser(UpdateUserForm $model,$id)
    {

            $user = $this->_user;
            if($this->newPassword)
            $user->setPassword($this->newPassword);
            $user->status =(integer)$this->status;

        $auth = Yii::$app->authManager;
        $mod = AuthAssignment::findOne(['user_id' => $id]);
        if ($mod!=null)
            $mod->delete();

        if(!$auth->assign(AuthItem::findOne( $model->role), $id))
            throw new \RuntimeException('Role not saved');

            if(!$user->save())
                throw new \RuntimeException('User not saved');
            else Yii::$app->session->setFlash('success', 'Data Changed!');

    }


}