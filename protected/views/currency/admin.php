<?php
/* @var $this CurrencyController */
/* @var $model Currency */

$this->breadcrumbs=array(
	'Администрирование'=>array('/site/page','view'=>'admin'),
//	'Currencies'=>array('index'),
	'Валюты',
);

$this->menu=array(
//	array('label'=>'List Currency', 'url'=>array('index')),
	array('label'=>'Новая валюта', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#currency-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Валюты</h1>


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
	'id'=>'currency-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'longname',
		'rate',
		array(
			'class'=>'CButtonColumn',
			 'template'=>'{update}{delete}',
		),
	),
)); ?>
