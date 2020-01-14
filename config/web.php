<?php

/**
 * Connect database's configuration
 *
 */
$db = require(__DIR__ . '/db.php');

/**
 * Connect parameters
 *
 */
$params = require(__DIR__ . '/params.php');

return [

	/**
	 * An ID that uniquely identifies this module among other modules
	 *
	 */
    'id' => 'biletavto-search',

    /**
	 * List of path aliases to be defined
	 *
	 */
    'aliases' => [
        '@application' => dirname(__DIR__) . '/src',
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset'
    ],

    /**
	 * The root directory of the module
	 *
	 */
    'basePath' => dirname(__DIR__),

    /**
	 * The namespace that controller classes are in. This namespace will be used to load controller classes by prepending it to the controller class name
	 *
	 */
    'controllerNamespace' => 'application\controllers',

    /**
	 * The default route of this module
	 *
	 */
    'defaultRoute' => 'search',

    /**
	 * The list of the component definitions or the loaded component instances (ID => definition or instance)
	 *
	 */
    'components' => [

        /**
         * Database component
         *
         */
        'db' => $db,

    	/**
    	 * Request
    	 *
    	 */
    	'request' => [
            'cookieValidationKey' => 'n_b41gjXn9yfZLmWGyjs9l8UUnHuh5TX',
        ],

        /**
         * Url-manager component
         *
         */
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<departure>/<arrival>/<date>' => 'search/index',
                '<departure>/<arrival>' => 'search/index',
                '<action>' => 'search/<action>'
            ]
        ],

    	/**
    	 * View's component
    	 *
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
     * Parameters
     *
     */
    'params' => $params
];
