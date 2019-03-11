<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['*']
        ],
//        'debug' => [
//            'class' => 'yii\debug\Module',
//            'allowedIPs' => ['*']
//        ],
        'api' => [
            'class' => 'app\api\ApiModule'
        ]
    ],
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],

    
    
    
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
//        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
//            'cookieValidationKey' => '8GYLGS3AXm4YGWwqrbVlLG7-8LF7O75W',
//            'cookieValidationKey' => md5('asdFw42Q'),
//        ],
        
        'request' => [
            'enableCookieValidation' => false,
            'cookieValidationKey' => '',
        ],
        
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
/*        
        'formatter' => [
            'dateFormat'     => 'php:d-m-Y',
            'datetimeFormat' => 'php:d-m-Y в H:i:s',
            'timeFormat'     => 'php:H:i:s',
        ],
*/        
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        
        'urlManager' => [
            'enablePrettyUrl' => true,
//            'showScriptName' => false
//            'urlFormat'=>'path',
//            'rules'=>[
                // regular patterns
//                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
//                '<controller:\w+>/<id:\d+>'=>'<controller>/index',
//                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
//                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
//            ],                        
        ],
        
        'db' => $db,
                
    ],
    'params' => $params,
];




if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
