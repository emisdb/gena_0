<?php
/* @var $this ProductGroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Product Groups',
);

$this->menu=array(
	array('label'=>'Create ProductGroup', 'url'=>array('create')),
	array('label'=>'Manage ProductGroup', 'url'=>array('admin')),
);
?>

<h1>Product Groups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
