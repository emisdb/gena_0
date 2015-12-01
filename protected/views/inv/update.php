<?php
/* @var $this InvController */
/* @var $model Inv */

$this->breadcrumbs=array(
	'Invs'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Inv', 'url'=>array('index')),
	array('label'=>'Create Inv', 'url'=>array('create')),
	array('label'=>'View Inv', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Inv', 'url'=>array('admin')),
);
?>

<h1>Update Inv <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>