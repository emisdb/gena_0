<?php
/* @var $this TmpDocController */
/* @var $model TmpDoc */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ckey'); ?>
		<?php echo $form->textField($model,'ckey',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ctype'); ?>
		<?php echo $form->textField($model,'ctype'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tnum'); ?>
		<?php echo $form->textField($model,'tnum',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cfir'); ?>
		<?php echo $form->textField($model,'cfir',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'state'); ?>
		<?php echo $form->textField($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ddat'); ?>
		<?php echo $form->textField($model,'ddat'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ccli'); ?>
		<?php echo $form->textField($model,'ccli',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bsum'); ?>
		<?php echo $form->textField($model,'bsum',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tonum'); ?>
		<?php echo $form->textField($model,'tonum',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dodat'); ?>
		<?php echo $form->textField($model,'dodat'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'docid'); ?>
		<?php echo $form->textField($model,'docid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'docinfo'); ?>
		<?php echo $form->textField($model,'docinfo',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->