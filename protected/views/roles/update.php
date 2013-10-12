<?php
/* @var $this RolesController */
/* @var $model Roles */

$this->breadcrumbs=array(
	'Roles'=>array('index'),
	$model->name=>array('view','id'=>$model->role_k),
	'Update',
);

$this->menu=array(
	array('label'=>'List Roles', 'url'=>array('index')),
	array('label'=>'Create Roles', 'url'=>array('create')),
	array('label'=>'View Roles', 'url'=>array('view', 'id'=>$model->role_k)),
	array('label'=>'Manage Roles', 'url'=>array('admin')),
);
?>

<h1>Update Roles <?php echo $model->role_k; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>