<?php
/* @var $this CityController */
/* @var $model City */

$this->breadcrumbs=array(
	'Администрирование'=>array('/site/page','view'=>'admin'),
	'Города'=>array('admin'),
//	$model->name=>array('view','id'=>$model->id),
	'Редакция',
);

$this->menu=array(
//	array('label'=>'List Account', 'url'=>array('index')),
	array('label'=>'Новый город', 'url'=>array('create')),
//	array('label'=>'View Account', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Города', 'url'=>array('admin')),
);
?>

<h1>Редакция города<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>