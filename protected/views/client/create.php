<?php
/* @var $this ClientController */
/* @var $model Client */

$this->breadcrumbs=array(
	'Администрирование'=>array('/site/page','view'=>'admin'),
	'Контрагенты'=>array('admin'),
	'Новый',
);

$this->menu=array(
//	array('label'=>'List Concert', 'url'=>array('index')),
	array('label'=>'Контрагенты', 'url'=>array('admin')),
);
?>

<h1>Новый контрагент</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>