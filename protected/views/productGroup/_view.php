<?php
/* @var $this ProductGroupController */
/* @var $data ProductGroup */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('lf_key')); ?>:</b>
	<?php echo CHtml::encode($data->lf_key); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rg_key')); ?>:</b>
	<?php echo CHtml::encode($data->rg_key); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('level')); ?>:</b>
	<?php echo CHtml::encode($data->level); ?>
	<br />


</div>