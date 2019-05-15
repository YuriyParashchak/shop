<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 05.02.19
 * Time: 11:42
 */

namespace frontend\forms\user;
use common\models\User;
use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\base\InvalidParamException;

class ChangePasswordForm extends Model
{
    public $currentPassword;
    public $newPassword;
    public $newPasswordRepeat;

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
        parent::__construct($config);
    }



    public function rules()
    {
        return [

               [['currentPassword', 'newPassword', 'newPasswordRepeat'], 'required'],
               ['currentPassword', 'currentPassword'],
               ['newPassword', 'string', 'min' => 6],
               ['newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword'],

        ];

    }
    public function attributeLabels()
    {
        return [
            'newPassword' => Yii::t('app', 'User new Password'),
            'newPasswordRepeat' => Yii::t('app', 'User repeat Password'),
            'currentPassword' => Yii::t('app', 'User current Password'),
        ];
    }


    /**
     * @param string $attribute
     * @param array $params
     */
    public function currentPassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (!$this->_user->validatePassword($this->$attribute)) {
                $this->addError($attribute, Yii::t('app', 'error wrong current password'));
            }
        }
    }

    /**
     * @return boolean
     * @throws Exception
     */
    public function changePassword()
    {
        if ($this->validate()) {
            $user = $this->_user;
            $user->setPassword($this->newPassword);
            return $user->save();
        } else {
            return false;
        }
    }




}