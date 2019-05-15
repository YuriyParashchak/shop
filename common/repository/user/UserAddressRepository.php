<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 14.02.19
 * Time: 11:13
 */

namespace common\repository\user;

use common\models\user\UserAddress;


class UserAddressRepository
{
    public function getUserAddress(int $id)
    {
        if(! $user_address = UserAddress::findOne(['user_id' => $id]))
            throw new \RuntimeException('UserAddress not found');

        return $user_address;
    }

    public function save(UserAddress $user_address)
    {
        if(!$user_address->save())
            throw new \RuntimeException('UserAddress not saved');
    }

}