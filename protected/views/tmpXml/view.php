<?php
/* @var $this TmpXmlController */
/* @var $model TmpXml */

$this->breadcrumbs=array(
	'Tmp Xmls'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TmpXml', 'url'=>array('index')),
	array('label'=>'Create TmpXml', 'url'=>array('create')),
	array('label'=>'Update TmpXml', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TmpXml', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TmpXml', 'url'=>array('admin')),
);
?>

<h1>View TmpXml #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'ckey',
		'ctype',
		'cname',
		'lid',
		'lname',
		'state',
	),
)); ?>
