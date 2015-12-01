<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tnam'); ?>
		<?php echo $form->textField($model,'tnam',array('size'=>60,'maxlength'=>102)); ?>
		<?php echo $form->error($model,'tnam'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cgr'); ?>
		<?php echo $form->textField($model,'cgr'); ?>
		<?php echo $form->error($model,'cgr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'it'); ?>
		<?php echo $form->textField($model,'it'); ?>
		<?php echo $form->error($model,'it'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->