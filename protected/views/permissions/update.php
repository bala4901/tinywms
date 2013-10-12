<?php
/* @var $this PermissionsController */
/* @var $model Permissions */

$this->breadcrumbs=array(
	'Permissions'=>array('index'),
	$model->name=>array('view','id'=>$model->permission_k),
	'Update',
);

$this->menu=array(
	array('label'=>'List Permissions', 'url'=>array('index')),
	array('label'=>'Create Permissions', 'url'=>array('create')),
	array('label'=>'View Permissions', 'url'=>array('view', 'id'=>$model->permission_k)),
	array('label'=>'Manage Permissions', 'url'=>array('admin')),
);
?>

<h1>Update Permissions <?php echo $model->permission_k; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>