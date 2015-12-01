<?php
/* @var $this CountryController */
/* @var $model Country */

$this->breadcrumbs=array(
	'Администрирование'=>array('/site/page','view'=>'admin'),
	'Страны'=>array('admin'),
//	$model->name=>array('view','id'=>$model->id),
	'Редакция',
);

$this->menu=array(
//	array('label'=>'List Account', 'url'=>array('index')),
	array('label'=>'Новая страна', 'url'=>array('create')),
//	array('label'=>'View Account', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Страны', 'url'=>array('admin')),
);
?>

<h1>Редакция страны <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>