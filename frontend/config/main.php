<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'language' => 'ru-RU',
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'user' => [
            'class' => 'frontend\modules\user\User',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'enableCsrfValidation' => false,
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

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                //  => 'product/index'
                '<protocol>://<city:[a-z-0-9]+>.<domain>/' => 'site/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/view/count' => 'view/get-count',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/prosmotreno' => 'view/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/phone' => 'site/phone',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/get-more-post-list' => 'site/get-more-post',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/get-photo' => 'photo/get-photo',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/search' => 'site/search',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/anketa/<url:[a-z-0-9]+>' => 'user/post/view',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/<url:user-[a-z-0-9]+>' => 'user/post/redirect',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/getrecom' => 'user/post/more-post',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet/history' => 'user/hystory/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet' => 'user/cabinet/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet/add' => 'user/cabinet/add',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet/faq' => 'user/cabinet/faq',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet/edit/<id:[0-9]+>' => 'user/cabinet/edit',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet/up' => 'user/cabinet/up',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/publication/update' => 'user/post/publication',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet/login' => 'user/user/login',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet/pay' => 'user/cash/balance',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/pay' => 'user/cash/pay',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/claim/add' => 'claim/add',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet/register' => 'user/user/register',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/<param:[a-z-0-9_]+>' => 'site/filter',
            ],
        ],

    ],
    'params' => $params,
];
