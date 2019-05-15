<?php
/**
 * Created by PhpStorm.
 * User: glushko
 * Date: 25.02.19
 * Time: 17:52
 */

namespace common\repository\category;


use common\models\category\AttributeData;
use common\models\category\AttributeValues;

class AttributeDataRepository
{
    public function getAttribute(int $id)
    {
        if(!$attributeData = AttributeData::findOne($id))
            throw new \RuntimeException('Attribute data not found');

        return $attributeData;
    }

    public function save(AttributeData $attributeData)
    {
        if(!$attributeData->save())
            throw new \RuntimeException('Attribute data not saved');
    }

    /**
     * @param AttributeData $attributeData
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(AttributeData $attributeData)
    {
        if(!$attributeData->delete())
            throw new \RuntimeException('Attribute data not deleted');
    }

    public function removeAll(array $condition)
    {
        if(!AttributeData::deleteAll($condition)){
            throw new \RuntimeException('All attributes data not deleted');
        }
    }

    public function getAttributeVales(int $id)
    {
        if(!$attributeValues = AttributeValues::findOne($id))
            throw new \RuntimeException('Attribute values not found');

        return $attributeValues;
    }

    public function saveAttributeValues(AttributeValues $attributeValues)
    {
        if(!$attributeValues->save())
            throw new \RuntimeException('Attribute values not saved');
    }

    /**
     * @param AttributeValues $attributeValues
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function removeAttributeValues(AttributeValues $attributeValues)
    {
        if(!$attributeValues->delete())
            throw new \RuntimeException('Attribute values not deleted');
    }

    public function removeAttributeValuesAll(array $condition)
    {
        if(!AttributeValues::deleteAll($condition)){
            throw new \RuntimeException('All attributes values not deleted');
        }
    }
}