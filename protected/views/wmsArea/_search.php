<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'name'); ?>
		<?php echo $form->textArea($model, 'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'area_code'); ?>
		<?php echo $form->textArea($model, 'area_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'wh_id'); ?>
		<?php echo $form->textField($model, 'wh_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'area_type_id'); ?>
		<?php echo $form->textField($model, 'area_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'active'); ?>
		<?php echo $form->dropDownList($model, 'active', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'create_uid'); ?>
		<?php echo $form->textField($model, 'create_uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'create_date'); ?>
		<?php echo $form->textField($model, 'create_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'write_uid'); ?>
		<?php echo $form->textField($model, 'write_uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'write_date'); ?>
		<?php echo $form->textField($model, 'write_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
