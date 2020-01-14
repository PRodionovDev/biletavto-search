<?php

namespace application\controllers;

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
    	
        return $this->render('index', [
        	'model' => $model
        ]);
    }
}
