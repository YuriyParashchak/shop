<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 28.03.19
 * Time: 1:40
 */

namespace backend\repository;


use common\models\CategoryBlog;

class BlogCategoryRepository
{
    public function getBlogCategory(int $id)
    {
        if(!$categoryBlog = CategoryBlog::findOne($id))
            throw new \RuntimeException('CategoryBlognot found');

        return $categoryBlog;
    }

    public function save(CategoryBlog $categoryBlog)
    {
        if(!$categoryBlog->save())
            throw new \RuntimeException('CategoryBlog not saved');
    }

    /**
     * @param CategoryBlog $categoryBlog
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(CategoryBlog $categoryBlog)
    {
        if(!$categoryBlog->delete())
            throw new \RuntimeException('CategoryBlog not deleted');
    }
}