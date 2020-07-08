<?php

namespace application\services;

use Yii;
use application\components\Token;
use application\components\UrlGenerator;

/**
 * Сервис приложения. Выполняет функции
 * получения рейсов у API-сервиса и
 * форматирования общего массива маршрутов.
 *
 * Также сервис отвечает за редиректы.
 */
class RouteService
{
    /**
     * Метод получения массива рейсов или редиректов с
     * кодами ошибок.
     *
     * @param string $departure город отправления
     * @param string $arrival   город прибытия
     * @param string $date      дата отправления
     * @param string $token     токен для авторизации
     *
     * @return array
     */
    public function getRoute($departure, $arrival, $date, $token)
    {
        /**
         * Форматируем дату, а также получаем текущую дату.
         * Данный код необходим для 301 редиректа в случае,
         * если дата запроса ранее, чем "сегодня".
         */
        $dateNow = date('d.m.Y');
        $dateNowTimestamp = strtotime($dateNow);
        $dateTimestamp = strtotime($date);

        if ($dateTimestamp < $dateNowTimestamp) {
            Yii::$app->getResponse()->redirect('/' . $departure . '/' . $arrival . '/' . $dateNow . '/', 301)->send();
        }

        /**
         * Получаем массив маршрутов.
         */
        $ridelist = $this->getRide($departure, $arrival, $date, $token);

        /**
         * Если при запросе к API-сервису приходит 401 ошибка,
         * происходит сброс токена и поиск выполняется снова.
         */
        if ($ridelist == 401) {
            $token = new Token();
            $token = $token->resetToken();
            $ridelist = $this->getRide($departure, $arrival, $date, $token);
        }

        /**
         * Формируем URL на страницу покупки для рейсов.
         */
        $url = new UrlGenerator();
        $response = $url->generate($ridelist);

        /**
         * Если рейсов не обнаружено, возвращаем ошибку 404.
         * Действие необходимо для того, чтобы поисковые роботы
         * не индексировали пустые страницы.
         */
        if (empty($response)) {
            Yii::$app->response->statusCode = 404;
        }
        
        return $response;
    }

    /**
     * Метод получения массива рейсов.
     *
     * @param string $departure город отправления
     * @param string $arrival   город прибытия
     * @param string $date      дата отправления
     * @param string $token     токен для авторизации
     *
     * @return array
     */
    private function getRide($departure, $arrival, $date, $token)
    {
        $biletavto = $this->getRequest($departure, $arrival, $date, $token, Yii::$app->params['biletavto_url']);
        $avtovokzalOnline = $this->getRequest($departure, $arrival, $date, $token, Yii::$app->params['avtovokzalonline_url']);
        $unitiki = $this->getRequest($departure, $arrival, $date, $token, Yii::$app->params['unitiki_url']);

        /**
         * Проверка ответа от API-сервиса. Свойство статус возвращается
         * при отсутствии или неверном токене авторизации.
         */
        if (!empty($biletavto->status) || !empty($avtovokzalOnline->status) || !empty($unitiki->status)) {
            return 401;
        } else {
            $response = array_merge($biletavto, $avtovokzalOnline->data, $unitiki);
            return $response;
        }
    }

    /**
     * Отправка HTTP запроса
     *
     * @param string $departure город отправления
     * @param string $arrival   город прибытия
     * @param string $date      дата отправления
     * @param string $token     токен авторизации
     * @param string $url       URL метода API-сервиса
     *
     * @return array
     */
    private function getRequest($departure, $arrival, $date, $token, $url)
    {
        $headers = array("Authorization: Bearer " . $token, "Content-Type: application/json");
        $date = date('Y-m-d', strtotime($date));
        $params = 'departure=' . $departure . '&arrival=' . $arrival . '&departureDate=' . $date;

        /**
         * Заменяем символ пробела на "+"
         * для корректного парсинга запроса.
         */
        $params = str_replace(' ', '+', $params);

        $ch = curl_init($url . '?' . $params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);

        return $response;
    }
}
