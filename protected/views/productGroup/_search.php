<?php
/* @var $this ProductGroupController */
/* @var $model ProductGroup */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ckey'); ?>
		<?php echo $form->textField($model,'ckey'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tnam'); ?>
		<?php echo $form->textField($model,'tnam',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cgr'); ?>
		<?php echo $form->textField($model,'cgr'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lf_key'); ?>
		<?php echo $form->textField($model,'lf_key'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rg_key'); ?>
		<?php echo $form->textField($model,'rg_key'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'level'); ?>
		<?php echo $form->textField($model,'level'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->