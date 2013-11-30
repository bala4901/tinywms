<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('name')); ?>:
	<?php echo GxHtml::encode($data->name); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('view')); ?>:
	<?php echo GxHtml::encode($data->view); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('module')); ?>:
	<?php echo GxHtml::encode($data->module); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('icon')); ?>:
	<?php echo GxHtml::encode($data->icon); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('parent_id')); ?>:
	<?php echo GxHtml::encode($data->parent_id); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('sort')); ?>:
	<?php echo GxHtml::encode($data->sort); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('create_uid')); ?>:
	<?php echo GxHtml::encode($data->create_uid); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('create_date')); ?>:
	<?php echo GxHtml::encode($data->create_date); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('write_uid')); ?>:
	<?php echo GxHtml::encode($data->write_uid); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('write_date')); ?>:
	<?php echo GxHtml::encode($data->write_date); ?>
	<br />
	*/ ?>

</div>