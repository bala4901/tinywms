<?php
/* @var $this PermissionsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Permissions',
);

$this->menu=array(
	array('label'=>'Create Permissions', 'url'=>array('create')),
	array('label'=>'Manage Permissions', 'url'=>array('admin')),
);
?>

<h1>Permissions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
