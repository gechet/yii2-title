<?php

namespace gechet\title\models;

use Yii;

/**
 * This is the model class for table "titles".
 *
 * @property integer $id
 * @property string $url
 * @property string $title
 */
class Titles extends \yii\db\ActiveRecord {

	const SCENARIO_NEW = "new";

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'titles';
	}
	
	public function scenarios() {
		return [
				self::SCENARIO_DEFAULT =>['url','title'],
				self::SCENARIO_NEW => ['url','title'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
				[['url', 'title'], 'required', 'on' =>  self::SCENARIO_DEFAULT],
				[['url', 'title'], 'safe', 'on' =>  self::SCENARIO_DEFAULT],
				[['url', 'title'], 'string', 'max' => 255],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
				'id' => Yii::t('app', 'ID'),
				'url' => Yii::t('app', 'Url'),
				'title' => Yii::t('app', 'Title'),
		];
	}
	
}
