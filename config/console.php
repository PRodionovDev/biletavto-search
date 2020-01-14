<?php

/**
 * Connect database's configuration
 *
 */
$db = require(__DIR__ . '/db.php');

return [

    /**
     * An ID that uniquely identifies this module among other modules
     *
     */
    'id' => 'biletavto-search-console',

    /**
     * The root directory of the module
     *
     */
    'basePath' => dirname(__DIR__),

    /**
     * List of path aliases to be defined
     *
     */
    'aliases' => [
        '@application' => dirname(__DIR__) . '/src'
    ],

    /**
     * The namespace that controller classes are in. This namespace will be used to load controller classes by prepending it to the controller class name
     *
     */
    'controllerNamespace' => 'app\console',

    /**
     * The list of the component definitions or the loaded component instances (ID => definition or instance)
     *
     */
    'components' => [

        /**
         * Database component
         *
         */
        'db' => $db
    ]
];
