<?php
/* @var $this ExpController */
/* @var $model Exp */

$this->breadcrumbs=array(
	'Администрирование'=>array('/site/page','view'=>'admin'),
//	'Расходы'=>array('index'),
	'Расходы',
);

//$this->menu=array(
////	array('label'=>'Список расходов', 'url'=>array('index')),
//	array('label'=>'Создать расход', 'url'=>array('create'),'linkOptions'=>array('target'=>'_blank'),),
//	array('label'=>'Записать задания',  'url'=>'javascript:void(0);' , 'linkOptions'=>array('onclick'=>'dosavepay()'),),
//);
?>

<?php


$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'mydialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Платежи',
       'modal'=>'true',
       'width'=>'620px',
       'autoOpen'=>false,
    ),
));
echo "<div id='mydialog_buts'>";
//  echo CHtml::link('Создать платеж',
//					array('pay/createID','id'=>''),
//					array('title'=>'Новый','target'=>'_blank','class'=>'menuitem'));
  echo "</div>";
								
echo("<div id='paytable'></div>");
								
$this->endWidget('zii.widgets.jui.CJuiDialog');	
echo "\n\n";

?>

<h1>Журнал счетов</h1>
<?php
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'date-form',
    'htmlOptions'=>array(
	'name'=>'date-form',
    ),
//  'name'=>'date-form',
    'enableAjaxValidation'=>true,
));
?>
 
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
<b>Отбор :</b>
 <?php echo CHtml::dropDownList('Exp[exp_all]', $model->state_pay, 
              array(0 => 'Все', 1 => 'Оплачено', 2 => 'Неоплачено', 3 => 'Отгружено', 4=> 'Неотгружено', 5=> '+Архив'));
 ?> 

<?php echo CHtml::hiddenField('checks');  ?>

<?php echo CHtml::submitButton('Отбор'); // submit button ?> 
<?php // $this->endWidget(); ?>
<!--<p>
Для отбора значений можно использовать символы сравнения (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) в начале каждого значения чтобы определить отбор, который вы хотите использовать.
</p>-->
<!--<span>
Для отбора значений по состоянию оплаты (опл.):
</span>
<ol start="0" class="paylistops">
<li>Неолпаченные</li>
<li>Оплаченные</li>
<li>Частично оплаченные</li>
<li>Помеченные для оплаты</li>
</ol>-->

<?php 
/*
echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); 
echo '<div class="search-form" style="display:none">';
    
 $this->renderPartial('_search',array(
	'model'=>$model,
)); 
 echo "</div><!-- search-form -->";
 */
 
 ?>

<?php 
Yii::app()->clientScript->registerScriptFile(  Yii::app()->assetManager->publish('js/user.js' ), CClientScript::POS_BEGIN);

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'exp-grid',
       'ajaxUpdate'=>false,
 	'dataProvider'=>$model->search(),
    'enablePagination'=>false,
    'summaryText' => "Счетов: {count}",
    'filter'=>$model,
    'rowCssClassExpression'=>'"arc".$data->pub',

   'htmlOptions'=>array(
        'style'=>'width:900px;'
    ),
	'columns'=>array(
		 array(
			'header'=>'№',
                        'name'=>'id',
                        'type'=>'raw',
                        'value'=>"'<a name=\"e_'.\$data->id.'\">'.\$data->id.'</a>'",
             'htmlOptions'=>array('style'=>'width: 40px; text-align:right;'),
				),
              array(
                        'name'=>'name',
                        'type'=>'raw',
                        'header'=>'Номер',
                        'value'=>array($model,'nameic'),
                        'filter'=>true, // Set the filter to false when date range searching
                        'htmlOptions'=>array('style' => 'text-align: right;width: 80px'),
                    ),
		 array(
                        'name'=>'date',
                        'type'=>'raw',
                        'value'=>"Yii::app()->dateFormatter->formatDateTime(\$data->date, 'short', null)",
                        'filter'=>false, // Set the filter to false when date range searching
                        'footer'=>'Итого:',
			),

                'cliname',
		'depname',
                             array(
					'name'=>'amount',
					'type'=>'raw',
//					'header'=>'Опл.',
					'value'=>"Yii::app()->numberFormatter->formatCurrency(\$data->amount, '')",
					'filter'=>true, // Set the filter to false when date range searching
					'htmlOptions'=>array('style' => 'text-align: right;'),
                                       'footer'=>$model->getTotals($model->search()->getKeys(),0),
                        'footerHtmlOptions'=>array(
                           'style'=>'font-style:normal; color:#000;'
                     ),				),
                             array(
					'name'=>'invsum',
					'type'=>'raw',
					'header'=>'Отгружено',
					'value'=>array($model,'invsum'),
					'filter'=>true, // Set the filter to false when date range searching
					'htmlOptions'=>array('style' => 'text-align: right;'),
                                      'footer'=>$model->getTotals($model->search()->getKeys(),2),
                       'footerHtmlOptions'=>array(
                           'style'=>'font-style:normal; color:#000;'
                     ),				),
                        		array(
			'class'=>'CButtonColumn',
			 'template'=>'{print}',      
			 'deleteConfirmation'=>'Отправить счет в архив?',
//			 'updateButtonOptions'=>array('target'=>'_blank'),
 			'buttons'=>array
			(
				'print' => array
				(
					'name'=>'id',
 					'label'=>'Печать',
					'imageUrl'=>Yii::app()->request->baseUrl.'/css/print.png',
					'url'=>'array("print","id"=>"$data->id")',
//                                        'options'=>array(),
                                 ),                            
                        )
       
	),	


//		'username',

	),
));
 ?>
<?php $this->endWidget(); ?>