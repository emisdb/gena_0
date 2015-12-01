<?php
/* @var $this ExpController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Exps',
);

$this->menu=array(
	array('label'=>'Create Exp', 'url'=>array('create')),
	array('label'=>'Manage Exp', 'url'=>array('admin')),
);
?>

<h1>Exps</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
