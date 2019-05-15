<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 27.02.19
 * Time: 17:56
 */

namespace backend\helpers;


use backend\models\ContactSubject;
use common\models\SupportRequest;
use Yii;
use yii\helpers\ArrayHelper;

class SupportRequestHelper
{
    public static function getSubject()
    {
        $contactSubjects = ContactSubject::find()->all();

        return ArrayHelper::map($contactSubjects, 'id', function ($contactSubject){
            return $contactSubject->getTitle();
        });
    }

    public static function getStatus()
    {
        return [
            SupportRequest::STATUS_PROCESSED=>Yii::t('user','Processed'),
            SupportRequest::STATUS_UNREAD=>Yii::t('user','Unread'),
            SupportRequest::STATUS_READ=>Yii::t('user','Read'),

        ];

    }
    public static function getStatusMessage($status)
    {
        return ArrayHelper::getValue(self::getStatus(), $status);

    }

    public static function getCount($status = false) {

        $query = SupportRequest::find();

        if($status !== false)
            $query->where(['=', 'status',$status]);

       return $query->count();
    }

//    public static function getAllMessage()
//    {
//        return SupportRequest::find()->count();
//    }
//    public static function  getAllMessageStatusRead()
//    {
//        return SupportRequest::find()->where(['=', 'status', SupportRequest::STATUS_READ])->count();
//
//    }
//    public static function  getAllMessageStatusUnread()
//    {
//        return SupportRequest::find()->where(['=', 'status', SupportRequest::STATUS_UNREAD])->count();
//
//    }
//    public static function  getAllMessageStatusProcessed()
//    {
//        return SupportRequest::find()->where(['=', 'status', SupportRequest::STATUS_PROCESSED])->count();
//
//    }



}