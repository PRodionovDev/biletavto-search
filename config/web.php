<?php

/**
 * Файл конфигурации web части Yii-приложения Biletavto-search.
 */
return [

    /**
     * Уникальный идентификатор консольного приложения.
     */
    'id' => 'biletavto-search',

    /**
     * Список путей допустимых аллиасов
     */
    'aliases' => [
        '@application' => dirname(__DIR__) . '/src',
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset'
    ],

    /**
     * Базовая директория проекта.
     */
    'basePath' => dirname(__DIR__),

    /**
     * Компоненты, вызываемые на этапе
     * начальной загрузки приложения.
     */
    'bootstrap' => [

        /**
         * Подключение логирования.
         */
        'log'
    ],

    /**
     * Пространство имен, в котором находятся классы контроллера.
     */
    'controllerNamespace' => 'application\controllers',

    /**
     * Имя базового контроллера приложения.
     */
    'defaultRoute' => 'search',

    /**
     * Список компонентов, необходимых для работы приложения.
     */
    'components' => [

        /**
         * Компонент кэширования.
         */
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        /**
         * Подключение конфигурации базы данных.
         */
        'db' => require(__DIR__ . '/db.php'),

        /**
         * Настройка компонента логирования.
         */
        'log' => [

            /**
             * Конфигурация сохранения стеков вызывов в лог.
             *
             * "YII_DEBUG ? 3 : 0" означает, что при включенном
             * режиме отладки, каждое сообщение лога будет содержать
             * до трех уровней стека вызовов.
             */
            'traceLevel' => YII_DEBUG ? 3 : 0,

            /**
             * Количество сообщений, после которых идет передача
             * в лог.
             */
            'flushInterval' => 10,

            /**
             * Цели логов.
             */
            'targets' => [
                [
                    /**
                     * Сохранение сообщений логов в файл.
                     */
                    'class' => 'yii\log\FileTarget',

                    /**
                     * Уровни логов текущей цели.
                     */
                    'levels' => ['info', 'error', 'warning'],

                    /**
                     * Категории логов текущей цели.
                     */
                    'categories' => ['search'],

                    /**
                     * Количество файлов с логами.
                     */
                    'maxLogFiles' => 20,

                    /**
                     * Отключение вывода информации в лог о типе запроса
                     * ($_GET, $_POST, $_SERVER и т.д.).
                     */
                    'logVars' => [],

                    /**
                     * Количество сообщений для выгрузки логов.
                     */
                    'exportInterval' => 10
                ]
            ]
        ],

        /**
         * Ключ валидации Cookie.
         */
        'request' => [
            'cookieValidationKey' => 'n_b41gjXn9yfZLmWGyjs9l8UUnHuh5TX',
        ],

        /**
         * Настройка компонента URL.
         */
        'urlManager' => [

            /**
             * Подключение человеко-понятных URL (ЧПУ).
             */
            'enablePrettyUrl' => true,

            /**
             * Отключение расширения скриптов в адресной строке.
             */
            'showScriptName' => false,

            /**
             * Добавление слэша в конце URL.
             */
            'suffix' => '/',

            /**
             * Правила разбора URL.
             */
            'rules' => [
                'search-statistic' => 'search/search-statistic',
                'search' => 'search/search',
                '<departure>/<arrival>/<date>' => 'search/index',
                '<departure>/<arrival>' => 'search/index',
                '<departure>' => 'search/city',
                '<action>' => 'search/<action>'
            ]
        ],

        /**
         * Настройка расположения View приложения.
         */
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@application/views'
                ]
            ]
        ]
    ],

    /**
     * Массив параметров приложения.
     */
    'params' => require(__DIR__ . '/params.php')
];
