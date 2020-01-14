<?php

namespace application\controllers;

use yii\web\Controller;

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
        return $this->render('index');
    }
}
