<?php
/* @var $this ConcertController */
/* @var $model Concert */

$this->breadcrumbs=array(
	'Администрирование'=>array('/site/page','view'=>'admin'),
	'Концерты'=>array('admin'),
//	$model->name=>array('view','id'=>$model->id),
	'Редакция',
);

$this->menu=array(
//	array('label'=>'List Expence', 'url'=>array('index')),
	array('label'=>'Новый концерт', 'url'=>array('create')),
//	array('label'=>'View Expence', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Концерты', 'url'=>array('admin')),
);
?>

<h1>Редактировать концерт<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>