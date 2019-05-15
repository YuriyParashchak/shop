<?php
namespace backend\forms\user;

use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 01.02.19
 * Time: 11:38
 */

class UserForm  extends Model
{

    public $lastName;
    public $firstName;
    public $email;
    public $phones = [];
    public $status;
    public $file;

    public function rules()
    {
        return [
           /* [['lastName','firstName'], 'string', 'max', 70 ],
            ['email','unique'],
            ['status', 'integer'],
            ['image', 'file', 'allowEmpty'=>true, 'types'=>'jpg,jpeg,gif,png'],
            ['phones','safe'],*/

        ];
    }
}