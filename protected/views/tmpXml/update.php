<?php
/* @var $this TmpXmlController */
/* @var $model TmpXml */

$this->breadcrumbs=array(
	'Tmp Xmls'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TmpXml', 'url'=>array('index')),
	array('label'=>'Create TmpXml', 'url'=>array('create')),
	array('label'=>'View TmpXml', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TmpXml', 'url'=>array('admin')),
);
?>

<h1>Update TmpXml <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>