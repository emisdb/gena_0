<?php
/* @var $this TmpDocController */
/* @var $model TmpDoc */

$this->breadcrumbs=array(
	'Tmp Docs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TmpDoc', 'url'=>array('index')),
	array('label'=>'Create TmpDoc', 'url'=>array('create')),
	array('label'=>'Update TmpDoc', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TmpDoc', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TmpDoc', 'url'=>array('admin')),
);
?>

<h1>View TmpDoc #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'ckey',
		'ctype',
		'tnum',
		'cfir',
		'state',
		'ddat',
		'ccli',
		'bsum',
		'tonum',
		'dodat',
		'docid',
		'docinfo',
	),
)); ?>
