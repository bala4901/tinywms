<?php
/* @var $this UserPermissionsController */
/* @var $model UserPermissions */

$this->breadcrumbs=array(
	'User Permissions'=>array('index'),
	$model->user_permission_k=>array('view','id'=>$model->user_permission_k),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserPermissions', 'url'=>array('index')),
	array('label'=>'Create UserPermissions', 'url'=>array('create')),
	array('label'=>'View UserPermissions', 'url'=>array('view', 'id'=>$model->user_permission_k)),
	array('label'=>'Manage UserPermissions', 'url'=>array('admin')),
);
?>

<h1>Update UserPermissions <?php echo $model->user_permission_k; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>