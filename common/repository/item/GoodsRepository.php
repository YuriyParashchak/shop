<?php

namespace common\repository\item;
use common\models\item\Goods;

class GoodsRepository
{
    public function save(Goods $goods)
    {
        if(!$goods->save()){
            throw new \RuntimeException('Goods not save');
        }

        return $goods;
    }


    public function getGoods($id)
    {
        if(!$goods = Goods::findOne($id))
            throw new \RuntimeException('Goods not found');

        return $goods;
    }

    public function remove(Goods $goods)
    {
        if(!$goods->delete())
            throw new \RuntimeException('Goods not deleted');

    }
}