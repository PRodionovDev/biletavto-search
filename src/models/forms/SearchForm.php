<?php

namespace application\models\forms;

use yii\base\Model;

/**
 * Форма поиска рейсов.
 */
class SearchForm extends Model
{
    /**
     * Город отправления.
     */
    public $departure;

    /**
     * Город прибытия.
     */
    public $arrival;

    /**
     * Дата отправления.
     */
    public $date;

    /**
     * Правила валидации формы.
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
     * Именования аттрибутов.
     *
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'departure' => 'Город отправления',
            'arrival' => 'Город прибытия',
            'date' => 'Дата'
        ];
    }

    /**
     * Удаление имени формы из параметров.
     */
    public function formName()
    {
        return '';
    }
}
