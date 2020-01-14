<?php

namespace application\models\forms;

use yii\base\Model;

/**
 * RideSearchForm for Search.Biletavto project
 *
 */
class RideSearchForm extends Model
{
    /**
     * Departure City
     *
     */
    public $departure;

    /**
     * Arrival City
     *
     */
    public $arrival;

    /**
     * Departure date
     *
     */
    public $date;

    /**
     * validation rules
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['departure', 'arrival', 'date'], 'required'],
            [['departure', 'arrival', 'date'], 'string']
        ];
    }

    /**
     * attribute labels
     *
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'departure' => 'Город отправления',
            'arrival' => 'Город прибытия',
            'date' => 'Дата',
        ];
    }

    /**
     * Remove model name from parameters
     *
     */
    public function formName()
    {
        return '';
    }
}
