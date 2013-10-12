<?php
/* @var $this UserRolesController */
/* @var $data UserRoles */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_role_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->user_role_id), array('view', 'id'=>$data->user_role_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_k')); ?>:</b>
	<?php echo CHtml::encode($data->user_k); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('role_k')); ?>:</b>
	<?php echo CHtml::encode($data->role_k); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_created')); ?>:</b>
	<?php echo CHtml::encode($data->date_created); ?>
	<br />


</div>