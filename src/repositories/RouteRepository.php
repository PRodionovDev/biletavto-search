<?php

namespace application\repositories;

/**
 * RouteRepository for Search.Biletavto project
 *
 * This class is needed for interacting with database
 */
class RouteRepository
{
	/**
	 * Method of obtaining a list of possible routes from the departure city
	 * created_by == [2065, 1798, 1811, 11937] - system routes that are not searchable
	 *
	 * @param string $departure
	 *
	 * @return array $routelist
	 */
	public function getAllStationRoutes($departure)
	{
		$stations = (new \yii\db\Query())
            ->select([
                'station_start_name as start',
                'station_end_name as end'])
            ->distinct()
            ->from('modx_armk_price_route')
            ->where(['and', 'created_by!=2065', 'created_by!=1798', 'created_by!=1811', 'created_by!=11937'])
            ->andWhere(['station_start_name' => $departure])
            ->orderBy(['end' => SORT_ASC])
            ->all();

        return $stations; 
	}

	/**
	 * Method of get route's notification
	 *
	 * @param string $departure
	 * @param string $arrival
	 *
	 * @return string $notification
	 */
	public function getNotification($departure, $arrival)
	{
		$response = (new \yii\db\Query())
            ->select('notification')
            ->from('route_notification')
            ->where(['city_start' => $departure, 'city_end' => $arrival, 'active' => '1'])
            ->one();

        return $response["notification"];
	}
}
