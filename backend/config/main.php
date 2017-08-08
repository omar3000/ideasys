<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [ 
        'user' => [
        'class' => 'dektrium\user\Module',
        'enableUnconfirmedLogin' => true,
        'confirmWithin' => 21600,
        'cost' => 12,
        'admins' => ['admin']
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
                'class' => 'common\components\Request',
                'web'=> '/backend/web',
                'adminUrl' => '/backend'

        ],
        'user' => [
            'identityCookie' => [
                'name'     => '_backendIdentity',
                'path'     => '/',
                'httpOnly' => true,
            ],
        ],

        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '',
        ],
   
        'session' => [
            'name' => 'BACKENDSESSID',
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
            ///'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            /*'rules' => [
                  '<controller:\w+>/<id:\d+>' => '<controller>/view',
                  '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                  '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],*/
        ],
        'authManager' => [      'class' => 'dektrium\rbac\components\DbManager',  ],
        
    ],
    'modules' => [
        'rbac' => [ 'class' => 'dektrium\rbac\RbacWebModule',],
        'user' => [
            'class' => 'dektrium\user\Module',
            //'as backend' => 'dektrium\user\filters\BackendFilter',
            'admins' => ['omar3000']

            ],
        ],
    'params' => $params,
];
