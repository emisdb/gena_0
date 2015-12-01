<?php
/* @var $this TmpXmlController */
/* @var $model TmpXml */

$this->breadcrumbs=array(
	'Tmp Xmls'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TmpXml', 'url'=>array('index')),
	array('label'=>'Manage TmpXml', 'url'=>array('admin')),
);
?>

<h1>Create TmpXml</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>