<?php
/* @var $this TmpDocdController */
/* @var $data TmpDocd */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ckey')); ?>:</b>
	<?php echo CHtml::encode($data->ckey); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cnom')); ?>:</b>
	<?php echo CHtml::encode($data->cnom); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bsum')); ?>:</b>
	<?php echo CHtml::encode($data->bsum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bqua')); ?>:</b>
	<?php echo CHtml::encode($data->bqua); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bvat')); ?>:</b>
	<?php echo CHtml::encode($data->bvat); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('bpri')); ?>:</b>
	<?php echo CHtml::encode($data->bpri); ?>
	<br />

	*/ ?>

</div>