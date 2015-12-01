<?php
/* @var $this TmpDocController */
/* @var $model TmpDoc */

$this->breadcrumbs=array(
	'Tmp Docs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TmpDoc', 'url'=>array('index')),
	array('label'=>'Manage TmpDoc', 'url'=>array('admin')),
);
?>

<h1>Create TmpDoc</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>