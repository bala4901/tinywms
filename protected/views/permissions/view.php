<?php
/* @var $this PermissionsController */
/* @var $model Permissions */

$this->breadcrumbs=array(
	'Permissions'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Permissions', 'url'=>array('index')),
	array('label'=>'Create Permissions', 'url'=>array('create')),
	array('label'=>'Update Permissions', 'url'=>array('update', 'id'=>$model->permission_k)),
	array('label'=>'Delete Permissions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->permission_k),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Permissions', 'url'=>array('admin')),
);
?>

<h1>View Permissions #<?php echo $model->permission_k; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'permission_k',
		'application_k',
		'action',
		'name',
		'description',
	),
)); ?>
