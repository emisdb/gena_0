<?php
/* @var $this TmpDocdController */
/* @var $model TmpDocd */

$this->breadcrumbs=array(
	'Tmp Docds'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TmpDocd', 'url'=>array('index')),
	array('label'=>'Manage TmpDocd', 'url'=>array('admin')),
);
?>

<h1>Create TmpDocd</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>