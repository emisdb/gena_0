<?php
/* @var $this IncController */
/* @var $model Inc */

$this->breadcrumbs=array(
	'Поступления'=>array('admin'),
	$model->name,
);
$this->menu=array(
//	array('label'=>'List Exp', 'url'=>array('index')),
	array('label'=>'Создать поступление', 'url'=>array('create')),
	array('label'=>'Журнал поступлений', 'url'=>array('admin')),
	array('label'=>'Редактировать поступление', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить поступление', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Уверены что хотите удалить этот расход?')),

);
?>

<h1>поступление #<?php echo $model->id; ?></h1>

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
		'link',
		'city_id',
		'account_id',
	),
)); ?>
