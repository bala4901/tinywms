<?php
/* @var $this UserPermissionsController */
/* @var $model UserPermissions */

$this->breadcrumbs=array(
	'User Permissions'=>array('index'),
	$model->user_permission_k,
);

$this->menu=array(
	array('label'=>'List UserPermissions', 'url'=>array('index')),
	array('label'=>'Create UserPermissions', 'url'=>array('create')),
	array('label'=>'Update UserPermissions', 'url'=>array('update', 'id'=>$model->user_permission_k)),
	array('label'=>'Delete UserPermissions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_permission_k),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserPermissions', 'url'=>array('admin')),
);
?>

<h1>View UserPermissions #<?php echo $model->user_permission_k; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_permission_k',
		'user_k',
		'permission_k',
		'value',
		'date_created',
	),
)); ?>
