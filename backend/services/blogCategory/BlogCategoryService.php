<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 27.02.19
 * Time: 13:02
 */

namespace backend\services\blogCategory;

use backend\forms\blogCategory\BlogCategoryForm;
use backend\forms\subject\ContactSubjectForm;
use backend\models\ContactSubject;
use backend\repository\BlogCategoryRepository;
use common\models\CategoryBlog;


class BlogCategoryService
{

    /**
     * @var BlogCategoryRepository
     */
    private $repository;

    public function __construct(BlogCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(BlogCategoryForm $form)
    {
        $blogCategory = new CategoryBlog();
        $blogCategory->title_us = $form->title_us;
        $blogCategory->setTitle($form->title_uk, $form->title_ru);
        $this->repository->save($blogCategory);
        return $blogCategory;
    }

    public function update(BlogCategoryForm  $form, CategoryBlog $blogCategory)
    {
        $blogCategory->title_us = $form->title_us;
        $blogCategory->setTitle($form->title_uk, $form->title_ru);
        $this->repository->save($blogCategory);
        return $blogCategory;
    }

    public function delete(CategoryBlog $blogCategory)
    {
        $this->repository->remove($blogCategory);
    }


}