<?php
/* @var $this UserRolesController */
/* @var $model UserRoles */

$this->breadcrumbs=array(
	'User Roles'=>array('index'),
	$model->user_role_id,
);

$this->menu=array(
	array('label'=>'List UserRoles', 'url'=>array('index')),
	array('label'=>'Create UserRoles', 'url'=>array('create')),
	array('label'=>'Update UserRoles', 'url'=>array('update', 'id'=>$model->user_role_id)),
	array('label'=>'Delete UserRoles', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_role_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserRoles', 'url'=>array('admin')),
);
?>

<h1>View UserRoles #<?php echo $model->user_role_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_role_id',
		'user_k',
		'role_k',
		'date_created',
	),
)); ?>
