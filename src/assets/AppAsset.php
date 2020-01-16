<?php

namespace application\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 */
class AppAsset extends AssetBundle
{
    /**
     * Base Path
     *
     */
    public $basePath = '@webroot';

    /**
     * Base Url
     *
     */
    public $baseUrl = '@web';

    /**
     * Styles
     *
     */
    public $css = [
        'css/glyphicon.css',
        'css/style.css',
        'css/jquery.kladr.min.css'
    ];

    /**
     * Scripts
     *
     */
    public $js = [
        'js/bootstrap.min.js',
        'js/search.script.js',
        'js/jquery.kladr.min.js',
        'js/kladr.city.js'
    ];

    /**
     * Depends
     *
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset'
    ];
}
