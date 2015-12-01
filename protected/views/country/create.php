<?php
/* @var $this CountryController */
/* @var $model Country */

$this->breadcrumbs=array(
	'Администрирование'=>array('/site/page','view'=>'admin'),
	'Страны'=>array('admin'),
	'Новый',
);

$this->menu=array(
//	array('label'=>'List City', 'url'=>array('index')),
	array('label'=>'Страны', 'url'=>array('admin')),
);
?>

<h1>Новая страна</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>