<?php
/* @var $this TmpDocdController */
/* @var $model TmpDocd */

$this->breadcrumbs=array(
	'Tmp Docds'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TmpDocd', 'url'=>array('index')),
	array('label'=>'Create TmpDocd', 'url'=>array('create')),
	array('label'=>'View TmpDocd', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TmpDocd', 'url'=>array('admin')),
);
?>

<h1>Update TmpDocd <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>