<?php
/* @var $this ExpenceController */
/* @var $model Expence */

$this->breadcrumbs=array(
	'Администрирование'=>array('/site/page','view'=>'admin'),
	'Статьи затрат'=>array('admin'),
	'Новый',
);

$this->menu=array(
//	array('label'=>'List Expence', 'url'=>array('index')),
	array('label'=>'Статьи затрат', 'url'=>array('admin')),
);
?>

<h1>Новая статья затрат</h1>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>