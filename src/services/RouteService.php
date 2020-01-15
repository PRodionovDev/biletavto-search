<?php

namespace application\services;

use Yii;

/**
 * RouteService for Search.Biletavto project
 *
 * This class is needed for interacting with routes
 */
class RouteService
{
	/**
	 * Method to get a list of routes from the departure city to the arrival city on a specific date
	 *
	 * @param string $departure
	 * @param string $arrival
	 * @param string $date
	 * @param string $token
	 *
	 * @return array
	 */
	public function getRoute($departure, $arrival, $date, $token)
	{
		$rideListBiletavto = $this->getBiletavtoRoute($departure, $arrival, $date, $token);
        $rideListAvtovokzalOnline = $this->getAvtovokzalOnlineRoute($departure, $arrival, $date, $token);
        $rideListUnitiki = $this->getUnitikiRoute($departure, $arrival, $date, $token);
        $response = array_merge($rideListBiletavto, $rideListAvtovokzalOnline, $rideListUnitiki);
        
        return $response;
	}

	/**
	 * Private method to get a list of Biletavto's routes
	 *
	 * @param string $departure
	 * @param string $arrival
	 * @param string $date
	 * @param string $token
	 *
	 * @return array
	 */
	private function getBiletavtoRoute($departure, $arrival, $date, $token)
	{
		$headers = array("Authorization: Bearer " . $token, "Content-Type: application/json");
		$date = date('Y-m-d', strtotime($date));
		$params = 'departure=' . $departure . '&arrival=' . $arrival . '&departureDate=' . $date;
		$url = Yii::$app->params['biletavto_url'];
        $response = $this->getRequest($headers, $url, $params);

        return $response;
	}

	/**
	 * Private method to get a list of AvtovokzalOnline's routes
	 *
	 * @param string $departure
	 * @param string $arrival
	 * @param string $date
	 * @param string $token
	 *
	 * @return array
	 */
	private function getAvtovokzalOnlineRoute($departure, $arrival, $date, $token)
	{
		$headers = array("Authorization: Bearer " . $token, "Content-Type: application/json");
		$date = date('Y-m-d', strtotime($date));
		$params = 'departure=' . $departure . '&arrival=' . $arrival . '&departureDate=' . $date;
		$url = Yii::$app->params['avtovokzalonline_url'];
        $response = $this->getRequest($headers, $url, $params);

        return $response->data;
	}

	/**
	 * Private method to get a list of Unitiki's routes
	 *
	 * @param string $departure
	 * @param string $arrival
	 * @param string $date
	 * @param string $token
	 *
	 * @return array
	 */
	private function getUnitikiRoute($departure, $arrival, $date, $token)
	{
		$headers = array("Authorization: Bearer " . $token, "Content-Type: application/json");
		$date = date('Y-m-d', strtotime($date));
		$params = 'departure=' . $departure . '&arrival=' . $arrival . '&departureDate=' . $date;
		$url = Yii::$app->params['unitiki_url'];
        $response = $this->getRequest($headers, $url, $params);

        return $response;
	}

	/**
	 * Sending a HTTP request
	 *
	 * @param array $headers
	 * @param string $url
	 * @param string $params
	 *
	 * @return array
	 */
	private function getRequest($headers, $url, $params)
	{
	 	$ch = curl_init($url . '?' . $params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);

        return $response;
	}
}
