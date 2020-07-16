<?php

namespace application\models;

/**
 * Рейсы, страницы с которыми должны отдавать
 * определенный ответ (200 по умолчанию),
 * не зависимо от их наличия.
 */
class RouteStatic extends \yii\db\ActiveRecord
{
    /**
     * Именования таблицы в базе данных.
     *
     * @return string
     */
    public static function tableName()
    {
        return '{{%route_static}}';
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
            'departure' => 'Город отправления',
            'arrival' => 'Город прибытия',
            'status' => 'Ответ серверу'
        ];
    }
}
