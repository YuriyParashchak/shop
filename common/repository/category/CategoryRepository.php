<?php
/**
 * Created by PhpStorm.
 * User: glushko
 * Date: 05.02.19
 * Time: 14:21
 */

namespace common\repository\category;


use common\models\category\Category;

class CategoryRepository
{
    public function getCategory(int $id)
    {
        if(!$category = Category::findOne($id))
            throw new \RuntimeException('Category not found');

        return $category;
    }

    public function save(Category $category)
    {
        if(!$category->save())
            throw new \RuntimeException('Category not saved');
    }

    /**
     * @param Category $category
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Category $category)
    {
        if(!$category->delete())
            throw new \RuntimeException('Category not deleted');
    }
}