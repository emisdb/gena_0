<?php
/* @var $this InvController */
/* @var $model Inv */

$this->breadcrumbs=array(
	'Invs'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Inv', 'url'=>array('index')),
	array('label'=>'Create Inv', 'url'=>array('create')),
	array('label'=>'Update Inv', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Inv', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Inv', 'url'=>array('admin')),
);
?>

<h1>View Inv #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'exp_id',
		'amount',
		'dateinserted',
		'date',
	),
)); ?>
