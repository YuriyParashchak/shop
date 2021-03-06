<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'on beforeRequest' => ['common\models\User','setSessionLanguage'],//your beforeRequest event callback
    'bootstrap' => [
        'log',
        'languageSwitcher', // завантаження віджету обробки перемикача мови
    ],
    'modules' => [
        'category' => [
            'class' => 'backend\modules\category\Category',
        ],

    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'language'=>'en',  //встановити відображення майту на Українській мові
        // \Yii::$app->language = 'zh-CN'; // змінити на китайську
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
                        'message' => 'message.php',
                        'yii' => 'yii.php'
                        //'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
];
