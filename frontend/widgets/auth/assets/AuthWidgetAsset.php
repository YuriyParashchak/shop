<?php

namespace frontend\widgets\auth\assets;

use yii\web\AssetBundle;

/**
 * Auth Widget bundle.
 */
class AuthWidgetAsset extends AssetBundle
{
    // public $basePath = '@webroot';
    // public $baseUrl = '@web';
    public $sourcePath = "@frontend/widgets/auth/assets";

    public $css = [
        // 'css/site.css',
    ];

    public $js = [
        'js/authentificate.js',
        'js/register.js',
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];

    public $publishOptions = [
        'forceCopy'=>true,
      ];
}
