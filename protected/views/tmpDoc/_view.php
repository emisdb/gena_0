<?php
/* @var $this TmpDocController */
/* @var $data TmpDoc */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ckey')); ?>:</b>
	<?php echo CHtml::encode($data->ckey); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ctype')); ?>:</b>
	<?php echo CHtml::encode($data->ctype); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tnum')); ?>:</b>
	<?php echo CHtml::encode($data->tnum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cfir')); ?>:</b>
	<?php echo CHtml::encode($data->cfir); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ddat')); ?>:</b>
	<?php echo CHtml::encode($data->ddat); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ccli')); ?>:</b>
	<?php echo CHtml::encode($data->ccli); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bsum')); ?>:</b>
	<?php echo CHtml::encode($data->bsum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tonum')); ?>:</b>
	<?php echo CHtml::encode($data->tonum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dodat')); ?>:</b>
	<?php echo CHtml::encode($data->dodat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('docid')); ?>:</b>
	<?php echo CHtml::encode($data->docid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('docinfo')); ?>:</b>
	<?php echo CHtml::encode($data->docinfo); ?>
	<br />

	*/ ?>

</div>