<?php
/* @var $this RolePermissionsController */
/* @var $model RolePermissions */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'role_permission_k'); ?>
		<?php echo $form->textField($model,'role_permission_k'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'role_k'); ?>
		<?php echo $form->textField($model,'role_k'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'permission_k'); ?>
		<?php echo $form->textField($model,'permission_k'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'value'); ?>
		<?php echo $form->textField($model,'value'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_created'); ?>
		<?php echo $form->textField($model,'date_created'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->