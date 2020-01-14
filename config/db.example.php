<?php

/**
 * The host for establishing DB connection
 *
 */
define('HOST', '127.0.0.1');

/**
 * The tablename for establishing DB connection
 *
 */
define('DATABASE', 'db_biletavto_api');

/**
 * The username for establishing DB connection
 *
 */
define('USERNAME', 'root');

/**
 * The password for establishing DB connection
 *
 */
define('PASSWORD', '');

/**
 * The charset used for database connection
 *
 */
define('CHARSET', 'utf8');

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=' . HOST . ';dbname=' . DATABASE,
    'username' => USERNAME,
    'password' => PASSWORD,
    'charset' => CHARSET
];
