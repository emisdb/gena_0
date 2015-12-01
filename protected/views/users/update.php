<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Администрирование'=>array('/site/page','view'=>'admin'),
	'Пользователи'=>array('admin'),
//	$model->name=>array('view','id'=>$model->id),
	'Редакция',
);

$this->menu=array(
//	array('label'=>'List Account', 'url'=>array('index')),
	array('label'=>'Новый пользователь', 'url'=>array('create')),
//	array('label'=>'View Account', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Пользователи', 'url'=>array('admin')),
);
?>

<h1>Редакция пользователя <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>