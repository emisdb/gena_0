<?php
/* @var $this IncController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Incs',
);

$this->menu=array(
	array('label'=>'Create Inc', 'url'=>array('create')),
	array('label'=>'Manage Inc', 'url'=>array('admin')),
);
?>

<h1>Incs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
