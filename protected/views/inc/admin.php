<?php
/* @var $this IncController */
/* @var $model Inc */

$this->breadcrumbs=array(
	'Администрирование'=>array('/site/page','view'=>'admin'),
//	'Поступления'=>array('index'),
	'Поступления',
);

$this->menu=array(
//	array('label'=>'Список поступлений', 'url'=>array('index')),
	array('label'=>'Создать поступление', 'url'=>array('create'),'linkOptions'=>array('target'=>'_blank'),),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#inc-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Журнал поступлений</h1>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'date-form',
    'htmlOptions'=>array(
	'name'=>'date-form',
    ),
//  'name'=>'date-form',
    'enableAjaxValidation'=>true,
)); ?>
 
<b>С :</b>
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
 				  'name'=>'Exp[from_date]',
				  'attribute'=>'from_date', // Model attribute filed which hold user input
				  'model'=>$model,            // Model name
//   'name'=>'from_date',  // name of post parameter
  //   'value'=>Yii::app()->request->cookies['from_date']->value,  
	// value comes from cookie after submittion
     'options'=>array(
        'showAnim'=>'fold',
        'dateFormat'=>'yy-mm-dd',
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
));
?>
<b>по :</b>
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
 				  'name'=>'Exp[to_date]',
				  'attribute'=>'to_date', // Model attribute filed which hold user input
				  'model'=>$model,            // Model name
//    'name'=>'to_date',
 //    'value'=>Yii::app()->request->cookies['to_date']->value,
     'options'=>array(
        'showAnim'=>'fold',
        'dateFormat'=>'yy-mm-dd',
 
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
));
?>
<?php echo CHtml::submitButton('Отбор'); // submit button ?> 
<?php $this->endWidget(); ?>
<p>
Для отбора значений можно использовать символы сравнения (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) в начале каждого значения чтобы определить отбор, который вы хотите использовать.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'inc-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
   'htmlOptions'=>array(
        'style'=>'width:900px;'
    ),
	'columns'=>array(
		'id',
		'name',
		 array(
					'name'=>'date',
					'type'=>'raw',
					'value'=>"Yii::app()->dateFormatter->formatDateTime(\$data->date, 'short', null)",
					'filter'=>false, // Set the filter to false when date range searching
				),
		'accname',
		'concertname',
		'cityname',
		'country',
		'cliname',
		'depname',
		'expname',
		 array(
					'name'=>'amount',
					'type'=>'raw',
//					'header'=>'Опл.',
										'value'=>"Yii::app()->numberFormatter->formatCurrency(\$data->amount, '')",
					'filter'=>true, // Set the filter to false when date range searching
					'htmlOptions'=>array('style' => 'text-align: right;'),
				),

		'curname',
		'username',

		array(
			'class'=>'CButtonColumn',
           'htmlOptions'=>array('style'=>'width: 70px'),
			 'template'=>'{view}{update}{delete}',
			 'viewButtonOptions'=>array('target'=>'_blank'),
			 'updateButtonOptions'=>array('target'=>'_blank'),
		),
	),
)); ?>
