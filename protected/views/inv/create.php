<?php
/* @var $this InvController */
/* @var $model Inv */

$this->breadcrumbs=array(
	'Invs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Inv', 'url'=>array('index')),
	array('label'=>'Manage Inv', 'url'=>array('admin')),
);
?>

<h1>Create Inv</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>