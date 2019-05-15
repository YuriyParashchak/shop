<?php
namespace common\repository\user;
use common\models\user\UserProfile;

/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 14.02.19
 * Time: 0:15
 */

class UserProfileRepository
{
    public function getUserProfile(int $id)
    {
        if(!$userProfile = UserProfile::findOne(['user_id' => $id]))
            throw new \RuntimeException('UserProfile not found');

        return $userProfile;
    }

    public function save(UserProfile $userProfile)
    {
        if(!$userProfile->save())
            throw new \RuntimeException('UserProfile not saved');
    }
}