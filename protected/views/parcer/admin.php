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
		'ckey',
		'user',
 array(
                        'name'=>'cnom',
                        'type'=>'raw',
                        'value'=>"\$data->nom->cgr",
                        'filter'=>false, // Set the filter to false when date range searching
 				),
 array(
                        'name'=>'cnom',
                        'type'=>'raw',
                         'value'=>"\$data->nom->cname",
                        'filter'=>false, // Set the filter to false when date range searching
 				),
                             array(
					'name'=>'amount',
					'type'=>'raw',
//					'header'=>'Опл.',
					'value'=>"Yii::app()->numberFormatter->formatCurrency(\$data->bqua, '')",
					'filter'=>true, // Set the filter to false when date range searching
					'htmlOptions'=>array('style' => 'text-align: right;'),
 								 ),	
                             array(
					'name'=>'amount',
					'type'=>'raw',
//					'header'=>'Опл.',
					'value'=>"Yii::app()->numberFormatter->formatCurrency(\$data->bpri, '')",
					'filter'=>true, // Set the filter to false when date range searching
					'htmlOptions'=>array('style' => 'text-align: right;'),
 								 ),	
                             array(
					'name'=>'amount',
					'type'=>'raw',
//					'header'=>'Опл.',
					'value'=>"Yii::app()->numberFormatter->formatCurrency(\$data->bsum, '')",
					'filter'=>true, // Set the filter to false when date range searching
					'htmlOptions'=>array('style' => 'text-align: right;'),
 								 ),	
		array(
			'class'=>'CButtonColumn',
		),
	),
));
		?>