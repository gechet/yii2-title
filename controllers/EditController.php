<?php

namespace gechet\title\controllers;

use Yii;
use yii\web\Controller;
use yii\base\Model;
use gechet\title\models\Titles;

class EditController extends Controller {

	/**
	 * Обрабатывает данные из формы и русет саму форму
	 */
	public function actionIndex() {
		$rules = Titles::find()->indexBy('id')->all();
		$newRule = $this->newTitles();		
		
		if($newRule->load(Yii::$app->request->post()) and !empty($newRule->url) and !empty($newRule->title)) {
			$newRule->save();
			$newRule = $this->newTitles();
		}
		
		if (Model::loadMultiple($rules, Yii::$app->request->post()) && Model::validateMultiple($rules)) {
			foreach ($rules as $rule) {
				$rule->save(false);
				$rules = Titles::find()->indexBy('id')->all();
			}
		}

		return $this->render('index', ['rules' => $rules, 'newRule' => $newRule]);
	}
	
	/**
	 * Служебный метод для генерации моделт под новую запись
	 * @return Titles
	 */
	protected function newTitles() {
		$title = new Titles();
		$title->scenario = Titles::SCENARIO_NEW;
		return $title;
	}

}
