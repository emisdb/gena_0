<?php
/* @var $this TmpXmlController */
/* @var $model TmpXml */

$this->breadcrumbs=array(
	'Tmp Xmls'=>array('admin'),
);

$this->menu=array(
	array('label'=>'List TmpXml', 'url'=>array('index')),
	array('label'=>'Create TmpXml', 'url'=>array('create')),
	array('label'=>'Manage TmpXml', 'url'=>array('admin')),
);
?>

<h1>Результат переноса:</h1>

<?php 
echo "RES:".$model;
?>
