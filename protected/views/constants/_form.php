<?php
/* @var $this ConstantsController */
/* @var $model Constants */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'constants-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля с <span class="required">*</span> обязательны.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'_key'); ?>
		<?php echo $form->textField($model,'_key',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'_key'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'_value'); ?>
		<?php echo $form->textField($model,'_value',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'_value'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->