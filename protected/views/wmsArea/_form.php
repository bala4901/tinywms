<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'wms-area-form',
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
		<?php echo $form->labelEx($model,'area_code'); ?>
		<?php echo $form->textArea($model, 'area_code'); ?>
		<?php echo $form->error($model,'area_code'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'wh_id'); ?>
		<?php echo $form->textField($model, 'wh_id'); ?>
		<?php echo $form->error($model,'wh_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'area_type_id'); ?>
		<?php echo $form->textField($model, 'area_type_id'); ?>
		<?php echo $form->error($model,'area_type_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->checkBox($model, 'active'); ?>
		<?php echo $form->error($model,'active'); ?>
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