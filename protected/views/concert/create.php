<?php
/* @var $this ConcertController */
/* @var $model Concert */

$this->breadcrumbs=array(
	'Администрирование'=>array('/site/page','view'=>'admin'),
	'Концерты'=>array('admin'),
	'Новый',
);

$this->menu=array(
//	array('label'=>'List Concert', 'url'=>array('index')),
	array('label'=>'Концерты', 'url'=>array('admin')),
);
?>

<h1>Новый концерт</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>