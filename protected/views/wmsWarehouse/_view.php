<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('name')); ?>:
	<?php echo GxHtml::encode($data->name); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('wh_code')); ?>:
	<?php echo GxHtml::encode($data->wh_code); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('company_id')); ?>:
	<?php echo GxHtml::encode($data->company_id); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('create_uid')); ?>:
	<?php echo GxHtml::encode($data->create_uid); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('create_date')); ?>:
	<?php echo GxHtml::encode($data->create_date); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('write_uid')); ?>:
	<?php echo GxHtml::encode($data->write_uid); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('write_date')); ?>:
	<?php echo GxHtml::encode($data->write_date); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('active')); ?>:
	<?php echo GxHtml::encode($data->active); ?>
	<br />
	*/ ?>

</div>