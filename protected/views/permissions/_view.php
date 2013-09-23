<?php
/* @var $this PermissionsController */
/* @var $data Permissions */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('permission_k')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->permission_k), array('view', 'id'=>$data->permission_k)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('application_k')); ?>:</b>
	<?php echo CHtml::encode($data->application_k); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('action')); ?>:</b>
	<?php echo CHtml::encode($data->action); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>