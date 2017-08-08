<?php



$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
     'modules' => [
        'user' => [
            // following line will restrict access to admin page
            'as frontend' => 'dektrium\user\filters\FrontendFilter',
        ],
    ],

    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'class' => 'common\components\Request',
            'web'=> '/frontend/web'

        ],

        /* 'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],*/
        'user' => [
            'identityCookie' => [
                'name'     => '_frontendIdentity',
                'path'     => '/',
                'httpOnly' => true,
            ],
        ],

        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '',
        ],
        
        'session' => [
            'name' => 'FRONTENDSESSID',
            'cookieParams' => [
                'httpOnly' => true,
                'path'     => '/',
            ],
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
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                  '<controller:\w+>/<id:\d+>' => '<controller>/view',
                  '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                  '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
        
        
    ],
    'params' => $params,
];
