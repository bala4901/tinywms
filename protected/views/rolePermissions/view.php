<?php
/* @var $this RolePermissionsController */
/* @var $model RolePermissions */

$this->breadcrumbs=array(
	'Role Permissions'=>array('index'),
	$model->role_permission_k,
);

$this->menu=array(
	array('label'=>'List RolePermissions', 'url'=>array('index')),
	array('label'=>'Create RolePermissions', 'url'=>array('create')),
	array('label'=>'Update RolePermissions', 'url'=>array('update', 'id'=>$model->role_permission_k)),
	array('label'=>'Delete RolePermissions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->role_permission_k),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RolePermissions', 'url'=>array('admin')),
);
?>

<h1>View RolePermissions #<?php echo $model->role_permission_k; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'role_permission_k',
		'role_k',
		'permission_k',
		'value',
		'date_created',
	),
)); ?>
