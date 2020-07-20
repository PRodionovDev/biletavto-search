<?php

namespace application\controllers;

use Yii;
use yii\web\Controller;
use application\components\Token;
use application\models\SearchStatistic;
use application\models\forms\SearchForm;
use application\repositories\RouteRepository;
use application\services\RouteService;

/**
 * Базовый контроллер приложения.
 */
class SearchController extends Controller
{
    /**
     * Глобальная protected-переменная,
     * используемая для инициализации
     * репозитория routeRepository.
     */
    protected $routeRepository;

    /**
     * Глобальная protected-переменная,
     * используемая для инициализации
     * сервиса routeService.
     */
    protected $routeService;

    /**
     * Конструктор, инициализирующий
     * сервисы и репозитории.
     */ 
    public function __construct($id, $module, RouteRepository $routeRepository, RouteService $routeService, $config = [])
    {
        $this->routeRepository = $routeRepository;
        $this->routeService = $routeService;

        parent::__construct($id, $module, $config);
    }

    /**
     * Поведения - это экземпляры класса yii\base\Behavior или класса,
     * унаследованного от него. Поведения, также известные как примеси,
     * позволяют расширять функциональность существующих компонентов без
     * необходимости изменения дерева наследования.
     *
     * Кэширование страниц приложения, используемое
     * для ускорения загрузки повторно загружаемых
     * страниц.
     *
     * 'only' - кэшируемые страницы.
     * 'duration' - время кэширования в секундах.
     * 'variations' - кэшируемые параметры.
     */
    public function behaviors()
    {
        return [
            'pageCache' => [
                'class' => 'yii\filters\PageCache',
                'only' => ['index'],
                'duration' => 120,
                'variations' => [
                    Yii::$app->request->get('departure'),
                    Yii::$app->request->get('arrival'),
                    Yii::$app->request->get('date'),
                ]
            ],
        ];
    }

    /**
     * Отображение главной страницы приложения.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new SearchForm();
        $request = Yii::$app->request->get();

        if ($model->load($request)) {

            /**
             * Получаем параметры для поиска. Удаляем лишние пробелы,
             * если они есть. При отсутствии явно указанной даты -
             * выбирается текущий день.
             *
             * Для вывода даты в форму поиска, присваиваем итоговую дату
             * к свойству модели.
             */
            $departure = trim($request['departure']);
            $arrival = trim($request['arrival']);
            $date = (empty($request['date'])) ? date('d.m.Y') : date('d.m.Y', strtotime($request['date']));
            $model->date = $date;

            /**
             * Получаем токен для связи с API-сервисом.
             */
            $token = new Token();
            $token = $token->getToken();

            Yii::info($departure . ', ' . $arrival . ', ' . $date, 'search');

            /**
             * Получение данных, где:
             *
             * ridelist - список рейсов, доступных для покупки.
             * routelist - список маршрутов, который выходит внизу
             * страницы в зависимости от города отправления.
             * notification - уведомления для рейсов
             * (например: "Рейс отправляется по наполнению").
             */
            $ridelist = $this->routeService->getRoute($departure, $arrival, $date, $token);
            $routelist = $this->routeRepository->getAllStationRoutes($departure);
            $notification = $this->routeRepository->getNotification($departure, $arrival);
        }
        
        return $this->render('index', compact('model', 'ridelist', 'notification', 'routelist'));
    }

    /**
     * Метод, необходимый для редиректа на
     * главную страницу, приведя URL к ЧПУ. 
     *
     * @param string $departure город отправления
     * @param string $arrival   город прибытия
     * @param string $date      дата отправления
     *
     * @return redirect
     */
    public function actionSearch($departure, $arrival, $date = null)
    {
        $request = Yii::$app->request->get();

        $departure = (empty($request['departure'])) ? '' : trim($request['departure']);
        $arrival = (empty($request['arrival'])) ? '' : trim($request['arrival']);
        $date = (empty($request['date'])) ? date('d.m.Y') : date('d.m.Y', strtotime($request['date']));

        return $this->redirect(['search/index', 'departure' => $departure, 'arrival' => $arrival, 'date' => $date]);
    }

    /**
     * Отображение страницы со списком маршрутов города.
     *
     * @param string $departure город отправления
     *
     * @return string
     */
    public function actionCity($departure)
    {
        $model = new SearchForm();
        $model->departure = $departure;
        $routelist = $this->routeRepository->getAllStationRoutes($departure);

        /**
         * Список конечных станций в виде строки.
         */
        $endStation = '';

        foreach ($routelist as $key => $route) {
            $endStation .= $route["end"] . ', ';
        }

        /**
         * Убираем из строки последнюю запятую
         * и пробел.
         */
        $endStation = substr($endStation, 0, -2);

        return $this->render('city', [
            'model' => $model,
            'routelist' => $routelist,
            'endStation' => $endStation 
        ]);
    }

    /**
     * Сбор статистики поисковых запросов
     * пользователей.
     * 
     * С целью сохранения быстродействия
     * запросы работают через AJAX.
     */
    public function actionSearchStatistic()
    {
        $model = new SearchStatistic();

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $model->departure = $data['departure'];
            $model->arrival = $data['arrival'];
            $model->date = $data['date'];
            $model->status = $data['status'];
            $model->save();
        }
    }
}
