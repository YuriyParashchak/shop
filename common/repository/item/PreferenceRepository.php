<?php

namespace common\repository\item;
use common\models\item\Preference;
use Yii;

class PreferenceRepository
{
    public function save(Preference $preference)
    {
        if(!$preference->save()){
            throw new \RuntimeException(Yii::t('message', 'Preference not save'));
        }

        return $preference;
    }

    public function getPreferenceBy(int $userId, int $productId)
    {
        if(!$preference = Preference::findOne(['user_id' => $userId, 'product_id' => $productId]))
            throw new \RuntimeException('Preference not found');

        return $preference;
    }

    public function getPreference($id)
    {
        if(!$preference = Preference::findOne($id))
            throw new \RuntimeException('Preference not found');

        return $preference;
    }

    public function remove(Preference $preference)
    {
        if(!$preference->delete())
            throw new \RuntimeException(Yii::t('message', 'Preference not delete'));

    }

    public function removeAll(int $goodsId)
    {
        if(!Preference::deleteAll(['product_id' => $goodsId]))
            throw new \RuntimeException(Yii::t('message', 'Preference not delete'));
    }
}