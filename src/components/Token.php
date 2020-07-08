<?php

namespace application\components;

use Yii;

/**
 * Компонент работы с токеном. Необходим
 * для авторизации на API-сервисе.
 */
class Token
{
    /**
     * Получение токена из API-сервиса.
     * Проверяем наличие токена в кэше,
     * если его нет - генерируем новый.
     *
     * @return string
     */
    public function getToken()
    {
        $cacheToken = Yii::$app->cache->get('token');

        if ($cacheToken == false) {
            $this->resetToken();
        } else {
            $response = $cacheToken;
            $response = $response->token;
        }

        return $response;
    }

    /**
     * Сброс токена в API-сервисе
     * и сохранение его в кэше.
     *
     * @return string
     */
    public function resetToken()
    {
        $url = Yii::$app->params['auth_url'];
        $params = array('username' => Yii::$app->params['username'], 'password' => Yii::$app->params['password']);
        $response = $this->getRequest($url, $params);
        Yii::$app->cache->set('token', $response, 72000);

        return $response->token;
    }

    /**
     * Отправка HTTP запроса.
     *
     * @param string $url    адрес запроса
     * @param array  $params параметры
     *
     * @return array
     */
    private function getRequest($url, $params)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);

        return $response;
    }
}
