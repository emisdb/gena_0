<?php
/* @var $this IncController */
/* @var $model Inc */

$this->breadcrumbs=array(
	'Журнал поступлений'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Редакция',
);

$this->menu=array(
//	array('label'=>'List Exp', 'url'=>array('index')),
	array('label'=>'Создать поступление', 'url'=>array('create')),
//	array('label'=>'View Exp', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Журнал поступлений', 'url'=>array('admin')),
);
?>

<h1>Редактировать поступление <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'ff'=>$ff)); ?>