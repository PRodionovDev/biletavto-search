<p align="center">
    <h1 align="center">Biletavto-search</h1>
    <h2 align="center">Модуль поиска рейсов системы Biletavto</h2>
    <h3 align="center">Часть глобальной системы Biletavto</h3>
    <br>
</p>

ОПИСАНИЕ ПРИЛОЖЕНИЯ
-------------------

Поисковой модуль для глобальной системы Biletavto.
Данный модуль реализует сервис поиска рейсов, для которых доступна покупка билетов онлайн в системе "Билетавто".

Модуль разработан с использованием Yii2 PHP Framework

УСТАНОВКА
-------------------

1. Выполнить git clone в консоле:
  ~~~
    $ git clone https://github.com/JOKER-THE/biletavto-search.git
  ~~~

2. Используя composer, собрать autoload и загрузить подключаемые библиотеки:
  ~~~
    $ composer install
  ~~~

3. Редактируем файл `config/db.example.php` и сохраняем его под именем `config/db.php`:

```php
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
```

4. Редактируем файл `config/param.example.php` и сохраняем его под именем `params.php` :

```php
return [
    'avtovokzalonline_url' => 'api_url/api_version/route/search',
    'biletavto_url' => 'api_url/api_version/route/search',
    'unitiki_url' => 'api_url/api_version/route/search',
    'auth_url' => 'api_url/token',
    'username' => '',
    'password' => ''
];

```

5. Выполняем миграцию таблицы уведомлений для рейсов:
  ~~~
    $ php yii migrate
  ~~~

6. Комментируем во входном скрипте `public_html/index.php`, отвечающие за debug и режим разработки
```php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
```

СТРУКТУРА ПРИЛОЖЕНИЯ
-------------------

      --config/                   Конфигурация приложения
      --migrations/               Файлы миграции в базу данных
      --public_html/              Публичный каталог приложения
        --css/                    CSS-стили
        --fonts/                  Шрифты
        --img/                    Системные изображения
        --js/                     JS-скрипты
        --index.php               Входной файл
      --src/                      Каталог API-приложения
        --assets/                 Пакеты ресурсов
        --components/             Компоненты
          --Token.php             Авторизация по токену
        --controllers/            Контроллеры приложения
        --models/                 Модели приложения
          --forms/                Формы
        --repositories/           Классы для работы с базой данных
        --services/               Сервисные классы
        --views/                  Виды приложения
      --README.md
