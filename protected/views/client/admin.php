<?php
/* @var $this ClientController */
/* @var $model Client */

$this->breadcrumbs=array(
	'Администрирование'=>array('/site/page','view'=>'admin'),
//	'Clients'=>array('index'),
	'Контрагенты',
);

$this->menu=array(
//	array('label'=>'List Client', 'url'=>array('index')),
	array('label'=>'Новый контрагент', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#client-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Контрагенты</h1>


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
	'id'=>'client-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'countryname',
		array(
			'class'=>'CButtonColumn',
			 'template'=>'{update}{delete}',
		),
	),
)); ?>
