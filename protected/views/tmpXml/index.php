<?php
/* @var $this TmpXmlController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tmp Xmls',
);

$this->menu=array(
	array('label'=>'Create TmpXml', 'url'=>array('create')),
	array('label'=>'Manage TmpXml', 'url'=>array('admin')),
);
?>

<h1>Tmp Xmls</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
