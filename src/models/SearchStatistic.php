<?php

namespace application\models;

/**
 * Сбор статистики поисковых запросов пользователей.
 * Статистика собирается по параметрам поиска, таким
 * как: города отправления и прибытия, дата, а также
 * ответ сервера, который нужен, чтобы отследить
 * получил пользователь ответ или нет.
 */
class SearchStatistic extends \yii\db\ActiveRecord
{
    /**
     * Метка времени создания объекта модели.
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at']
                ],
                'value' => new \yii\db\Expression('NOW()')

            ],
        ];
    }

    /**
     * Именования таблицы в базе данных.
     *
     * @return string
     */
    public static function tableName()
    {
        return '{{%search_statistic}}';
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
            'date' => 'Дата отправления',
            'status' => 'Ответ серверу'
        ];
    }
}
