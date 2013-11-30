<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'conf-menu-tree-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textArea($model, 'name'); ?>
		<?php echo $form->error($model,'name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'view'); ?>
		<?php echo $form->textArea($model, 'view'); ?>
		<?php echo $form->error($model,'view'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'module'); ?>
		<?php echo $form->textArea($model, 'module'); ?>
		<?php echo $form->error($model,'module'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'icon'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'icon',
			'value' => $model->icon,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
		<?php echo $form->error($model,'icon'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'parent_id'); ?>
		<?php echo $form->textField($model, 'parent_id'); ?>
		<?php echo $form->error($model,'parent_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sort'); ?>
		<?php echo $form->textField($model, 'sort'); ?>
		<?php echo $form->error($model,'sort'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'create_uid'); ?>
		<?php echo $form->textField($model, 'create_uid'); ?>
		<?php echo $form->error($model,'create_uid'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'create_date'); ?>
		<?php echo $form->textField($model, 'create_date'); ?>
		<?php echo $form->error($model,'create_date'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'write_uid'); ?>
		<?php echo $form->textField($model, 'write_uid'); ?>
		<?php echo $form->error($model,'write_uid'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'write_date'); ?>
		<?php echo $form->textField($model, 'write_date'); ?>
		<?php echo $form->error($model,'write_date'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->