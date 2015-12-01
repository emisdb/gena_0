<?php
/* @var $this CityController */
/* @var $model City */

$this->breadcrumbs=array(
	'Администрирование'=>array('/site/page','view'=>'admin'),
	'ГОрода'=>array('admin'),
	'Новый',
);

$this->menu=array(
//	array('label'=>'List City', 'url'=>array('index')),
	array('label'=>'Города', 'url'=>array('admin')),
);
?>

<h1>Новый город</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>