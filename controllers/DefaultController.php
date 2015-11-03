<?php

namespace gechet\title\controllers;

use yii\web\Controller;

class DefaultController extends Controller {

	public function actionIndex() {
		return $this->redirect(['edit/index']);
	}

}
