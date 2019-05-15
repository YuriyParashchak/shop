<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 15.02.19
 * Time: 13:45
 */

namespace common\repository\user;


use common\models\user\CreditCard;

class CreditCardRepository
{
    public function getCreditCard(int $id)
    {
        if(!$creditCard = CreditCard::findOne(['user_id' => $id]))
            throw new \RuntimeException('Credit Card not found');

        return $creditCard;
    }

    public function save(CreditCard $creditCard)
    {
        if(!$creditCard->save())
            throw new \RuntimeException('Credit Card not saved');
    }

}