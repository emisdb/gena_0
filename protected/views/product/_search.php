<?php
/* @var $this ProductController */
/* @var $model Product */
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
		<?php echo $form->textField($model,'tnam',array('size'=>60,'maxlength'=>102)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cgr'); ?>
		<?php echo $form->textField($model,'cgr'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'it'); ?>
		<?php echo $form->textField($model,'it'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->