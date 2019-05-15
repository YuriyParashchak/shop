<?php
/**
 * Created by PhpStorm.
 * User: glushko
 * Date: 22.02.19
 * Time: 13:49
 */

namespace backend\helpers;


class SliderHelper
{
    public static function getUrls(array $photos, int $userId)
    {
        $newPhotos = [];
        foreach ($photos as $photo){
            $photo['url'] = \Yii::getAlias('@frontendUrl') . '/images/product/' . $userId . '/' . $photo['url'];
            $newPhotos[] = $photo;
        }

        return $newPhotos;
    }
}