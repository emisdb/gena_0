<?php
/* @var $this ConstantsController */
/* @var $model Constants */

$this->breadcrumbs=array(
	'Constants'=>array('index'),
	$model->_key=>array('view','id'=>$model->_key),
	'Update',
);

$this->menu=array(
	array('label'=>'List Constants', 'url'=>array('index')),
	array('label'=>'Create Constants', 'url'=>array('create')),
	array('label'=>'View Constants', 'url'=>array('view', 'id'=>$model->_key)),
	array('label'=>'Manage Constants', 'url'=>array('admin')),
);
?>

<h1>Update Constants <?php echo $model->_key; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>