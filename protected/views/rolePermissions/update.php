<?php
/* @var $this RolePermissionsController */
/* @var $model RolePermissions */

$this->breadcrumbs=array(
	'Role Permissions'=>array('index'),
	$model->role_permission_k=>array('view','id'=>$model->role_permission_k),
	'Update',
);

$this->menu=array(
	array('label'=>'List RolePermissions', 'url'=>array('index')),
	array('label'=>'Create RolePermissions', 'url'=>array('create')),
	array('label'=>'View RolePermissions', 'url'=>array('view', 'id'=>$model->role_permission_k)),
	array('label'=>'Manage RolePermissions', 'url'=>array('admin')),
);
?>

<h1>Update RolePermissions <?php echo $model->role_permission_k; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>