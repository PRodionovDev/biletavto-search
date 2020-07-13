<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Расписание автобусов из ' . $model->departure . ', стоимость билетов. Купить онлайн билет на автобус';
$this->registerMetaTag(['name' => 'description', 'content' => 'Полное расписание автобусов из города ' . $model->departure . ', лучшие цены. Вы можете приобрести билет онлайн']);
?>
<div class="site-index">

    <?= $this->render('search', [
        'model' => $model,
    ]) ?>

    <div class="container">
        <div class="jumbotron">
            <h1 class="h3 text-center">Расписание и билеты на автобус из <?= $model["departure"] ?></h1>
            <?php if (!empty($routelist)) : ?>
                <p class="count-visor">На данной странице Вы можете найти перечень маршрутов из города <?= $model["departure"] ?> в: <?= $endStation ?>. </p>
                <div class="col-md-12 shadow-block" style="padding-bottom: 20px;">
                    <div class="row">
                        <?php foreach ($routelist as $route): ?>
                            <div class="col-md-4">
                                <a href="/search/?departure=<?= $route["start"]?>&arrival=<?= $route["end"]?>&date=<?= date('d.m.Y') ?>"><?= $route["start"] ?> - <?= $route["end"]?></a>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>
            <?php else : ?>
                <p class="count-visor">Для того чтобы найти все доступные рейсы из города <?= $model["departure"] ?>, вам необходимо выбрать точку, куда вы хотите поехать, дату отправления и нажать кнопку "найти маршрут"</p>
            <?php endif; ?>
        </div>
    </div>
</div>
