<?php
/* @var $this TmpDocController */
/* @var $model TmpDoc */

$this->breadcrumbs=array(
	'Tmp Docs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TmpDoc', 'url'=>array('index')),
	array('label'=>'Create TmpDoc', 'url'=>array('create')),
	array('label'=>'View TmpDoc', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TmpDoc', 'url'=>array('admin')),
);
?>

<h1>Update TmpDoc <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>