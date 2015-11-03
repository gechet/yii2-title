# yii2-title

Тестовое задание для Antagosoft

# Установка
Добавляем в require в compoer.json 
```
"gechet/yii2-title": "*"
```
Установив запускаем миграцию:
```
php yii migrate --migrationPath=@gechet/title/migrations
```

И затем добавляем модуль в файл настроки приложения
```
<?php
$config = [
	'bootstrap' => [
		'title',
	],
	'modules' => [
		'title' => 'gechet\title\Module',
	],
];
```

Админка доступна по роуту 'title/edit/index'