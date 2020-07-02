<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use application\assets\AppAsset;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <link rel="canonical" href="/search?departure=<?= Yii::$app->request->get('departure'); ?>&arrival=<?= Yii::$app->request->get('arrival'); ?>" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <script src="/js/jquery-3.3.1.min.js"></script>
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>

<div class="wrap">
    <section id="navbar">
        <nav class="navbar navbar-expand-lg ba-navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="https://biletavto.ru"><img src="/img/logo.png" alt="Билетавто"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-block" aria-controls="navbar-block" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="glyphicon glyphicon-th-list"></span>
                </button>
                <div class="collapse navbar-collapse navbar-right navbar-menu" id="navbar-block">
                    <ul class="navbar-nav nav">
                        <li><a href="/"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Расписание</a></li>
                        <li><a href="https://biletavto.ru/telefony-avtovokzalov/" target="_blank"><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> Телефоны автовокзалов</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-headphones" aria-hidden="true"></span> Служба поддержки</a>
                            <ul class="dropdown-menu">
                                <li><a href="https://biletavto.ru/faq/" target="_blank"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Вопросы и ответы</a></li>
                                <hr>
                                <li class="phone"><a href="tel:88002004401"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> 8 (800) 200-44-01</a></li>
                                <hr>
                                <li class="phone"><a href="mailto:info@biletavto.ru"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> info@biletavto.ru</a></li>
                            </ul>
                        </li>
                        <li><a href="https://biletavto.ru/auth/"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Личный кабинет</a></li>
                    </ul>
                </div> 
            </div>
        </nav>
    </section>

    <div>
        <?= $content ?>
    </div>
</div>

<section id="footer">
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <p>Расписание</p>
                    <ul>
                        <li><a href="/">Расписание</a></li>
                        <li><a href="https://biletavto.ru/raspisanie-marshrutok/" target="_blank">Расписание маршруток</a></li>
                        <li><a href="https://biletavto.ru/raspisanie-prigorodnyx-marshrutov/" target="_blank">Расписание пригородных маршрутов</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <p>Информация</p>
                    <ul>
                        <li><a href="https://biletavto.ru/news/" target="_blank">Новости и акции</a></li>
                        <li><a href="https://biletavto.ru/vozvrat-bileta-na-avtobus/" target="_blank">Возврат билета</a></li>
                        <li><a href="https://biletavto.ru/faq/" target="_blank">Вопросы и ответы</a></li>
                        <li><a href="https://biletavto.ru/contacts/" target="_blank">Контакты</a></li>
                        <li><a href="https://biletavto.ru/telefony-avtovokzalov/" target="_blank">Телефоны автовокзалов</a></li>
                        <li><a href="https://biletavto.ru/insurance/" target="_blank">Поиск полисов</a></li>
                        <li><a href="https://biletavto.ru/agents/" target="_blank">Партнерам</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <p>Документы</p>
                    <ul>
                        <li><a href="https://biletavto.ru/soglashenie-publichnoj-ofertyi/" target="_blank">Договор оферты</a></li>
                        <li><a href="https://biletavto.ru/policy/" target="_blank">Политика конфиденциальности</a></li>
                    </ul>
                </div>
                <div class="col-md-5 offset-md-1">
                    <p>Мы в соцсетях</p>
                    <div class="social">
                        <a href="https://vk.com/biletavto" target="_blank"><img src="/img/social/vk.svg"></a>
                        <a href="https://www.instagram.com/biletavto/" target="_blank"><img src="/img/social/instagram.svg"></a>
                        <a href="https://www.facebook.com/biletavto" target="_blank"><img src="/img/social/fb.svg"></a>
                        <a href="https://ok.ru/biletavto" target="_blank"><img src="/img/social/ok.svg"></a>
                        <a href="http://telegram.me/biletavtobot" target="_blank"><img src="/img/social/telegram.svg"></a>
                    </div>
                    </ul>
                    <p>Контакты</p>
                    <ul class="contact-right">
                        <li>ОГРН 1130327002960 ООО «Антариз»</li>
                        <li>ИНН/КПП 0326511681 / 032601001</li>
                        <li>Адрес для почтовых отправлений: 670002, г. Улан-Удэ, ул. Буйко 20а, офис 3</li>
                        <li>Телефон: 8 (800) 200-44-01 (с 4ч. до 16ч., ежедневно по Московскому времени)</li>
                        <li>107207, г. Москва, Щёлковское ш., 75</li>
                        <li>E-mail: info@biletavto.ru</li>
                    </ul>
                </div>
            </div>
            <div class="text-justify small-text">
                <hr>
                <small>Мы используем информацию, зарегистрированную в файлах «cookies», в частности, в рекламных и статистических целях, а также для того, чтобы адаптировать наши сайты к индивидуальным потребностям Пользователей. Вы можете изменить настройки касающиеся «cookies» в вашем браузере. Изменение настроек может ограничить функциональность сайта.</small>
                <hr>
                <small>biletavto.ru © 2014-<?= date('Y') ?> Сайт заказа билетов на автобус. Все права защищены.</small>
            </div>
        </div>
    </div>
</section>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
