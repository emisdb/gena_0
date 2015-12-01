<?php
/* @var $this TmpDocdController */
/* @var $model TmpDocd */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tmp-docd-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ckey'); ?>
		<?php echo $form->textField($model,'ckey'); ?>
		<?php echo $form->error($model,'ckey'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cnom'); ?>
		<?php echo $form->textField($model,'cnom',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'cnom'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state'); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bsum'); ?>
		<?php echo $form->textField($model,'bsum',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'bsum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bqua'); ?>
		<?php echo $form->textField($model,'bqua',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'bqua'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bvat'); ?>
		<?php echo $form->textField($model,'bvat',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'bvat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bpri'); ?>
		<?php echo $form->textField($model,'bpri',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'bpri'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->