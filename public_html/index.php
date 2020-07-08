<?php

/**
 * Установка тестового окружения. Перед деплоем на прод
 * эти две строки необходимо закомментировать.
 */
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

/**
 * Подключение autoload и ядра фреймворка Yii2.
 */
require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

/**
 * Подключение конфигурации web-приложения.
 */
$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
