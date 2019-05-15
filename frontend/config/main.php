<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name' => 'Trade Center',
    'basePath' => dirname(__DIR__),
    'on beforeRequest' => ['common\models\User','setSessionLanguage'],//your beforeRequest event callback
    'bootstrap' => [
        'log',
        'languageSwitcher', // завантаження віджету обробки перемикача мови
    ],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'language'=>'uk',  //встановити відображення майту на Українській мові
        //\Yii::$app->language = 'en-US', // змінити на китайську
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'blog/index' => 'blog/index',
                'blog' => 'blog/index',
                'blog/<url:[\w-]+>' => 'blog/view',
                'blog/category/<url:[\w-]+>' => 'blog/category',
                'blog/comment/id'=>'blog/comment',
                'product/category/<url:[\w-]+>' => 'product/category',
//                'blog-category/index' => 'blog-category/index',
//                'blog-category' => 'blog-category/index',
//                'blog-category/<url:[\w-]+>' => 'blog-category/view'

            ],
        ],
        'languageSwitcher' => [  // шлях до файлу віджета який завантажується у bootstrap
            'class' => 'common\components\languageSwitcher',
            'queryParam' => 'lang',
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/config/translations',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'menu' => 'menu.php',
                        //'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => '6LfqmJQUAAAAAFAeZSCEwCf6fEvk8QhA97vSKMru',
            'secret' => '6LfqmJQUAAAAAJ_K-I2EQlppG6m0lPB8ArzQg2N8',
        ],
    ],
    'params' => $params,
];
