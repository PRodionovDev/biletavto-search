<div class="col-lg-12 shadow-block">
    <div class="row">
        <div class="col-md-5">
            <p>Время и место отправления</p>
        </div>
        <div class="col-md-5">
            <p>Время и место прибытия</p>
        </div>
    </div>
</div>
<?php foreach ($ridelist as $key => $ride): ?>
    <div class="col-lg-12 shadow-block ridelist">
        <div class="row">
            <div class="col-md-1">
                <h2><?= $ride->departureTime ?></h2>
            </div>
            <div class="col-md-4">
                <p><b><?= $ride->departureCity ?></b></p>
                <p><?= $ride->departureStation ?></p>
            </div>
            <div class="col-md-1">
                <h2><?= $ride->arrivalTime ?></h2>
            </div>
            <div class="col-md-4">
                <p><b><?= $ride->arrivalCity ?></b></p>
                <p><?= $ride->arrivalStation ?></p>
            </div>
            <div class="col-md-2">
                <p><a class="btn btn-warning btn-block" href="<?= $ride->url ?>">Купить за <?= $ride->price ?> &#8381;</a></p>
                <p><a class="btn btn-outline-secondary btn-block" data-toggle="collapse" data-target="#more-info-<?= $key ?>">Подробнее</a></p>
            </div>
        </div>
            
        <div id="more-info-<?= $key ?>" class="col-md-12 collapse rideblock">
            <p><b>Маршрут:</b> <?= $ride->routeName?></p> 
            <p><b>Город отправления:</b> <?= $ride->departureCity?></p>
            <p><b>Станция отправления:</b> <?= $ride->departureStation?></p> 
            <p><b>Дата отправления:</b> <?= $ride->departureDate?></p> 
            <p><b>Время отправления:</b> <?= $ride->departureTime?></p> 
            <p><b>Город прибытия:</b> <?= $ride->arrivalCity?></p>
            <p><b>Станция прибытия:</b> <?= $ride->arrivalStation?></p> 
            <p><b>Дата прибытия:</b> <?= $ride->arrivalDate?></p> 
            <p><b>Время прибытия:</b> <?= $ride->arrivalTime?></p> 
            <p><b>Перевозчик:</b> <?= $ride->carrier?></p> 
        </div>
    </div>
<?php endforeach;?>