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

	<?php
 	if($model->hasErrors())
	{
		echo '<div class="callout callout-danger">'.$form->errorSummary($model).'</div>';
	}

	?>
	<div class="row">
		<div class="col-md-3">
                    <h4>Настройки строк:</h4>
		</div>
		<div class="col-md-5">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'n_str'); 
					echo $form->textField($model,'n_str',array('class'=>'form-control'));
					echo $form->error($model,'n_str'); 
				 ?>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'n_fin'); 
					echo $form->textField($model,'n_fin',array('class'=>'form-control'));
					echo $form->error($model,'n_fin'); 
				 ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
                    <h4>Настройки столбцов:</h4>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'n_nom'); 
					echo $form->textField($model,'n_nom',array('class'=>'form-control'));
					echo $form->error($model,'n_nom'); 
				 ?>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'n_art'); 
					echo $form->textField($model,'n_art',array('class'=>'form-control'));
					echo $form->error($model,'n_art'); 
				 ?>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'n_price'); 
					echo $form->textField($model,'n_price',array('class'=>'form-control'));
					echo $form->error($model,'n_price'); 
				 ?>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'n_quant'); 
					echo $form->textField($model,'n_quant',array('class'=>'form-control'));
					echo $form->error($model,'n_fn_quantin'); 
				 ?>
			</div>
		</div>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->fileField($model, 'image',array('size'=>60,'maxlength'=>128,'types'=>'csv','class'=>'btn btn-primary')); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Загрузить',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->