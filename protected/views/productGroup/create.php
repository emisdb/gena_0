<?php
/* @var $this ProductGroupController */
/* @var $model ProductGroup */

$this->breadcrumbs=array(
	'Product Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductGroup', 'url'=>array('index')),
	array('label'=>'Manage ProductGroup', 'url'=>array('admin')),
);
?>

<h1>Create ProductGroup</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>