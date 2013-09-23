<?php
/* @var $this RolePermissionsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Role Permissions',
);

$this->menu=array(
	array('label'=>'Create RolePermissions', 'url'=>array('create')),
	array('label'=>'Manage RolePermissions', 'url'=>array('admin')),
);
?>

<h1>Role Permissions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
