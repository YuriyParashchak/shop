<?php

namespace backend\helpers;
use common\models\category\Category;
use Yii;
use yii\helpers\Html;

/**
 * Created by PhpStorm.
 * User: glushko
 * Date: 05.02.19
 * Time: 18:22
 */

class CategoryHelper
{

    /**
     * @param  \common\models\category\Category[] $items
     * @param int $lft
     * @param null $rgt
     * @return string
     */
    public static function createTree($items, $lft = 0, $rgt = null)
    {
        $tree = '';
        foreach ($items as $key => $item){

            if($item->lft > $lft && (is_null($rgt) || $item->rgt < $rgt)){
                if(($item->rgt - $item->lft) > 1){
                    $tree .= self::getBody($item, self::getOl(self::createTree($items, $item->lft, $item->rgt), $item));
                }
                else{
                    $tree .= self::getBody($item);
                }

                $lft = $item->rgt;
            }
        }
        return $tree;
    }

    private static function getOl(string $str, Category $item)
    {
        return Html::tag('ol', $str, [
            'class' => $item->lvl > 0 ? 'category-list category-hide-ol' : 'category-list',
        ]);
    }

    private static function getBody(Category $category, $child = null)
    {
        return Html::tag('li', self::getElements($category) . $child);
    }

    private static function getElements(Category $category)
    {
        return Html::tag('div',
            self::getTextCategory($category).
            self::getActiveButtons($category),[
                'class' => 'category-item'
            ]);
    }

    private static function getButtonCollapse()
    {
        return Html::tag('div',
            Html::tag('i', '', [
                'class' => 'fa fa-arrow-circle-down',
                'aria-hidden' => true,
            ]), ['class' => 'btn-collapse']);
    }

    private static function getTextCategory(Category $category)
    {
        return Html::tag('div', ($category->childrenExist() ? self::getButtonCollapse() : '').
            Html::encode($category->getTitle()) . ' (' . Html::encode($category->slug .')'),[
            'class' => 'category-text',
            'style' => ($category->rgt - $category->lft == 1) ? 'cursor: default' : '',
        ]);
    }

    private static function getActiveButtons(Category $category)
    {
        return Html::tag('div',
            Html::tag('i', '', [
                'class' => 'fa fa-plus-circle',
                'onclick' => 'addCategory(this)',
                'title' => Yii::t('menu', 'Create category')
                ]).
            Html::tag('i', '', [
                'class' => 'fa fa-pencil',
                'onclick' => 'editCategory(this)',
                'title' => Yii::t('menu', 'Edit category')
            ]).
            Html::tag('i', '', [
                'class' => 'fa fa-trash',
                'onclick' => 'removeCategory(this)',
                'title' => Yii::t('menu', 'Delete')
            ]).
            Html::a(Html::tag('i', '', [
                'class' => 'fa fa-paperclip',
                'onclick' => 'addAttribute(this)',
                'title' => Yii::t('menu', 'Add attribute')
            ]), ['join-attributes', 'id' => $category->id]),[
                'class' => 'active-buttons',
                'data-item' => $category->id,
            ]);
    }

    public static function getParents(Category $category = null)
    {
        $categories = [];
        if(!$category)
            return $categories;

        array_push($categories, $category);
        $lvl = $category->lvl - 1;
        for($lvl; $lvl > 0; $lvl--){
            $parentCategory = self::getParentCategory($category, $lvl);
            array_unshift($categories, $parentCategory);
        }
        return $categories;
    }

    public static function getParentCategory(Category $category, int $lvl)
    {
        $category = Category::find()
            ->where(['<', 'lft', $category->lft])
            ->andWhere(['>', 'rgt', $category->rgt])
            ->andWhere(['lvl' => $lvl])
            ->orderBy(['lft' => SORT_ASC])
            ->one();

        return$category;
    }

    public static function getNameParents(int $categoryId)
    {
        $category = Category::findOne($categoryId);
        $parentsString = '';
        $parents = self::getParents($category);
        foreach ($parents as $parent){
            $parentsString .= ' / ' . $parent->getTitle();
        }
        return $parentsString;
    }

    public static function getRootCategory(): Category
    {
        return Category::findOne(['lvl' => 0]);
    }
}