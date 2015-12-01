<?php
/* @var $this CountryController */
/* @var $model Country */

$this->breadcrumbs=array(
	'Администрирование'=>array('/site/page','view'=>'admin'),
//	'Countries'=>array('index'),
	'Страны',
);

$this->menu=array(
//	array('label'=>'List Country', 'url'=>array('index')),
	array('label'=>'Новая страна', 'url'=>array('create')),
);
/*
$this->widget('ext.EMenu', array(
              'model_name' =>'Country',
				'relation_name' =>'clients',
				'top_name' =>'name',
				'bottom_name' =>'name',
				'picktopvalue'=>'',
				'pickbottomvalue'=>'id',
				'pickfunction'=>'setvalue',
				'url_name' =>'javascript:void(0);',
			  'vertical'=>'true',
			  'theme'=>'default',
));

$this->widget('ext.EMenu', array(
              'items' =>$this->getMenuTree(),
			  'vertical'=>'true',
			  'theme'=>'default',
));*/
echo "<hr>";

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#country-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<h1>Страны</h1>


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
	'id'=>'country-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		array(
			'class'=>'CButtonColumn',
			 'template'=>'{update}{delete}',
		),
	),
)); ?>
