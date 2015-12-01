<?php
/* @var $this TmpDocController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tmp Docs',
);

$this->menu=array(
	array('label'=>'Create TmpDoc', 'url'=>array('create')),
	array('label'=>'Manage TmpDoc', 'url'=>array('admin')),
);
?>

<h1>Tmp Docs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
