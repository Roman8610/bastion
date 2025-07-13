<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'ru-RU',
    'layout' => 'bastion',
    'defaultRoute' => 'main/index',
    'modules' => [ 
        'admin' => [ 
            'class' => 'app\modules\admin\Module',
            'layout' => 'admin.php',
            'defaultRoute' => 'main/index',
        ],
    ],
    'components' => [
	
		'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                if ($response->format === \yii\web\Response::FORMAT_HTML) {
                    $response->data = \app\helpers\WebpHelper::replaceImagesWithWebp($response->data);
                }
            },
        ],

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'z3T5BFZs0BqRp7odzJ5RL53d24uj8raq',
            'baseUrl' => '',
        ],
        'cache' => [
            //'class' => 'yii\caching\FileCache',
            'class' => 'yii\redis\Cache',
            'redis' => [
                'hostname' => '212.67.12.21', // Адрес сервера Redis
                'port' => 8082,           // Порт сервера Redis
                'database' => 0,          // Номер базы данных Redis
            ],
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => '/admin/auth/login',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => false,
            'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => 'smtp.yandex.ru',  
                    'username' => 'zakazbastionit',
                    'password' => 'yqhoqwgojyrncuob',
                    'port' => '465', 
                    'encryption' => 'SSL', 
                    'scheme' => 'smtp',
                            ],
                
        ],

        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                '' => 'main/index',
                'catalog/<alias:[a-z0-9-]+>' => 'catalog/index',
                'product/<alias:[a-z0-9-]+>' => 'product/index',
                'pages/<alias:[a-z0-9-]+>' => 'pages/view',
				'sitemap' => 'sitemap/index',
            ],
        ],
       
    ],

    'controllerMap' => [
        'elfinder' => [
			'class' => 'mihaildev\elfinder\PathController',
			'access' => ['@'],
			'root' => [
				'path' => 'images/news',
				'name' => 'Images'
			],
		]
    ],

    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['95.24.217.173', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['95.24.217.173', '::1'],
    ];
}

return $config;
