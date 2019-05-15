<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 11.03.19
 * Time: 17:21
 */
namespace common\services\blog;


use common\components\manager\TransactionManager;
use common\models\Blog;
use common\models\BlogHit;
use Yii;

class BlogService
{

    public function updateViewsCounters(Blog $blog)
    {
        TransactionManager::wrap(function () use ($blog){
            $user_id = null;
            if(!Yii::$app->user->isGuest)
                $user_id = Yii::$app->user->id;


            if(!$this->isViewed($blog, $user_id)) {

                $view_event = BlogHit::createPostHit($user_id, $blog->id, BlogHit::TYPE_VIEW);
                $blog->views_count+=1;
                $blog->save();

                if(!$view_event->save()){
                    throw new \RuntimeException('Views not set');
                }


            }
        });
    }

    // перевірка чи даний пост має перегляд від користувача або по даній ip адресі
    public function isViewed($blog, $user_id = null) {
        if($user_id == null && !Yii::$app->user->isGuest)
            $user_id = Yii::$app->user->id;

        $view_event = BlogHit::find()->where(
            ['blog_id'=> $blog->id, 'event_type'=> BlogHit::TYPE_VIEW ]);
        if($user_id)
            $view_event = $view_event->andWhere(['user_id'=> $user_id]);
        else
            $view_event = $view_event->andWhere(['ip_address' => Yii::$app->request->userIP]);

        $view_event = $view_event->one();

        if($view_event != null){
            return true;
        }
        else
            return false;
    }

}