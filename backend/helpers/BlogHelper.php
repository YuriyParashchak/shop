<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 05.03.19
 * Time: 13:38
 */

namespace backend\helpers;


use common\models\Blog;
use common\models\CategoryBlog;
use common\models\CommentBlog;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class BlogHelper
{
    public static function getStatus()
    {
        return [
          Blog::STATUS_POSTED=>Yii::t('blog','Posted'),
            Blog::STATUS_UNPUBLISHED=>Yii::t('blog','Unpublished'),

        ];

    }
    public static function getStatusMessage($status)
    {
        return ArrayHelper::getValue(self::getStatus(), $status);

    }
    public static function getStatusTitle($status)
    {
        return ArrayHelper::getValue(\common\models\commentBlog::getStatuses(), $status);

    }
    public static function viewImage($image)
    {
       return Yii::getAlias('@frontendUrl').'/imagePost/thumbnail-500x500/'.$image;

    }

    public static function getCategory()
    {
        $category = CategoryBlog::find()->all();
        $result = [];

        foreach ($category as $cat)
        {
           $name_cat= Json::decode($cat->name)[Yii::$app->language];
//         $cat_id = $cat->id;
           $result[$cat->id] = $name_cat;
        }


        return $result; //ArrayHelper::map($category, 'id','name');
    }

/*public static function getCommentArticle($id)
{
    return ArrayHelper::getValue(\common\models\commentBlog::getArticleName(), $id);

}*/

    public static function getCount($status = false) {

        $query = CommentBlog::find();

        if($status !== false)
            $query->where(['=', 'status',$status]);

        return $query->count();
    }
}