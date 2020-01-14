<?php

namespace application\controllers;

use Yii;
use yii\web\Controller;
use application\models\forms\RideSearchForm;
use application\repositories\RouteRepository;

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
     * Connect RouteRepository in controller
     *
     */ 
    public function __construct($id, $module, RouteRepository $routeRepository, $config = [])
    {
        $this->routeRepository = $routeRepository;
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

            $routelist = $this->routeRepository->getAllStationRoutes($departure);
            $notification = $this->routeRepository->getNotification($departure, $arrival);
        }
    	
        return $this->render('index', compact('model', 'notification', 'routelist'));
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
