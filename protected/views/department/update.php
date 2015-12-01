<?php
/* @var $this DepartmentController */
/* @var $model Department */

$this->breadcrumbs=array(
	'Администрирование'=>array('/site/page','view'=>'admin'),
	'Подразделения'=>array('admin'),
//	$model->name=>array('view','id'=>$model->id),
	'Редакция',
);

$this->menu=array(
//	array('label'=>'List Account', 'url'=>array('index')),
	array('label'=>'Новое подразделение', 'url'=>array('create')),
//	array('label'=>'View Account', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Подразделения', 'url'=>array('admin')),
);
?>

<h1>Редакция подразделения <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>