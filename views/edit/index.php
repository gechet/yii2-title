<?php
use yii\widgets\ActiveForm;

gechet\title\TitleAsset::register($this);
?>
<div id="edit-form">
	<?php 
	$form = ActiveForm::begin();
	?>
	<div class="edit-row">
		<div class="edit-field edit-url edit-label"><?=Yii::t('app', 'Url')?></div>
		<div class="edit-field edit-title edit-label"><?=Yii::t('app', 'Title')?></div>
	</div>
	<?php
	foreach ($rules as $index=>$model) {
	?>
	<div class="edit-row">
		<div class="edit-field edit-url"><?=$form->field($model,"[$index]url")->label(FALSE)?></div>
		<div class="edit-field edit-title"><?=$form->field($model, "[$index]title")->label(FALSE)?></div>
	</div>
<?php } ?>
	<div class="edit-row">
		<div class="edit-field edit-url"><?=$form->field($newRule,"url")->label(FALSE)?></div>
		<div class="edit-field edit-title"><?=$form->field($newRule, "title")->label(FALSE)?></div>
	</div>
<?= yii\helpers\Html::submitButton(Yii::t('app', 'Update'),['class' => 'btn btn-success'])?>
</div>
<?php
ActiveForm::end();
