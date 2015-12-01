<?php
/* @var $this InvController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Invs',
);

$this->menu=array(
	array('label'=>'Create Inv', 'url'=>array('create')),
	array('label'=>'Manage Inv', 'url'=>array('admin')),
);
?>

<h1>Invs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
