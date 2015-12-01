<?php
/* @var $this ExpController */
/* @var $model Exp */

$this->breadcrumbs=array(
	'Расходы'=>array('admin'),
	$model->name,
);

$this->menu=array(
//	array('label'=>'List Exp', 'url'=>array('index')),
	array('label'=>'Создать расход', 'url'=>array('create')),
	array('label'=>'Журнал расходов', 'url'=>array('admin')),
	array('label'=>'Редактировать расход', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить расход', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Уверены что хотите удалить этот расход?')),

);
?>

<h1>Расход #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'client_id',
		'department_id',
		'users_id',
		'concert_id',
		'expence_id',
		'currency_id',
		'amount',
		'dateinserted',
		'date',
		'pay',
		'link',
		'city_id',
	),
)); ?>
