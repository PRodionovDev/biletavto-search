<?php

namespace application\controllers;

use Yii;
use yii\web\Controller;
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
	 * Display main-page
	 *
	 * @return string
	 */
    public function actionIndex()
    {
    	$model = new RideSearchForm();
        $request = Yii::$app->request->get();

        if ($model->load($request)) {
            $departure = $request['departure'];
            $arrival = $request['arrival'];
            $date = $request['date'];
            $token = "";

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
    public function actionSearch($departure, $arrival, $date)
    {
        $request = Yii::$app->request->get();

        $departure = (empty($request['departure'])) ? '' : $request['departure'];
        $arrival = (empty($request['arrival'])) ? '' : $request['arrival'];
        $date = (empty($request['date'])) ? date('d.m.Y') : date('d.m.Y', strtotime($request['date']));

        return $this->redirect(['search/index', 'departure' => $departure, 'arrival' => $arrival, 'date' => $date]);
    }
}
