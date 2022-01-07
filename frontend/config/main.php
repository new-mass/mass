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
        'chat' => [
            'class' => 'frontend\modules\chat\Chat',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'enableCsrfValidation' => false,
        ],
        'imageCache' => [
            'class' => 'frontend\components\ImageCache',
            'sourcePath' => '@app/web/uploads',
            'sourceUrl' => '@web/uploads',
            'thumbsPath' => '@app/web/thumbs',
            'quality' => 75,
            'extensions' => [
                'jpg' => 'jpeg',
                'jpeg' => 'jpeg',
                'png' => 'png',
                'gif' => 'gif',
                'bmp' => 'bmp',
            ],
            'sizes' => [
                '255_335' => [255, 335],
                '290_327' => [290, 327],
                '210_327' => [210, 327],
                '105_200' => [105, 200],
                '61_61' => [61, 61],
                '350_524' => [350, 524],
                '290_435' => [290, 435],
                '330_494' => [330, 494],
                '510_764' => [510, 764],
                '509_636' => [509, 636],
            ],
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
                '<protocol>://<city:[a-z-0-9]+>.<domain>/site/auth' => 'site/auth',
                'thumbs/<path:.*>' => 'site/thumb',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/' => 'site/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/page-<page:[0-9]+>' => 'site/redirect',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/new-post' => 'site/new-post',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/new' => 'site/new-post',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/view/count' => 'view/get-count',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/prosmotreno' => 'view/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/phone' => 'site/phone',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/get-more-post-list' => 'site/get-more-post',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/get-photo' => 'photo/get-photo',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/search' => 'site/search',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/anketa/<url:[a-z-0-9]+>' => 'user/post/view',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/<url:user-[a-z-0-9]+>' => 'user/post/redirect',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/getrecom' => 'user/post/more-post',

                '<protocol>://<city:[a-z-0-9]+>.<domain>/filter' => 'find/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/comment/add' => 'comment/add',

                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet/history' => 'user/hystory/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet' => 'user/cabinet/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet/add' => 'user/cabinet/add',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet/faq' => 'user/cabinet/faq',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet/edit/<id:[0-9]+>' => 'user/cabinet/edit',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet/update-avatar' => 'user/cabinet/update-avatar',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet/up' => 'user/cabinet/up',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet/delete-photo' => 'user/cabinet/delete',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet/logout' => 'user/user/logout',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet/call' => 'user/call/index',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/user/publication/update' => 'user/post/publication',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet/login' => 'user/user/login',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet/pay' => 'user/cash/balance',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet/comment/hide' => 'user/comment/hide',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet/comment/show' => 'user/comment/show',

                '<protocol>://<city:[a-z-0-9]+>.<domain>/call/add' => 'call/add',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/call/get' => 'call/get',

                '<protocol>://<city:[a-z-0-9]+>.<domain>/pay' => 'user/cash/pay',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cpay.php' => 'user/cash/pay',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/claim/add' => 'claim/add',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/claim/post/get-modal' => 'claim/get-anket-modal',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/claim/post/add' => 'claim/claim-anket',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/get-claim-modal' => 'site/get-claim-modal',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/cabinet/register' => 'user/user/register',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/sitemap.xml' => 'site/map',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/robots.txt' => 'site/robot',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/<param:[a-z-0-9_]+>/page-<page:[0-9]+>' => 'site/redirect',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/<param:([a-z-0-9_]+/)[a-z-0-9_]+>' => 'site/filter',
                '<protocol>://<city:[a-z-0-9]+>.<domain>/<param:[a-z-0-9_]+>' => 'site/filter',

            ],
        ],

    ],
    'params' => $params,
];
