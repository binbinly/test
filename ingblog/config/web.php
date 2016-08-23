<?php

$params = require(__DIR__ . '/params.php');
$modules = require(__DIR__.'/modules.php');
$config = [
    'id' => 'index',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'index',
    'language'=>'zh_cn',
    'aliases' => [
        '@lib' => '@vendor/library',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'ingblogabcd',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'thumb' => [
            'class' => 'lib\Thumb',
        ],
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
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
            'useFileTransport' => false,//发送出去，true保存在本地
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.qq.com',
                'username' => '784853640',
                'password' => 'tanbin19910202',
                'port' => '587',
                'encryption' => 'ssl',
            ],
            'messageConfig'=>[
                'charset'=>'UTF-8',
                'from'=>['422396350@qq.com' => '常岳']
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
        'view' => [
            //指定主题后，就会后相应的主题文件夹下面找相应的view。因为可以指定多个主题，所以主题的配置顺序是从上往下的。
            //在当前的主题文件夹下面找不到相应的view的时候 就会去第二个主题文件夹里面找。
            'theme' => [
                'pathMap' => [
                    '@app/views'=>'@app/themes/default/',
                    '@app/modules' => '@app/themes/default/modules',
                    '@app/modules/user/views' => '@app/themes/default/modules/user',
                    '@app/modules/post/views' => '@app/themes/default/modules/post',
                    '@app/modules/system/views' => '@app/themes/default/modules/system',
                    '@app/modules/other/views' => '@app/themes/default/modules/other',
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'user' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/modules/user/messages',
                ],
                'post' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/modules/post/messages',
                ],
                'system' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/modules/system/messages',
                ],
            ],
        ],
        //路由配置
        'urlManager' => [
            //用于URL路径化
            'enablePrettyUrl' => true,
            //'suffix'=>'.html',
            //指定是否在URL在保留入口脚本 index.php,同时还要在index.php同级目录下新建.htaccess文件
            'showScriptName' => false,
            'rules' => require(__DIR__.'/rules.php'),
        ],
        'db' => require(__DIR__ . '/db.php'),
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
    'modules' => $modules,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
