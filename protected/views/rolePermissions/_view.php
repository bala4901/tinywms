<?php
/* @var $this RolePermissionsController */
/* @var $data RolePermissions */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('role_permission_k')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->role_permission_k), array('view', 'id'=>$data->role_permission_k)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('role_k')); ?>:</b>
	<?php echo CHtml::encode($data->role_k); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('permission_k')); ?>:</b>
	<?php echo CHtml::encode($data->permission_k); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('value')); ?>:</b>
	<?php echo CHtml::encode($data->value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_created')); ?>:</b>
	<?php echo CHtml::encode($data->date_created); ?>
	<br />


</div>