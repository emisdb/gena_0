<?php
/* @var $this PayController */
/* @var $model Pay */

$this->breadcrumbs=array(
	'Журнал платежей'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Редакция',
);

$this->menu=array(
//	array('label'=>'List Exp', 'url'=>array('index')),
	array('label'=>'Создать платеж', 'url'=>array('create')),
//	array('label'=>'View Exp', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Журнал платежей', 'url'=>array('admin')),
);
?>

<h1>Редактировать платеж по счету <?php echo $model->exp->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>