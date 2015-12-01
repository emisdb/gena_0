<?php
/* @var $this ExpController */
/* @var $model Exp */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScriptFile(  Yii::app()->assetManager->publish('js/form.js' ), CClientScript::POS_HEAD);

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'Country',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Выбрать клиента',
		'width'=>'620px',
//		'height'=>'450px',
        'modal'=>'true',
       'autoOpen'=>false,
    ),
));/**/

$this->widget('ext.EMenu', array(
              'model_name' =>'Country',
				'relation_name' =>'clients',
				'top_name' =>'name',
				'bottom_name' =>'name',
				'picktopvalue'=>'',
				'pickbottomvalue'=>'id',
				'pickfunction'=>'setvalue',
				'url_name' =>'javascript:void(0);',
			  'vertical'=>'true',
			  'theme'=>'default',
));

$this->endWidget('zii.widgets.jui.CJuiDialog');	
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'Concert',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Выбрать концерт',
		'width'=>'620px',
//		'height'=>'450px',
        'modal'=>'true',
       'autoOpen'=>false,
    ),
));/**/

$this->widget('ext.EMenu', array(
              'model_name' =>'Concert',
				'top_name' =>'name',
				'bottom_name' =>'name',
				'picktopvalue'=>'id',
				'pickfunction'=>'setvalue',
				'url_name' =>'javascript:void(0);',
			  'vertical'=>'true',
			  'theme'=>'default',
));

$this->endWidget('zii.widgets.jui.CJuiDialog');	
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'Expence',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Выбрать вид расхода',
		'width'=>'620px',
//		'height'=>'450px',
        'modal'=>'true',
       'autoOpen'=>false,
    ),
));/**/

$this->widget('ext.EMenu', array(
              'model_name' =>'Expence',
				'top_name' =>'name',
				'bottom_name' =>'name',
				'picktopvalue'=>'id',
				'pickfunction'=>'setvalue',
				'url_name' =>'javascript:void(0);',
			  'vertical'=>'true',
			  'theme'=>'default',
));

$this->endWidget('zii.widgets.jui.CJuiDialog');	
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'Department',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Выбрать отдел',
		'width'=>'620px',
//		'height'=>'450px',
        'modal'=>'true',
       'autoOpen'=>false,
    ),
));/**/

$this->widget('ext.EMenu', array(
              'model_name' =>'Department',
				'top_name' =>'name',
				'bottom_name' =>'name',
				'picktopvalue'=>'id',
				'pickfunction'=>'setvalue',
				'url_name' =>'javascript:void(0);',
			  'vertical'=>'true',
			  'theme'=>'default',
));

$this->endWidget('zii.widgets.jui.CJuiDialog');	
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'Account',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Выбрать расч. счет',
		'width'=>'620px',
//		'height'=>'450px',
        'modal'=>'true',
       'autoOpen'=>false,
    ),
));/**/

$this->widget('ext.EMenu', array(
              'model_name' =>'Account',
				'top_name' =>'name',
				'bottom_name' =>'name',
				'picktopvalue'=>'id',
				'pickfunction'=>'setvaluepay',
				'url_name' =>'javascript:void(0);',
			  'vertical'=>'true',
			  'theme'=>'default',
));

$this->endWidget('zii.widgets.jui.CJuiDialog');	
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'exp-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Поля с пометкой  <span class="required">*</span> обязательны.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php 
			echo $form->labelEx($model,'date');  
			 $this->widget('zii.widgets.jui.CJuiDatePicker',
			 array(
				  'name'=>'Exp[date]',
				  'attribute'=>'date', // Model attribute filed which hold user input
				  'model'=>$model,            // Model name
				  'theme'=>'redmond',
//				  'value'=>date('Y-m-d'),
				  'value'=>$model->isNewRecord ? date('Y-m-d') : '',
					'options'=>array(
						'showAnim'=>'fold',
						'dateFormat'=>'yy-mm-dd',
					),
					'htmlOptions'=>array('size'=>15),
					
//				  'fontSize'=>'0.8em'
				 )
			  );	
	
//			echo $form->textField($model,'date'); 
			echo $form->error($model,'date'); 
			?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'client_id'); ?>
		<?php echo $form->textField($model,'cliname',array('length'=>'30','readonly'=>'readonly')); ?>
		<?php echo CHtml::button("...",array('onclick'=>'pickValue("client");')); ?>
		<?php echo $form->hiddenField($model,'client_id'); ?>
		<?php echo $form->error($model,'client_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'department_id'); ?>
		<?php echo $form->textField($model,'depname',array('length'=>'30','readonly'=>'readonly')); ?>
		<?php echo CHtml::button("...",array('onclick'=>'pickValue("department");')); ?>
		<?php echo $form->hiddenField($model,'department_id'); ?>
		<?php echo $form->error($model,'department_id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'concert_id'); ?>
		<?php echo $form->textField($model,'concertname',array('length'=>'30','readonly'=>'readonly')); ?>
		<?php echo CHtml::button("...",array('onclick'=>'pickValue("concert");')); ?>
		<?php echo $form->hiddenField($model,'concert_id'); ?>
		<?php echo $form->error($model,'concert_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city_id'); ?>
		<?php 
		$list = CHtml::listData(City::model()->findAll(),'id', 'name');	
		echo $form->DropDownList($model,'city_id',$list);
	//	echo $form->textField($model,'city_id'); 
		?>
		<?php echo $form->error($model,'city_id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'expence_id'); ?>
		<?php echo $form->textField($model,'expname',array('length'=>'30','readonly'=>'readonly')); ?>
		<?php echo CHtml::button("...",array('onclick'=>'pickValue("expence");')); ?>
		<?php echo $form->hiddenField($model,'expence_id'); ?>
		<?php echo $form->error($model,'expence_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'currency_id'); ?>
		<?php 
			$list = CHtml::listData(Currency::model()->findAll(),'id', 'name');	
			echo $form->DropDownList($model,'currency_id',$list);
			// echo $form->textField($model,'currency_id'); 
		?>
		<?php echo $form->error($model,'currency_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($modelp,'name'); ?>
		<?php echo $form->textField($modelp,'name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($modelp,'name'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($modelp,'account_id'); ?>
		<?php echo $form->textField($modelp,'accname',array('length'=>'30','readonly'=>'readonly')); ?>
		<?php echo CHtml::button("...",array('onclick'=>'pickValue("account");')); ?>
		<?php echo $form->hiddenField($modelp,'account_id'); ?>
		<?php echo $form->error($modelp,'account_id'); ?>
	</div>



<?php

?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ?'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
<?php if ($model->isNewRecord)
{
	echo "<script type=\"text/javascript\">";
	echo "jQuery('#Exp_date').val('".date('Y-m-d')."')";
	echo "</script>";
}
 ?>

<!-- form -->