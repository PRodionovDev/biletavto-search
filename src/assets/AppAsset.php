<?php

namespace application\assets;

use yii\web\AssetBundle;

/**
 * Asset bundle приложения.
 *
 * Используется для подключения стилей и скриптов,
 * выполняемых на клиенте.
 */
class AppAsset extends AssetBundle
{
    /**
     * Путь к asset'ам.
     */
    public $basePath = '@webroot';

    /**
     * Url к asset'ам.
     */
    public $baseUrl = '@web';

    /**
     * CSS стили.
     */
    public $css = [
        'css/glyphicon.css',
        'css/style.css',
        'css/jquery.kladr.min.css'
    ];

    /**
     * Скрипты Javascript.
     */
    public $js = [
        'js/bootstrap.min.js',
        'js/search.script.js',
        'js/jquery.kladr.min.js',
        'js/kladr.city.js'
    ];

    /**
     * Зависимости.
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset'
    ];
}
