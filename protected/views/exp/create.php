<?php
/* @var $this ExpController */
/* @var $model Exp */

$this->breadcrumbs=array(
	'Расходы'=>array('admin'),
	'Новый',
);

$this->menu=array(
	array('label'=>'Журнал расходов', 'url'=>array('admin')),
);
?>

<h1>Новый расход</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'ff'=>$ff)); ?>