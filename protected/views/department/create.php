<?php
/* @var $this DepartmentController */
/* @var $model Department */

$this->breadcrumbs=array(
	'Администрирование'=>array('/site/page','view'=>'admin'),
	'Подразделения'=>array('admin'),
	'Новый',
);

$this->menu=array(
//	array('label'=>'List City', 'url'=>array('index')),
	array('label'=>'Подразделения', 'url'=>array('admin')),
);
?>

<h1>Новое подразделение</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>