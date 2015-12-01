
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pay-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля с пометкой  <span class="required">*</span> обязательны.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'name'); ?>
		<?php echo $form->hiddenField($model,'exp_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount',array('style'=>'text-align:right')); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>
	<div class="row">
		<?php 
			echo $form->labelEx($model,'date');  
			 $this->widget('zii.widgets.jui.CJuiDatePicker',
			 array(
				  'name'=>'Pay[date]',
				  'attribute'=>'date', // Model attribute filed which hold user input
				  'model'=>$model,            // Model name
				  'theme'=>'redmond',
//				  'value'=>date('Y-m-d'),
					'options'=>array(
						'showAnim'=>'fold',
						'dateFormat'=>'yy-mm-dd',
					),
					'htmlOptions'=>array('size'=>15),
//				  'fontSize'=>'0.8em'
				 )
			  );	
	
			echo $form->error($model,'date'); ?>
	</div>
	<div class="row">
		<?php 
			echo $form->labelEx($model,'date_g');  
			 $this->widget('zii.widgets.jui.CJuiDatePicker',
			 array(
				  'name'=>'Pay[date_g]',
				  'attribute'=>'date_g', // Model attribute filed which hold user input
				  'model'=>$model,            // Model name
				  'theme'=>'redmond',
//				  'value'=>date('Y-m-d'),
					'options'=>array(
						'showAnim'=>'fold',
						'dateFormat'=>'yy-mm-dd',
					),
					'htmlOptions'=>array('size'=>15),
//				  'fontSize'=>'0.8em'
				 )
			  );	
                        echo " Ноль:";
			echo $form->checkBox($model,'dg_null'); 
			echo $form->error($model,'date_g');	
 ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php 
	echo "<script type=\"text/javascript\">\n";
        echo "jQuery(function($) {";
	echo "jQuery('#Pay_date').datepicker({'showAnim':'fold','dateFormat':'yy-mm-dd'});\n";
	echo "jQuery('#Pay_date_g').datepicker({'showAnim':'fold','dateFormat':'yy-mm-dd'});\n";        
	echo "jQuery('#Pay_date_g').datepicker({onSelect: function() { jQuery(this).change(); }});\n";        
	echo "jQuery('#Pay_date_g').change(function() { jQuery('#Pay_dg_null').attr('checked', false);});\n";
	echo "jQuery('#Pay_dg_null').change(function() { if(jQuery(this).attr('checked')){jQuery('#Pay_date_g').val('');}});\n";
if ($model->isNewRecord)
{
	echo "jQuery('#Pay_date').val('".date('Y-m-d')."');";
 
} 
echo "});\n";
echo "</script>\n";

 ?>