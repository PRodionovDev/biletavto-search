<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use application\services\SeoService;

$service = new SeoService();

if (empty($ridelist)) {
    $this->title = 'Билеты на автобус: расписание, цены';
    $this->registerMetaTag(['name' => 'description', 'content' => $service->getDescription()]);
} else {
    $this->title = 'Расписание и билеты на автобус '. $model["departure"] . ' - ' . $model["arrival"] . ' ' . date("Y") . ' / Купить по цене от ' . $ridelist[0]->price . ' руб., заказать онлайн на портале biletavto.ru';
    $this->registerMetaTag(['name' => 'description', 'content' => $service->getDescription($ridelist)]);
}
?>
<div class="site-index">

    <?= $this->render('search', [
        'model' => $model,
    ]) ?>

    <div class="container">
        <?php if (!empty($ridelist)) : ?>
            <div class="jumbotron">
               <h1 class="h3 text-center">Расписание и билеты на автобус <?= $model["departure"] ?> — <?= $model["arrival"] ?>  <?= date("Y", strtotime($model["date"])) ?> г.</h1>
               <div id="count-visor" class="count-visor"></div>
            </div>
            <p class="text-right search-date">Выбрано: <b><?php echo $model["date"] ?></b></p>
            <?php if (!empty($notification)):?>
               <div class="alert alert-success"><b>Внимание! </b><?= $notification ?></div>
            <?php endif; ?>
        <?php elseif (!empty($model["departure"]) || !empty($model["arrival"]) || !empty($model["date"])) : ?>
            <div class="jumbotron">
                <h3 class="pb-5">Расписание автобусов по маршруту г. <?= $model["departure"] ?> - г. <?= $model["arrival"] ?> на <?= $model["date"] ?></h3>
                <div class="container shadow-block ridelist">
                    <h3 class="pt-3">Сейчас в нашей системе нет рейсов по вашему запросу.</h3>
                    <div class="m-5">
                        <p>Рекомендации:</p>
                        <p>1. Убедитесь, что все населенные пункты написаны <b>без ошибок</b>.</p>
                        <p>2. Попробуйте использовать <b>другую дату</b>.</p>
                        <p>3. Попробуйте использовать <b>другие станции</b> которые находятся рядом.</p>
                        <p>4. Возможно автовокзал или перевозчики на Вашем маршруте ещё не подключены. Возможно, он скоро появится. Чтобы узнать информацию по данному рейсу, свяжитесь с автовокзалом. Телефоны автовокзалов Вы можете найти по <a href="https://biletavto.ru/telefony-avtovokzalov/">ссылке</a>.</p>
                        <p>5. Вы можете найти поездку с попутчиком по данному маршруту на сайте <a href="https://pocatili.ru">Pocatili</a>.</p>
                        <a href="https://pocatili.ru"><img width="100%" src="/img/pocatili.png"></a>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <?= $this->render('seo') ?>
        <?php endif; ?>

        <?php if (!empty($ridelist)) : ?>
            <?= $this->render('ridelist', [
                'ridelist' => $ridelist
            ]) ?>
        <?php endif; ?>

        <div class="col-md-12 shadow-block no_mobile">
            <div class="row">
                <?php if (!empty($routelist)):?>
                    <?php foreach ($routelist as $route): ?>
                        <div class="col-md-4">
                            <a href="/search/?departure=<?= $route["start"]?>&arrival=<?= $route["end"]?>&date=<?= date('d.m.Y') ?>"><?= $route["start"] ?> - <?= $route["end"]?></a>
                        </div>
                    <?php endforeach;?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var departure = $("#departure").val();
    var arrival = $("#arrival").val();
    var date = $("#date").val();

    /**
     * В отличии от статичных рейсов, которых может не быть,
     * но они отдают 200-ответ сервера, в метрику должен
     * уходить 404 ответ при отсутствии рейсов, для получения
     * более точной статистики.
     */
    var status = <?= (empty($ridelist)) ? 404 : Yii::$app->response->statusCode ?>;
    var csrfToken = $('meta[name="csrf-token"]').attr("content");

    $.ajax({
        type : 'POST',
        url : '/search-statistic/',
        data : {
            departure: departure,
            arrival: arrival,
            date: date,
            status: status,
            _csrf: csrfToken
        }
    }).done(function(data) {
        if (data.error == null) {
            console.log("Успешно");
        } else {
            console.log("ошибка сервера");
        }
    }).fail(function() {
        console.log("ошибка запроса метрики");
    })
</script>
