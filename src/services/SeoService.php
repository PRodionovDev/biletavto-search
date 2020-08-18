<?php

namespace application\services;

/**
 * Сервис SEO-приложения. Выполняет функции
 * форматирования тегов.
 */
class SeoService
{
    /**
     * Метод формирования тега Description.
     *
     * @param array $ride информация о маршрутах
     *
     * @return string
     */
    public function getDescription($ride = null)
    {
        $tag = 'Приобретайте билеты на нашем сайте онлайн. Точное расписание, цены как на вокзале. 
                Мы принимаем банковские карты, электронные деньги и наличные. 
                Продажа билетов за 90 дней до отправления автобуса';

        if ($ride) {
            $countRide = $this->getCountString(count($ride), array('рейс', 'рейса', 'рейсов'));
            $route = $ride[0]->departureCity . ' - ' . $ride[0]->arrivalCity;
            $price = $this->getCountString($ride[0]->price, array('рубль', 'рубля', 'рублей'));;
            $year = date("Y");
            $tag = $countRide . ' ' . $route . ' по цене от ' . $price . '. Посмотри актуальное расписание автобусов на ' . $year . 
                ' год на рейс ' . $route . ', автовокзалы отправления и прибытия, а также цены на билеты.';
        }

        return $tag;
    }

    /**
     * Метод форматирования склонения слов после числительных.
     *
     * @param integer $count     количество
     * @param array   $templates шаблон склонений
     *
     * @return string
     */
    private function getCountString($count, $templates)
    {
        $cases = array(2, 0, 1, 1, 1, 2);
        $key = ($count % 100 > 4 && $count % 100 < 20) ? 2 : $cases[min($count % 10, 5)];
        $format = $templates[$key];

        return $count . ' ' . $format;
    }
}
