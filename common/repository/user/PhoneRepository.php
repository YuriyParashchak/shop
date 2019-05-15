<?php
/**
 * Created by PhpStorm.
 * User: glushko
 * Date: 13.02.19
 * Time: 17:01
 */
namespace common\repository\user;

use \common\models\user\UserPhone;

class PhoneRepository
{
    public function save(UserPhone $phone)
    {
        if(!$phone->save()){
            throw new \RuntimeException('Phone not save');
        }

        return $phone;
    }


    public function getPhone($id, $status = null)
    {
        $phone = UserPhone::find()
            ->where($id)
            ->andFilterWhere(['status' => $status])
            ->all();
        if(!$phone)
            throw new \RuntimeException('Phone not found');

        return $phone;
    }

    public function getPhonesByUserId($userId, $status = null)
    {
        $phone = UserPhone::find()
            ->where(['user_id' => $userId])
            ->andFilterWhere(['status' => $status])
            ->all();
        if(!$phone)
            throw new \RuntimeException('Phones not found');

        return $phone;
    }

    public function getPhoneByPhone($phone, $status = null)
    {
        $phone = UserPhone::find()
            ->where(['phone' => $phone])
            ->andFilterWhere(['status' => $status])
            ->one();

        if(!$phone)
            throw new \RuntimeException('Phone not found');

        return $phone;
    }
    public function getPhoneStatusNotDeleted($userId)
    {
        $phones = UserPhone::find()
            ->where(['!=', 'status', UserPhone::PHONE_DELETED])
            ->andWhere(array('user_id'=>$userId))->all();



        return $phones;
    }

    public function remove(UserPhone $phone)
    {
        if(!$phone->delete())
            throw new \RuntimeException('Phone not deleted');
    }
}