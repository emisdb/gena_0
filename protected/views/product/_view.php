<?php
/* @var $this ProductController */
/* @var $data Product */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ckey')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ckey), array('view', 'id'=>$data->ckey)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tnam')); ?>:</b>
	<?php echo CHtml::encode($data->tnam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cgr')); ?>:</b>
	<?php echo CHtml::encode($data->cgr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('it')); ?>:</b>
	<?php echo CHtml::encode($data->it); ?>
	<br />


</div>