<?php

namespace application\controllers;

use Yii;
use yii\web\Controller;
use application\models\forms\RideSearchForm;

/**
 * Search base controller
 *
 */
class SearchController extends Controller
{
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
        }
    	
        return $this->render('index', [
        	'model' => $model
        ]);
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
