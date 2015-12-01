<?php
/* @var $this PicsController */
/* @var $model Pics */
/* @var $form CActiveForm */

$this->menu=array(
	array('label'=>'Повторить', 'url'=>array('xml')),
//	array('label'=>'Загрузить', 'url'=>array('cxml')),
	array('label'=>'Загрузка', 'url'=>array('admin')),
);
?>

<div class="form">

<?php 

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'file-form',
       'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Поля с <span class="required">*</span> обязательны.</p>

	<?php echo $form->errorSummary($ff); ?>

	<div class="row">
		<?php echo $form->labelEx($ff,'image'); ?>
		<?php echo $form->fileField($ff, 'image',array('size'=>60,'maxlength'=>128,'types'=>'xml')); ?>
		<?php echo $form->error($ff,'image'); ?>
		<p class="hint">
			Загрузка файла xml.
		</p>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Загрузить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->