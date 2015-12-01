<?php
/* @var $this ConstantsController */
/* @var $model Constants */

$this->breadcrumbs=array(
	'Constants'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Constants', 'url'=>array('index')),
	array('label'=>'Manage Constants', 'url'=>array('admin')),
);
?>

<h1>Create Constants</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>