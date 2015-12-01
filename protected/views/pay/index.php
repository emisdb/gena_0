<?php
/* @var $this PayController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pays',
);

$this->menu=array(
	array('label'=>'Create Pay', 'url'=>array('create')),
	array('label'=>'Manage Pay', 'url'=>array('admin')),
);
?>

<h1>Pays</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
