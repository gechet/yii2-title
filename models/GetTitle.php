<?php

namespace gechet\title\models;

use gechet\title\models\Titles;
use yii\helpers\Url;

/**
 * Класс для релевантного поиска нужного тайтал в списке
 * @author Serhii Chepela <scheoriginal@gmail.com>
 */
class GetTitle {
	
	/**
	 * Массив с данными
	 * @var array 
	 */
	protected $url =[];


	public function __construct() {
		$this->prepUrl();
	}
	
	/**
	 * Готовит массив с данніми получеными из урла
	 */
	protected function prepUrl() {
		$this->url = [
				'full' => Url::to(''),
				'base' => Url::base(),
		];
		$this->url['getExplode'] = explode("?", $this->url['full']);
		if(count($this->url['getExplode'])==2){
			$this->url['getExplode']['params'] = explode('&', $this->url['getExplode'][1]);
		}
		$this->url['slashExplode'] = explode("/", $this->url['getExplode'][0]);
	}
	
	/**
	 * Отсекает по одному гет параметрі и сравниает результат со списком
	 * @param type $params
	 * @param type $currentUrl
	 * @return boolean
	 */
	protected function cutParams($params,$currentUrl) {
		$url = $this->url['full'];
		for($j = count($params)-1;$j >= 0;$j--){
			if($j!=0) {
				$params[$j] = "&" . $params[$j];
			} else {
				$params[$j] = "?" . $params[$j];
			}
			$url = str_replace($params[$j], '', $url);
			if($currentUrl === $url) {
				return TRUE;
			}
		}
		return FALSE;
	}
	
	/**
	 * Сравниает урл со списком отсекая от урла без гет параметров слэш и сам параметр
	 * @param array $params
	 * @param string $currentUrl
	 * @return boolean
	 */
	protected function cutRout($params,$currentUrl) {
		$url = $this->url['full'];
		for($j = count($params)-1;$j > 0;$j--){
			if($j!=count($params)-1 AND !empty($params[count($params)-1])) {
				$url = strrev(preg_replace('~\/~', '', strrev($url),1));
				if($currentUrl === $url) {
					return TRUE;
				}
			}			
			$url = strrev(preg_replace('~'.strrev($params[$j]).'~', '', strrev($url),1));
			if($currentUrl === $url) {
				return TRUE;
			}
		}
		return FALSE;
	}
	
	/**
	 * Ищет совпадающий тайтл со списком по релевантности.
	 * @param array $titles
	 */
	protected function findRelevant($titles) {
		for($i=0;$i<count($titles);$i++) {
			//Сначала ищем полные совпадения
			if($titles[$i]['url'] === $this->url['full']){
				return $titles[$i]['title'];
			}
			//Отсекает параметры по одному и сравниваем со списком
			if(isset($this->url['getExplode']['params']) AND $this->cutParams($this->url['getExplode']['params'], $titles[$i]['url'])){
				return $titles[$i]['title'];
			}
			//Разбиваем урл по слэшу и сравниваем со списком
			if(count($this->url['slashExplode'])>1 AND $this->cutRout($this->url['slashExplode'], $titles[$i]['url'])){
				return $titles[$i]['title'];
			}
		}
		return 'Base title';
	}
	
	/**
	 * Забирает из базы все возможные варианты по базовому урлу, сравниваниет их со списком и отдаёт тайтл
	 * @return string
	 */
	public function returnTitle() {
		$title = Titles::find()->where(['like','url',$this->url['base']])->orderBy(['id'=>SORT_DESC])->asArray()->all();
		return $this->findRelevant($title);
		
	}
	
}
