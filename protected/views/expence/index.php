<?php
/* @var $this ExpenceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Expences',
);

$this->menu=array(
	array('label'=>'Create Expence', 'url'=>array('create')),
	array('label'=>'Manage Expence', 'url'=>array('admin')),
);
?>

<h1>Expences</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
