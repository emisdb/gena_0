<?php
/* @var $this ConstantsController */
/* @var $data Constants */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('_key')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->_key), array('view', 'id'=>$data->_key)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('_value')); ?>:</b>
	<?php echo CHtml::encode($data->_value); ?>
	<br />


</div>