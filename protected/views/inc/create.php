<?php
/* @var $this IncController */
/* @var $model Inc */

$this->breadcrumbs=array(
	'Поступления'=>array('admin'),
	'Новый',
);

$this->menu=array(
	array('label'=>'Журнал поступлений', 'url'=>array('admin')),
);
?>

<h1>Новое поступление</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'ff'=>$ff)); ?>