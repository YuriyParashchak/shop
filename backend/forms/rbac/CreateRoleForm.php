<?php


namespace backend\forms\rbac;
use yii\base\Model;

/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 21.02.19
 * Time: 13:17
 */

class CreateRoleForm extends Model
{
    public $role;
    public $description;
    public $child;

    public function rules()
    {
        return [

            ['role','safe'],
            ['child','safe'],
            ['description','safe'],

        ];
    }

}