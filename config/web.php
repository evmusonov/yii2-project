<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'app',
	'name' => 'Молочная азбука',
	'language' => 'ru-RU',
	'defaultRoute' => 'main/default/index', // Default controller
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'slider', 'minislider', 'category', 'article', 'product', 'infoblock', 'client', 'shopcity', 'shoplist'],
	'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
	'modules' => [
        'main' => [
            'class' => 'app\modules\main\Module',
        ],
		'user' => [
            'class' => 'app\modules\user\Module',
        ],
		'infoblock' => [
            'class' => 'app\modules\infoblock\Module',
        ],
		'menu' => [
            'class' => 'app\modules\menu\Module',
        ],
		'page' => [
            'class' => 'app\modules\page\Module',
        ],
		'article' => [
            'class' => 'app\modules\article\Module',
        ],
		'team' => [
            'class' => 'app\modules\team\Module',
        ],
		'portfolio' => [
            'class' => 'app\modules\portfolio\Module',
        ],
		'service' => [
            'class' => 'app\modules\service\Module',
        ],
		'client' => [
            'class' => 'app\modules\client\Module',
        ],
		'review' => [
            'class' => 'app\modules\review\Module',
        ],
		'seo' => [
            'class' => 'app\modules\seo\Module',
        ],
		'file' => [
            'class' => 'app\modules\file\Module',
        ],
		'gridview' =>  [
			'class' => '\kartik\grid\Module',
		],
		'filter' =>  [
			'class' => 'app\modules\filter\Module',
		],
		'subcontent' =>  [
			'class' => 'app\modules\subcontent\Module',
		],
		'slider' =>  [
			'class' => 'app\modules\slider\Module',
		],
		'minislider' =>  [
			'class' => 'app\modules\minislider\Module',
		],
		'category' =>  [
			'class' => 'app\modules\category\Module',
		],
		'product' =>  [
			'class' => 'app\modules\product\Module',
		],
		'company' =>  [
			'class' => 'app\modules\company\Module',
		],
		'vacancy' =>  [
			'class' => 'app\modules\vacancy\Module',
		],
		'shopcity' =>  [
			'class' => 'app\modules\shopcity\Module',
		],
		'shoplist' =>  [
			'class' => 'app\modules\shoplist\Module',
		],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '4Lkqb6y7ZPz18WN1JDieAGCFQVtELqhq',
	        'baseUrl' => ''
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
			'loginUrl' => ['user/default/login'], // Login action
        ],
        'errorHandler' => [
            'errorAction' => 'frontend/error', // Error action
        ],
		'formatter' => [
			'datetimeFormat' => 'dd.MM.yyyy H:i',
			'dateFormat' => 'dd.MM.yyyy',
			'timeFormat' => 'H:i',
			'decimalSeparator' => ',',
			'thousandSeparator' => ' ',
			'currencyCode' => 'RU',
		],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
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
        'db' => require(__DIR__ . '/db.php'),
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
				
				// Главная страница сайта
				'' => 'main/default/index',

	            'contacts' => 'main/default/contact',
				
				// Переадресация на сайты клиентов (ссылки закрытые от индексации)
				'go' => 'main/default/go',
				
				// Главная страница админки
				'admin' => 'main/backend/default/index',
				
				// общие для всех модулей операции в админке
				'preadmin/<_a>' => '/backend/<_a>',
				
				// Навигация в админке
				'admin/<_m:[\w\-]+>' => '<_m>/backend/default/index',
				'admin/<_m:[\w\-]+>/setting' => '<_m>/backend/setting/index',
				
				// Активация импорта материалов в базу данных (например их xml)
				'admin/<_m:[\w\-]+>/import' => '<_m>/backend/import/index',
				
				'admin/<_m:[\w\-]+>/<_a:[\w-]+>' => '<_m>/backend/default/<_a>',
				'admin/<_m:[\w\-]+>/setting/<_a:[\w-]+>' => '<_m>/backend/setting/<_a>',
				
				'admin/<_m:[\w\-]+>/<_a:[\w-]+>/<id:\d+>' => '<_m>/backend/default/<_a>',
				'admin/<_m:[\w\-]+>/setting/<_a:[\w-]+>/<id:\d+>' => '<_m>/backend/setting/<_a>',
				
				// Навигация в админке
				//'admin/<_m:[\w\-]+>' => '<_m>/backend/default/index',
				//'admin/<_m:[\w\-]+>/<_a:[\w-]+>' => '<_m>/backend/default/<_a>',
				//'admin/<_m:[\w\-]+>/<_a:[\w-]+>/<id:\d+>' => '<_m>/backend/default/<_a>',
				
				// Страница ошибок
                '<_a:error>' => 'frontend/<_a>',
				
				// Авторизация, Регистрация и прочие действия с пользователями
                'user/<_a:[\w\-]+>' => 'user/default/<_a>',
				
				// Статьи Article
				'articles' => 'article/default/index',
				'articles/<alias:[\w\-]+>' => 'article/default/view',

				// Акции Action
				'actions' => 'action/default/index',
				'actions/<alias:[\w\-]+>' => 'action/default/view',
				
				
				// Команда Team
				'team' => 'team/default/index',
				'team/<alias:[\w\-]+>' => 'team/default/view',
				
				// Кейсы Portfolio
				'cases' => 'portfolio/default/index',
				
				// Портфолио Portfolio
				'portfolio' => 'portfolio/default/index',
				'portfolio/<alias:[\w\-]+>' => 'portfolio/default/view',
				
				// Клиенты Client
				'clients' => 'client/default/index',
				'clients/<alias:[\w\-]+>' => 'client/default/view',
				
				// Отзывы Review
				'reviews' => 'review/default/index',
				'reviews/<alias:[\w\-]+>' => 'review/default/view',
				
				// Услуги Service
				'services' => 'service/default/index',
				'services/<alias:[\w\-]+>' => 'service/default/view',

	            // Услуги Service
	            'vacancies' => 'vacancy/default/index',
	            'vacancy/<alias:[\w\-]+>' => 'vacancy/default/view',

	            'products' => 'product/default/index',
	            'products/<alias:[\w\-]+>' => 'product/default/view',

	            // Акции Action
	            'shops' => 'shoplist/default/index',

	            'company' => 'company/default/index',

	            // Акции Action
	            'category/<alias:[\w\-]+>' => 'category/default/view',

				// Страницы Page
				'page/<alias:[\w\-]+>' => 'page/default/index',
				
				// Правила по умолчанию
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<_a:[\w-]+>' => '<_m>/<_c>/<_a>',
				'<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_m>/<_c>/<_a>',
				'<_m:[\w\-]+>' => '<_m>/default/index',
				'<_m:[\w\-]+>/<_c:[\w\-]+>' => '<_m>/<_c>/index',
            ],
        ],
		/* 'authManager' => [
            'class' => 'app\modules\user\components\AuthManager',
        ], */
		/***************************** Настройка Ресурсов Assets ******************************************/
		'assetManager' => [
			'linkAssets' => false, // Использование символических ссылок вместо копирования файлов в веб директорию /assets (не все серверы позволяют это сделать)
            'appendTimestamp' => true, // Добавление временной метки в путь до файла для актуализации подгружаемых файлов всвязи с HTTP кэшированием
			'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,   // не опубликовывать встроенный по умолчанию комплект
                    'js' => [
                        'libs/jquery/dist/jquery.min.js',
                    ],
					'jsOptions' => ['position' => \yii\web\View::POS_END], // подключить файл в области HEAD POS_HEAD
                ],
            ],
        ],
		/***************************** /Настройка Ресурсов Assets ****************************************/
		'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'forceTranslation' => true, // Принудительный перевод при использовании идентификаторов,
					// в противном случае, если используется язык по умолчанию перевод осуществляться не будет
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];
	
	$config['modules']['debug']['allowedIPs'] = ['*']; // Доступ по IP адресу "*" - означает все адреса разрешены

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
