<?php
/* @var $this ItemController */
/* @var $data Item */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sh_name')); ?>:</b>
	<?php echo CHtml::encode($data->sh_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('okei')); ?>:</b>
	<?php echo CHtml::encode($data->okei); ?>
	<br />


</div>