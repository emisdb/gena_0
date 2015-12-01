<?php
/* @var $this ExpController */
/* @var $model Exp */

$this->breadcrumbs=array(
	'Журнал расходов'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Редакция',
);

$this->menu=array(
//	array('label'=>'List Exp', 'url'=>array('index')),
	array('label'=>'Создать расход', 'url'=>array('create')),
//	array('label'=>'View Exp', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Журнал расходов', 'url'=>array('admin')),
);
?>

<h1>Редактировать расход <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'ff'=>$ff)); ?>