<?php
/* @var $this ProductGroupController */
/* @var $model ProductGroup */

$this->breadcrumbs=array(
	'Product Groups'=>array('index'),
	$model->ckey,
);

$this->menu=array(
	array('label'=>'List ProductGroup', 'url'=>array('index')),
	array('label'=>'Create ProductGroup', 'url'=>array('create')),
	array('label'=>'Update ProductGroup', 'url'=>array('update', 'id'=>$model->ckey)),
	array('label'=>'Delete ProductGroup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ckey),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductGroup', 'url'=>array('admin')),
);
?>

<h1>View ProductGroup #<?php echo $model->ckey; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ckey',
		'tnam',
		'cgr',
		'lf_key',
		'rg_key',
		'level',
	),
)); ?>
