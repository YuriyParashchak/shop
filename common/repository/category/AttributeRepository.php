<?php
/**
 * Created by PhpStorm.
 * User: glushko
 * Date: 07.02.19
 * Time: 10:53
 */

namespace common\repository\category;


use common\models\category\Attribute;
use common\models\category\AttributeGroup;

class AttributeRepository
{
    public function getAttribute(int $id)
    {
        if(!$attribute = Attribute::findOne($id))
            throw new \RuntimeException('Attribute not found');

        return $attribute;
    }

    public function save(Attribute $attribute)
    {
        if(!$attribute->save())
            throw new \RuntimeException('Attribute not saved');
    }

    /**
     * @param Attribute $attribute
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Attribute $attribute)
    {
        if(!$attribute->delete())
            throw new \RuntimeException('Attribute not deleted');
    }

    public function removeAll(array $condition)
    {
        if(!Attribute::deleteAll($condition)){
            throw new \RuntimeException('All attributes not deleted');
        }
    }

    public function removeGroup(AttributeGroup $group)
    {
        if(!$group->delete()){
            throw new \RuntimeException('AttributeGroup not deleted');
        }
    }
}