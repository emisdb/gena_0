<?php
/* @var $this PayController */
/* @var $model Pay */

$this->breadcrumbs=array(
	'Админисрирование'=>array('/site/page','view'=>'admin'),
//	'Платежи'=>array('index'),
	'Платежи',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pay-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>Журнал платежей</h1>
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
 				  'name'=>'Pay[from_date]',
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
 				  'name'=>'Pay[to_date]',
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
<b>Отбор :</b>
<?php echo CHtml::dropDownList('Pay[state_pay]', $model->state_pay, 
              array(0 => 'Все', 1 => 'Получено(по дате плат.)',2 => 'Получено(по дате получ.)', 3 => 'Неполучено'));
 ?> 
     <?php echo CHtml::submitButton('Отбор'); // submit button ?> 
<?php $this->endWidget(); ?>
<p>


<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php 
Yii::app()->clientScript->registerScriptFile(  Yii::app()->assetManager->publish('js/user.js' ), CClientScript::POS_BEGIN);
$dataProvider=$model->search();

 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pay-grid',
	'dataProvider'=>$dataProvider,
//      'ajaxUpdate'=>false,
	'filter'=>$model,
        'htmlOptions'=>array(
        'style'=>'width:900px;'
    ),
	'columns'=>array(
		 array(
					'name'=>'id',
					'type'=>'raw',
					'value'=>"'<a name=\"p_'.\$data->id.'\">'.\$data->id.'</a>'",
					'filter'=>false, // Set the filter to false when date range searching
				),
		'expname',
		 array(
                        'name'=>'expdate',
                        'type'=>'raw',
                        'value'=>"Yii::app()->dateFormatter->formatDateTime(\$data->expdate, 'short', null)",
                        'filter'=>false, // Set the filter to false when date range searching
                        'footer'=>'Итого:',
				),
               'cliname',
		'depname',
	       array(
            'name'=>'amount',
            'header'=>'Сумма',
             'type'=>'raw',
            'value'=>"Yii::app()->numberFormatter->formatCurrency(\$data->exp->amount, '')",
 // 			'filter'=>false, Set the filter to false when date range searching
			'htmlOptions'=>array('style' => 'text-align: right;'),
                        'footer'=>$model->getTotals($model->search()->getKeys(),1),
                       'footerHtmlOptions'=>array(
                           'style'=>'font-style:normal; color:#000;'
                     ),          ),
		 array(
					'name'=>'amount',
					'type'=>'raw',
					'value'=>"Yii::app()->numberFormatter->formatCurrency(\$data->amount, '')",
					'filter'=>true, // Set the filter to false when date range searching
					'htmlOptions'=>array('style' => 'text-align: right;'),
                                       'footer'=>$model->getTotals($model->search()->getKeys(),0),
                       'footerHtmlOptions'=>array(
                           'style'=>'font-style:normal; color:#000;'
                     ),				),
		'name',
		 array(
					'name'=>'date',
					'type'=>'raw',
					'value'=>"Yii::app()->dateFormatter->formatDateTime(\$data->date, 'short', null)",
					'filter'=>false, // Set the filter to false when date range searching
				),
		 array(
					'name'=>'date_g',
					'type'=>'raw',
					'value'=>"Yii::app()->dateFormatter->formatDateTime(\$data->date_g, 'short', null)",
					'filter'=>false, // Set the filter to false when date range searching
                        		'htmlOptions'=>array('style' => 'text-align: right;'),
                                       'footer'=>$model->getTotals($model->search()->getKeys(),2),
                       'footerHtmlOptions'=>array(
                           'style'=>'font-style:normal; color:#000;'
                     ),				),
             		array(
			'class'=>'CButtonColumn',
			 'template'=>(($this->permit>2)?'{update}{delete}':''),
//			 'viewButtonOptions'=>array('target'=>'_blank'),
//			 'updateButtonOptions'=>array('target'=>'_blank'),
        
	),	
            ),
));

 ?>
