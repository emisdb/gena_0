<?php
/* @var $this ExpenceController */
/* @var $model Expence */

$this->breadcrumbs=array(
	'Администрирование'=>array('/site/page','view'=>'admin'),
	'Статьи затрат'=>array('admin'),
	$model->name,
);

$this->menu=array(
//	array('label'=>'List Expence', 'url'=>array('index')),
	array('label'=>'Новая статья затрат', 'url'=>array('create')),
//	array('label'=>'View Expence', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Удалить статью', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Статьи затрат', 'url'=>array('admin')),
);
?>

<h1>Статья затрат #<?php echo $model->id; ?></h1>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'type',
	),
)); ?>
