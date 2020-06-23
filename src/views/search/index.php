<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Билеты на автобус: расписание, цены';
?>
<div class="site-index">

    <?= $this->render('search', [
        'model' => $model,
    ]) ?>

    <div class="container">
        <?php if (!empty($ridelist)) : ?>
            <div class="jumbotron">
               <h3>Маршрут из г. <?= $model["departure"] ?> в г. <?= $model["arrival"] ?> на <?= $model["date"] ?></h3>
               <div id="count-visor" class="count-visor"></div>
            </div>
            <?php if (!empty($notification)):?>
               <div class="alert alert-success"><b>Внимание! </b><?= $notification ?></div>
            <?php endif; ?>
        <?php elseif (!empty($model["departure"]) || !empty($model["arrival"]) || !empty($model["date"])) : ?>
            <div class="jumbotron">
                <h3>К сожалению, маршруты из г. <?= $model["departure"] ?> в г. <?= $model["arrival"] ?> на <?= $model["date"] ?> в системе не найдены. Мы делаем всё возможное, чтобы подключить как можно больше маршрутов. Возможно, он скоро появится. Чтобы узнать информацию по данному рейсу, свяжитесь с автовокзалом. Телефоны автовокзалов Вы можете найти по <a href="/">ссылке</a>.</h3>
            </div>
        <?php else : ?>
            <?= $this->render('seo') ?>
        <?php endif; ?>

        <?php if (!empty($ridelist)) : ?>
            <?= $this->render('ridelist', [
                'ridelist' => $ridelist
            ]) ?>
        <?php endif; ?>

        <div class="col-md-12 shadow-block">
            <div class="row">
                <?php if (!empty($routelist)):?>
                    <?php foreach ($routelist as $route): ?>
                        <div class="col-md-4">
                            <a href="/search?departure=<?= $route["start"]?>&arrival=<?= $route["end"]?>&date=<?= date('d.m.Y') ?>"><?= $route["start"] ?> - <?= $route["end"]?></a>
                        </div>
                    <?php endforeach;?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function randomInteger(min, max) {
        let rand = min + Math.random() * (max + 1 - min);
        return Math.floor(rand);
    }
    var count = randomInteger(1, 7);
    count = count + ' пользователей просматривает эту страницу';
    var block = document.getElementById("count-visor");
    block.innerHTML = count;
</script>
