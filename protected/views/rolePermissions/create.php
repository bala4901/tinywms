<?php
/* @var $this RolePermissionsController */
/* @var $model RolePermissions */

$this->breadcrumbs=array(
	'Role Permissions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RolePermissions', 'url'=>array('index')),
	array('label'=>'Manage RolePermissions', 'url'=>array('admin')),
);
?>

<h1>Create RolePermissions</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>