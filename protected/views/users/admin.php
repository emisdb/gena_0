<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
			 'template'=>'{update}{delete}',
	'Users'=>array('index'),
	'Пользователи',
);

$this->menu=array(
//	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Новый пользователь', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Пользователи</h1>


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
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'login',
		'pwd',
		'email',
		'perm',
		'title',
		array(
			'class'=>'CButtonColumn',
			 'template'=>'{update}{delete}',
		),
	),
)); ?>
