<?php
date_default_timezone_set('America/Mexico_City');
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
         'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],

        ],
        //can name it whatever you want as it is custom
        'urlManagerCommon' => [
                'class' => 'yii\web\urlManager',
                'baseUrl' => 'common/uploads/',
                'enablePrettyUrl' => true,
                'showScriptName' => false,
        ],

    ],
    'modules' => [
    	'user' => [
        	'class' => 'dektrium\user\Module',
        	
    	],
	],

     'language' => 'es-MX',
     
	
];
