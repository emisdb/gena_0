<?php
/* @var $this TmpDocdController */
/* @var $model TmpDocd */

$this->breadcrumbs=array(
	'Tmp Docds'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TmpDocd', 'url'=>array('index')),
	array('label'=>'Create TmpDocd', 'url'=>array('create')),
);

?>

<h1>Manage Tmp Docds</h1>

<?php


$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tmp-docd-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user',
		'docinfo',
		'tnum',
		'tonum',
		'bsum',
		'cliname',
		array(
			'class'=>'CButtonColumn',
		),
	),
));
		?>