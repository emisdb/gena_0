<?php
/* @var $this CurrencyController */
/* @var $model Currency */

$this->breadcrumbs=array(
	'Администрирование'=>array('/site/page','view'=>'admin'),
	'Валюты'=>array('admin'),
//	$model->name=>array('view','id'=>$model->id),
	'Редакция',
);

$this->menu=array(
//	array('label'=>'List Account', 'url'=>array('index')),
	array('label'=>'Новая валюта', 'url'=>array('create')),
//	array('label'=>'View Account', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Валюты', 'url'=>array('admin')),
);
?>

<h1>Редакция валюты <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>