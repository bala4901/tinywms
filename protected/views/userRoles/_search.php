<?php
/* @var $this UserRolesController */
/* @var $model UserRoles */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'user_role_id'); ?>
		<?php echo $form->textField($model,'user_role_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_k'); ?>
		<?php echo $form->textField($model,'user_k'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'role_k'); ?>
		<?php echo $form->textField($model,'role_k'); ?>
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