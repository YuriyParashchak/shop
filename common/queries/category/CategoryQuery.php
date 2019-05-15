<?php
/**
 * Created by PhpStorm.
 * User: glushko
 * Date: 05.02.19
 * Time: 12:40
 */

namespace common\queries\category;

class CategoryQuery extends \yii\db\ActiveQuery
{
    use \paulzi\nestedsets\NestedSetsQueryTrait;
}