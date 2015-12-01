<?php
/* @var $this PayController */
/* @var $model Pay */

$this->breadcrumbs=array(
	'Платежи'=>array('admin'),
	$model->name,
);

$this->menu=array(
//	array('label'=>'List Exp', 'url'=>array('index')),
	array('label'=>'Создать платеж', 'url'=>array('create')),
	array('label'=>'Журнал платежей', 'url'=>array('admin')),
	array('label'=>'Редактировать платеж', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить платеж', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Уверены что хотите удалить этот платеж?')),
	array('label'=>'Новые комиссии',  'url'=>array('createN', 'id'=>$model->exp_id),'visible'=>$model->exp_id != null,'linkOptions'=>array('target'=>'_blank') ),

);
?>

<h1>Платеж №<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'exp_id',
		'amount',
		'dateinserted',
		'date',
		'accname',
	),
)); ?>
