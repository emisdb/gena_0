<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Администрирование'=>array('/site/page','view'=>'admin'),
	'Пользователи'=>array('admin'),
	'Новый',
);

$this->menu=array(
//	array('label'=>'List City', 'url'=>array('index')),
	array('label'=>'Пользователи', 'url'=>array('admin')),
);
?>

<h1>Новый пользователь</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>