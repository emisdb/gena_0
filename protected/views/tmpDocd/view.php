<?php
/* @var $this TmpDocdController */
/* @var $model TmpDocd */

$this->breadcrumbs=array(
	'Tmp Docds'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TmpDocd', 'url'=>array('index')),
	array('label'=>'Create TmpDocd', 'url'=>array('create')),
	array('label'=>'Update TmpDocd', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TmpDocd', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TmpDocd', 'url'=>array('admin')),
);
?>

<h1>View TmpDocd #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'ckey',
		'cnom',
		'state',
		'bsum',
		'bqua',
		'bvat',
		'bpri',
	),
)); ?>
