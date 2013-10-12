<?php
/* @var $this UserPermissionsController */
/* @var $model UserPermissions */

$this->breadcrumbs=array(
	'User Permissions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserPermissions', 'url'=>array('index')),
	array('label'=>'Manage UserPermissions', 'url'=>array('admin')),
);
?>

<h1>Create UserPermissions</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>