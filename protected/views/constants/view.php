<?php
/* @var $this ConstantsController */
/* @var $model Constants */

$this->breadcrumbs=array(
	'Constants'=>array('index'),
	$model->_key,
);

$this->menu=array(
	array('label'=>'List Constants', 'url'=>array('index')),
	array('label'=>'Create Constants', 'url'=>array('create')),
	array('label'=>'Update Constants', 'url'=>array('update', 'id'=>$model->_key)),
	array('label'=>'Delete Constants', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->_key),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Constants', 'url'=>array('admin')),
);
?>

<h1>View Constants #<?php echo $model->_key; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'_key',
		'_value',
	),
)); ?>
