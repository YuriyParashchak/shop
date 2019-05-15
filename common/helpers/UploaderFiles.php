<?php
/**
 * Created by PhpStorm.
 * User: glushko
 * Date: 07.02.19
 * Time: 15:43
 */

namespace common\helpers;

use Yii;
use \yii\helpers\FileHelper;

class UploaderFiles
{
    public static function saveFile($file, $path, $name)
    {
        if(FileHelper::createDirectory($path, 0777)){
            \move_uploaded_file($file['tmp_name'], $path . $name);
            return $name;
        }
        return '';
    }

    public static function isImage($file)
    {
        if($file['type'] === 'image/jpeg' ||
            $file['type'] === 'image/jpg' ||
            $file['type'] === 'image/png')
            return true;
        else
            return false;
    }

    public static function getExtenction($file)
    {
        $array = explode('.', $file['name']);
        return ($array[count($array) - 1]);
    }

    public static function getExtentionWithMime($file)
    {
        list($img, $ext) = explode('/', $file['type']);
        return $ext;
    }

    public static function getName()
    {
        return Yii::$app->security->generateRandomString(16);
    }

    public static function removeImage($fileName, $path)
    {
        if(file_exists($path . $fileName)){
            if(!unlink($path . $fileName))
                throw new \RuntimeException('Image not deleted');
        }
    }

    public static function moveFile($from, $to, $name)
    {
        if(file_exists($from)){
            FileHelper::createDirectory($to, 0777);
            copy($from, $to  . $name);
            unlink($from);
        }
    }
}