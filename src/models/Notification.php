<?php

namespace application\models;

/**
 * Уведомления для маршрутов. Например:
 * "Автобус отправляется только по наполнению".
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * Именования таблицы в базе данных.
     *
     * @return string
     */
    public static function tableName()
    {
        return '{{%route_notification}}';
    }

    /**
     * Именования аттрибутов.
     *
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_start' => 'Город отправления',
            'city_end' => 'Город прибытия',
            'notification' => 'Уведомление',
            'active' => 'Active'
        ];
    }
}
