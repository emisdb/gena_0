<?php
/* @var $this ConstantsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Constants',
);

$this->menu=array(
	array('label'=>'Create Constants', 'url'=>array('create')),
	array('label'=>'Manage Constants', 'url'=>array('admin')),
);
?>

<h1>Constants</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
