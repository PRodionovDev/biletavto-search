<?php

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
        '@application' => dirname(__DIR__) . '/src'
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
    'defaultRoute' => 'search'
];
