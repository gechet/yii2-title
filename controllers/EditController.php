<?php

namespace gechet\title\controllers;

use yii\web\Controller;
use gechet\title\models\Titles;

class EditController extends Controller
{
    public function actionIndex()
    {
			//$data = Titles::f
      return $this->render('index');
    }
}
