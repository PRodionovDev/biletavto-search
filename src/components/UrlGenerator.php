<?php

namespace application\components;

use Yii;

/**
 * Url Generator for Search.Biletavto project
 *
 * This class is needed for generate ride-url
 */
class UrlGenerator
{
	/**
	 * Generate Url
	 *
	 * @param array $ridelist
	 *
	 * @return array
	 */
	public function generate($ridelist)
	{
		$response = [];

		foreach ($ridelist as $key => $ride) {
			switch ($ride->agentId) {
				case Yii::$app->params['biletavto_agent_id']:
					$data = $this->setUrlBiletavto($ride);
					break;
				case Yii::$app->params['avtovokzal_online_agent_id']:
					$data = $this->setUrlAvtovokzalOnline($ride);
					break;
				case Yii::$app->params['unitiki_agent_id']:
					$data = $this->setUrlUnitiki($ride);
					break;
			}

			array_push($response, $data);
		}

		return $ridelist;
	}

	/**
	 * Added Url in object
	 *
	 * @param object $ride
	 *
	 * @return object
	 */
	private function setUrlBiletavto($ride)
	{
		$url = 'https://biletavto.ru/ticketregistration/';
		$params = 'ride_id=' . $ride->rideId . '&price_id=' . $ride->priceId; 
		$ride->url = $url . '?' . $params;
		return $ride;
	}

	/**
	 * Added Url in object
	 *
	 * @param object $ride
	 *
	 * @return object
	 */
	private function setUrlAvtovokzalOnline($ride)
	{
		$url = 'https://biletavto.ru/ticketregistration/v5/';
		$params = 'route_id=' . $ride->rideId . '&sheet_id=' . $ride->priceId . '&arrival_station_id=' . $ride->arrivalCityId . '&DEPARTURE_STATION_NAME=' . $ride->departureCity . '&ARRIVAL_STATION_NAME=' . $ride->arrivalCity; 
		$ride->url = $url . '?' . $params;
		return $ride;
	}

	/**
	 * Added Url in object
	 *
	 * @param object $ride
	 *
	 * @return object
	 */
	private function setUrlUnitiki($ride)
	{
		$url = 'https://biletavto.ru/ticketregistration/v2/';
		$params = 'route_id=' . $ride->rideId; 
		$ride->url = $url . '?' . $params;
		return $ride;
	}
}
