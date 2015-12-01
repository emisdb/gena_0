<?php
/* @var $this TmpDocController */
/* @var $model TmpDoc */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tmp-doc-form',
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
		<?php echo $form->textField($model,'ckey',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'ckey'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ctype'); ?>
		<?php echo $form->textField($model,'ctype'); ?>
		<?php echo $form->error($model,'ctype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tnum'); ?>
		<?php echo $form->textField($model,'tnum',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'tnum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cfir'); ?>
		<?php echo $form->textField($model,'cfir',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'cfir'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state'); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ddat'); ?>
		<?php echo $form->textField($model,'ddat'); ?>
		<?php echo $form->error($model,'ddat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ccli'); ?>
		<?php echo $form->textField($model,'ccli',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'ccli'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bsum'); ?>
		<?php echo $form->textField($model,'bsum',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'bsum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tonum'); ?>
		<?php echo $form->textField($model,'tonum',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'tonum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dodat'); ?>
		<?php echo $form->textField($model,'dodat'); ?>
		<?php echo $form->error($model,'dodat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'docid'); ?>
		<?php echo $form->textField($model,'docid'); ?>
		<?php echo $form->error($model,'docid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'docinfo'); ?>
		<?php echo $form->textField($model,'docinfo',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'docinfo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->