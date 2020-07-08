<?php

namespace application\repositories;

use application\models\Notification;

/**
 * Репозиторий приложения. Выполняет связующую
 * функцию между приложением и базой данных,
 * для таблиц и связей, у которых отсутствует
 * AR-модель.
 */
class RouteRepository
{
    /**
     * Метод получения всех маршрутов из выбраного города отправления.
     * created_by равный: 2065, 1798, 1811, 11937 - системные маршруты,
     * которые не должны быть доступны для поиска.
     *
     * @param string $departure город отправления
     *
     * @return array
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
     * Метод получения уведомления маршрута.
     *
     * @param string $departure город отправления
     * @param string $arrival   город прибытия
     *
     * @return string
     */
    public function getNotification($departure, $arrival)
    {
        $response = Notification::find()
            ->where([
                'city_start' => $departure,
                'city_end' => $arrival,
                'active' => '1'
            ])
            ->one();

        if (!empty($response)) {
            return $response->notification;
        }
    }
}
