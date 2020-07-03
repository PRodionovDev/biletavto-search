<?php

namespace application\controllers;

use Yii;
use yii\web\Controller;
use application\components\Token;
use application\models\forms\RideSearchForm;
use application\repositories\RouteRepository;
use application\services\RouteService;

/**
 * Search base controller
 *
 */
class SearchController extends Controller
{
    /**
     * Protected RouteRepository variable
     *
     */
    protected $routeRepository;

    /**
     * Protected RouteService variable
     *
     */
    protected $routeService;

    /**
     * Connect RouteRepository and RouteService in controller
     *
     */ 
    public function __construct($id, $module, RouteRepository $routeRepository, RouteService $routeService, $config = [])
    {
        $this->routeRepository = $routeRepository;
        $this->routeService = $routeService;
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     *
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
	 * Display main-page
	 *
	 * @return string
	 */
    public function actionIndex()
    {
    	$model = new RideSearchForm();
        $request = Yii::$app->request->get();

        if ($model->load($request)) {
            $departure = trim($request['departure']);
            $arrival = trim($request['arrival']);
            $date = (empty($request['date'])) ? date('d.m.Y') : date('d.m.Y', strtotime($request['date']));
            $model->date = $date;
            $token = new Token();
            $token = $token->getToken();

            Yii::info($departure . ', ' . $arrival . ', ' . $date, 'search');

            $ridelist = $this->routeService->getRoute($departure, $arrival, $date, $token);
            $routelist = $this->routeRepository->getAllStationRoutes($departure);
            $notification = $this->routeRepository->getNotification($departure, $arrival);
        }
    	
        return $this->render('index', compact('model', 'ridelist', 'notification', 'routelist'));
    }

    /**
     * Redirect to index-page after submitting the form, to format prettyUrl 
     *
     * @param string $departure
     * @param string $arrival
     * @param string $date
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
}
