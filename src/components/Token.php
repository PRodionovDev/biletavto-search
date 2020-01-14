<?php

namespace application\components;

use Yii;

/**
 * Token for Search.Biletavto project
 *
 * This class is needed for get token from Api.Biletavto
 */
class Token
{
	/**
	 * Get token from Api.Biletavto
	 *
	 * @return string
	 */
	public function getToken()
	{
		$url = Yii::$app->params['auth_url'];
		$params = array('username' => Yii::$app->params['username'], 'password' => Yii::$app->params['password']);
        $response = $this->getRequest($url, $params);

        return $response->token;
	}

	/**
	 * Sending a HTTP request
	 *
	 * @param string $url
	 * @param array $params
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
