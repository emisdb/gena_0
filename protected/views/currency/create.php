<?php
/* @var $this CurrencyController */
/* @var $model Currency */

$this->breadcrumbs=array(
	'Администрирование'=>array('/site/page','view'=>'admin'),
	'Валюты'=>array('admin'),
	'Новый',
);

$this->menu=array(
//	array('label'=>'List City', 'url'=>array('index')),
	array('label'=>'Валюты', 'url'=>array('admin')),
);
?>

<h1>Новая валюта</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>