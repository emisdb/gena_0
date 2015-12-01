<?php
/* @var $this TmpDocdController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tmp Docds',
);

$this->menu=array(
	array('label'=>'Create TmpDocd', 'url'=>array('create')),
	array('label'=>'Manage TmpDocd', 'url'=>array('admin')),
);
?>

<h1>Tmp Docds</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
