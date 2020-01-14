<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

$this->title = 'Билетавто';
?>

<div class="ride-search">

    <?php $form = ActiveForm::begin([
        'action' => ['search'],
        'method' => 'get',
        'options' =>[
            'autocomplete'=>'off',
        ]
    ]); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-3 padding-side-0 padding-side-mobile-15">
                <?= $form->field($model, 'departure')->textInput(['placeholder' => 'Откуда', 'id' => 'departure'])->label(false) ?>
                <div class="offset-md-10">
                    <p onclick="return replaceValue(departure, arrival)"><span class="glyphicon glyphicon-transfer replace-value"></span></p>
                </div>
            </div>
            <div class="col-md-3 padding-side-0 padding-side-mobile-15">
                <div class="col-md-12 padding-side-0">
                    <?= $form->field($model, 'arrival')->textInput(['placeholder' => 'Куда', 'id' => 'arrival'])->label(false) ?>
                </div>
            </div>
            <div class="col-md-3 padding-side-0 padding-side-mobile-15">
            	<?= $form->field($model, 'date')->widget(DatePicker::className(),[
                        'id' => 'date',
            			'name' => 'date',
                        'language' => 'ru',
                        'dateFormat' => 'dd.MM.yyyy',
						'options' => [
                            'placeholder' => 'Выбрать дату...',
                            'class'=> 'form-control',
                            'autocomplete'=>'off'
                        ],
                        'clientOptions' => [
                            'minDate' => date('d.m.Y')
                        ]])->label(false) ?>
                <div class="text-center search-date-blc">
                    <?= Html::button('Сегодня: ' . date("d.m"), ['class' => 'search-date', 'onclick' => 'chooseToday()']); ?>
                    <p class="text-danger no_mobile"><strong>Проверьте внимательно дату отправления</strong><p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= Html::submitButton('Найти маршрут <span class="glyphicon glyphicon-search" aria-hidden="true"></span>', ['class' => 'btn btn-warning btn-block']) ?>
                </div>
            </div>             
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
