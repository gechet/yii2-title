<?php

namespace gechet\title;

use yii\base\Application;

class Module extends \yii\base\Module implements \yii\base\BootstrapInterface{

	public $controllerNamespace = 'gechet\title\controllers';

	public function init() {
		parent::init();
	}
	
	/**
	 * 
	 * @inheritdoc
	 */
	public function bootstrap($app) {
		$app->on(Application::EVENT_BEFORE_ACTION, function () use ($app) {
			$app->view->title= $this->getTitle();
    });
	}
	
	/**
	 * 
	 * @return type
	 */
	protected function getTitle() {
		$title = (new models\GetTitle())->returnTitle();
		return $title;
	}

}
