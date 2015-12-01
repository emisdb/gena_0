<?php
/* @var $this ClientController */
/* @var $model Client */
/* @var $form CActiveForm 
Yii::app()->clientScript->registerScriptFile(  Yii::app()->assetManager->publish('js/form.js' ), CClientScript::POS_HEAD);
*/
?>

<div class="form">

<?php 
/*
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'Country',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Выбрать страну',
		'width'=>'620px',
//		'height'=>'450px',
        'modal'=>'true',
       'autoOpen'=>false,
    ),
));

$this->widget('ext.EMenu', array(
              'model_name' =>'Country',
//				'relation_name' =>'clients',
				'top_name' =>'name',
				'bottom_name' =>'name',
				'picktopvalue'=>'id',
//				'pickbottomvalue'=>'id',
				'pickfunction'=>'setvaluecli',
				'url_name' =>'javascript:void(0);',
			  'vertical'=>'true',
			  'theme'=>'default',
));

$this->endWidget('zii.widgets.jui.CJuiDialog');	
*/
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'client-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля с <span class="required">*</span> обязательны.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php 
/*
		echo $form->labelEx($model,'country_id'); 
		 echo $form->textField($model,'countryname',array('length'=>'30','readonly'=>'readonly')); 
		 echo CHtml::button("...",array('onclick'=>'pickValue("country");')); 
		 echo $form->hiddenField($model,'country_id'); 
		 echo $form->error($model,'concert_id'); 
*/
		 ?>

		<?php echo $form->labelEx($model,'country_id'); ?>
		<?php 
		$list = CHtml::listData(Country::model()->findAll(),'id', 'name');	
		echo $form->DropDownList($model,'country_id',$list);
	//	echo $form->textField($model,'country_id'); 
		?>
		<?php echo $form->error($model,'country_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->