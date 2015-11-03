<?php

namespace gechet\title\controllers;

use yii\web\Controller;
use gechet\title\models\Titles;

class EditController extends Controller {

	public function actionIndex() {
		$data = Titles::findAll();
		return $this->render('index', ['data' => $data]);
	}

}
