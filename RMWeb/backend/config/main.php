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
    'bootstrap' => ['log'],
    'modules' => [
        'api' => [
            'class' => 'backend\modules\api\ModuleAPI',
        ],
    ],
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    'backen\views' => '@vendor/hail812/yii2-adminlte3/src/views'
                ],
            ],
        ],

        'request' => [
            'csrfParam' => '_csrf-backend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'acceptableContentTypes' => [
                'application/json' => 1,
            ],

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
                    'class' => \yii\log\FileTarget::class,
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
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/restaurant'
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/menu'
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/review',
                    'extraPatterns' => [
                        'POST create' => 'create',
                        'PUT edit/{id}' => 'edit'
                    ],
                    'tokens' =>[
                        '{id}' => '<id:\\d+>'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/zone',
                    'extraPatterns' => [
                        'GET zonesbyrest/{id}' => 'zonesbyrest'
                    ],
                    'tokens' =>[
                        '{id}' => '<id:\\d+>'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/table'//,
                    // 'extraPatterns' => [
                    //     'GET {id}' => 'tablesbyzone'
                    //],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/order',
                    'extraPatterns' => [
                        'GET index' => 'index',
                        'POST create' => 'create',
                        'PUT updateprice/{id}' => 'updateprice'
                    ],
                    'tokens' =>[
                        '{id}' => '<id:\\d+>'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/orderedmenu',
                    'extraPatterns' => [
                        'GET index' => 'index',
                        'POST create' => 'create'
                    ],
                    'tokens' =>[
                        '{id}' => '<id:\\d+>'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/user',
                    'extraPatterns' => [
                        'POST userbytoken' => 'userbytoken',
                        'POST login' => 'login',
                        'POST signup' => 'signup',
                        'PUT edit/{id}' => 'edit'
                    ],
                    'tokens' =>[
                        '{id}' => '<id:\\d+>'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/reservation',
                    'extraPatterns' => [
                        'GET index' => 'index',
                        'POST create' => 'create'
                    ],
                ],
            ],
        ],

    ],
    'params' => $params,
];
