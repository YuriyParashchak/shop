<?php


namespace common\helpers;


use HTMLPurifier_Config;
use yii\helpers\HtmlPurifier;


class HtmlPurifierHelper
{

    public static function process($html)
    {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Attr.AllowedRel', ['nofollow']);
        $config->set('HTML.SafeObject', true);
        $config->set('Output.FlashCompat', true);
        $config->set('HTML.SafeIframe', false);

        return HtmlPurifier::process($html, $config);
    }

}