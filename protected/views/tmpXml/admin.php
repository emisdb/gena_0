<?php
/* @var $this TmpXmlController */
/* @var $model TmpXml */

$this->breadcrumbs=array(
	'Tmp Xmls'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Записать',  'url'=>'javascript:dosavepay();'),
	array('label'=>'Повторить', 'url'=>array(($this->getAction()=='xml' ? 'xml' : 'cxml'))),
);
if($this->getAction()=='xml')
{
   $this->menu[]=
	array('label'=>'Загрузка', 'url'=>array('admin')); 
}
Yii::app()->clientScript->registerScriptFile(  Yii::app()->assetManager->publish('js/form.js' ), CClientScript::POS_HEAD);
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'date-form',
    'method'=>'post',
    'htmlOptions'=>array(
	'name'=>'date-form',
    ),
));
echo CHtml::hiddenField('TmpXml[product]','',array('id'=>'product'));
//echo CHtml::hiddenField('TmpXml[done]','',array('id'=>'done'));
//echo CHtml::hiddenField('TmpXml[department]','',array('id'=>'department'));
echo CHtml::hiddenField('TmpXml[doc]','',array('id'=>'doc'));
//echo CHtml::hiddenField('TmpXml[inv]','',array('id'=>'inv'));
$this->endWidget();

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'productdialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Товары',
       'modal'=>'true',
       'width'=>'620px',
       'autoOpen'=>false,
    ),
));
echo("<div id='prodtable'></div>");
$this->widget('ext.EMenu', array(
        'model_name' =>'ProductGroup',
	'relation_name' =>'products',
	'top_name' =>'tnam',
	'bottom_name' =>'tnam',
	'picktopvalue'=>'',
	'pickbottomvalue'=>'ckey',
	'pickfunction'=>'setvalue',
	'url_name' =>'javascript:void(0);',
	'vertical'=>'true',
	'theme'=>'adobe',
));
								
$this->endWidget('zii.widgets.jui.CJuiDialog');	
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'clientdialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Клиенты',
       'modal'=>'true',
       'width'=>'620px',
       'autoOpen'=>false,
    ),
));

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
								
$this->endWidget('zii.widgets.jui.CJuiDialog');
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'departmentdialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Фирмы',
		'width'=>'620px',
//		'height'=>'450px',
        'modal'=>'true',
       'autoOpen'=>false,
    ),
));/**/

$this->widget('ext.EMenu', array(
              'model_name' =>'Department',
				'top_name' =>'name',
				'bottom_name' =>'name',
				'picktopvalue'=>'id',
				'pickfunction'=>'setvalue',
				'url_name' =>'javascript:void(0);',
			  'vertical'=>'true',
			  'theme'=>'default',
));

$this->endWidget('zii.widgets.jui.CJuiDialog');	
?>


<h1>Идентификация товара</h1>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'prod-xml-grid',
	'dataProvider'=>$model->search(0),
//	'filter'=>false,
	'columns'=>array(
		'id', 
                'ckey',
		'cname',
		'lid',
		'lname',
                            array(
					'name'=>'lid',
					'htmlOptions'=>array('style'=>'display:none;'),
					'headerHtmlOptions'=>array('style'=>'display:none;'),
  				),
                             array(
					'name'=>'state',
					'htmlOptions'=>array('style'=>'display:none;'),
					'headerHtmlOptions'=>array('style'=>'display:none;'),
       			),
 
/*
               'ctype',
*/
		array(
			'class'=>'CButtonColumn',
			 'template'=>'{setval}{delval}',
			'buttons'=>array
			(
				'setval' => array
				(
                                     'label'=>'Товары',
                                    'imageUrl'=>Yii::app()->request->baseUrl.'/css/pay0.png',
                                     'url'=>'"javascript:_id=$data->id;_pay=0;void(0);"',
                                    'options'=>array('onclick'=>'showdialog("product",this);'),
                          	),  
				'delval' => array
				(
                                     'label'=>'Товары',
                                    'imageUrl'=>Yii::app()->request->baseUrl.'/css/del.png',
                                     'url'=>'"javascript:_id=$data->id;_pay=$data->ckey;void(0);"',
                                   'options'=>array('onclick'=>'clearvalue(this);'),
                          	),  
		),
	),	
            ),
)); 


?>
<h1>Идентификация клиентов</h1>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cli-xml-grid',
	'dataProvider'=>$model->search(1),
//	'filter'=>false,
	'columns'=>array(
		'id', 
                'ckey',
		'cname',
		'lid',
		'lname',
                            array(
					'name'=>'lid',
					'htmlOptions'=>array('style'=>'display:none;'),
					'headerHtmlOptions'=>array('style'=>'display:none;'),
  				),
                             array(
					'name'=>'state',
					'htmlOptions'=>array('style'=>'display:none;'),
					'headerHtmlOptions'=>array('style'=>'display:none;'),
       			),
 
/*
               'ctype',
*/
		array(
			'class'=>'CButtonColumn',
			 'template'=>'{setval}{delval}',
			'buttons'=>array
			(
				'setval' => array
				(
                                     'label'=>'Клиенты',
                                    'imageUrl'=>Yii::app()->request->baseUrl.'/css/pay0.png',
                                     'url'=>'"javascript:_id=$data->id;_pay=0;void(0);"',
                                    'options'=>array('onclick'=>'showdialog("client",this);'),
                          	),  
				'delval' => array
				(
                                     'label'=>'Клиенты',
                                    'imageUrl'=>Yii::app()->request->baseUrl.'/css/del.png',
                                     'url'=>'"javascript:_id=$data->id;_pay=$data->ckey;void(0);"',
                                   'options'=>array('onclick'=>'clearvalue(this);'),
                          	),  
		),
	),	
            ),
)); 


?>
<h1>Идентификация фирм</h1>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'dep-xml-grid',
	'dataProvider'=>$model->search(2),
//	'filter'=>false,
	'columns'=>array(
		'id', 
                'ckey',
		'cname',
		'lid',
		'lname',
                            array(
					'name'=>'lid',
					'htmlOptions'=>array('style'=>'display:none;'),
					'headerHtmlOptions'=>array('style'=>'display:none;'),
  				),
                             array(
					'name'=>'state',
					'htmlOptions'=>array('style'=>'display:none;'),
					'headerHtmlOptions'=>array('style'=>'display:none;'),
       			),
 
/*
               'ctype',
*/
		array(
			'class'=>'CButtonColumn',
			 'template'=>'{setval}{delval}',
			'buttons'=>array
			(
				'setval' => array
				(
                                     'label'=>'Фирмы',
                                    'imageUrl'=>Yii::app()->request->baseUrl.'/css/pay0.png',
                                     'url'=>'"javascript:_id=$data->id;_pay=0;void(0);"',
                                    'options'=>array('onclick'=>'showdialog("department",this);'),
                          	),  
				'delval' => array
				(
                                     'label'=>'Фирмы',
                                    'imageUrl'=>Yii::app()->request->baseUrl.'/css/del.png',
                                     'url'=>'"javascript:_id=$data->id;_pay=$data->ckey;void(0);"',
                                   'options'=>array('onclick'=>'clearvalue(this);'),
                          	),  
		),
	),	
            ),
)); 

echo "<hr>";
?>
<h1>Отбор документов в окне</h1>
<b>С :</b>
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
 				  'id'=>'from_date',
				  'name'=>'from_date',
				  'value'=>  date('Y-m-d'), 
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
				  'id'=>'to_date',
				  'name'=>'to_date',
				  'value'=>  date('Y-m-d'), 
     'options'=>array(
        'showAnim'=>'fold',
        'dateFormat'=>'yy-mm-dd',
 
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
));
?>
<b>Фирма :</b>

<?php 
        $list = CHtml::listData(Department::model()->findAll(),'id', 'name');	
        echo CHtml::dropDownList('sel_department',0,$list);
        
        echo "<hr>";
 ?>



<h1>Идентификация счетов</h1>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ord-xml-grid',
	'dataProvider'=>$doc->search(0),
//	'filter'=>false,
	'columns'=>array(
		'id', 
                'tnum',
		 array(
                        'name'=>'ddat',
                        'type'=>'raw',
                        'value'=>"Yii::app()->dateFormatter->formatDateTime(\$data->ddat, 'short', null)",
			),
		'firname',
		'cliname',
                            array(
					'name'=>'bsum',
					'type'=>'raw',
					'value'=>"Yii::app()->numberFormatter->formatCurrency(\$data->bsum, '')",
					'htmlOptions'=>array('style' => 'text-align: right;'),
  				),
 		'expid',
		'expinfo',
		array(
			'class'=>'CButtonColumn',
			 'template'=>'{setval}{delval}',
			'buttons'=>array
			(
				'setval' => array
				(
					'name'=>'id',
 					'label'=>'Счета',
                                       'imageUrl'=>Yii::app()->request->baseUrl.'/css/pay0.png',
                                    'url'=>'"js:_id=$data->id;void(0);"',
					'options'=>array(
					'ajax'=>array(
					   'type'=>'POST',
//					   'data'=>array('val_id'=>'js:$(this).attr("href")'),
					   'data'=>array('val_id'=>'js:getvalues()'),
						'url'=>array('ajaxExp',),
						'update'=>'#pay_table',
						'beforeSend' => 'doshow("ords",this)'	  
						),
						)
				),
                            'delval' => array
				(
                                     'label'=>'Очистить',
                                    'imageUrl'=>Yii::app()->request->baseUrl.'/css/del.png',
                                     'url'=>'"javascript:_id=$data->id;_pay=$data->ckey;void(0);"',
                                   'options'=>array('onclick'=>'clearexpvalue(this);'),
                          	),  
		),
	),	
            ),
)); 


?>
<h1>Идентификация накладных</h1>

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'inv-xml-grid',
	'dataProvider'=>$doc->search(1),
//	'filter'=>false,
	'columns'=>array(
		'id', 
                'tnum',
		 array(
                        'name'=>'ddat',
                        'type'=>'raw',
                        'value'=>"Yii::app()->dateFormatter->formatDateTime(\$data->ddat, 'short', null)",
			),
		'tonum',
		 array(
                        'name'=>'dodat',
                        'type'=>'raw',
                        'value'=>"Yii::app()->dateFormatter->formatDateTime(\$data->dodat, 'short', null)",
			),
		'firname',
		'cliname',
                            array(
					'name'=>'bsum',
					'type'=>'raw',
					'value'=>"Yii::app()->numberFormatter->formatCurrency(\$data->bsum, '')",
					'htmlOptions'=>array('style' => 'text-align: right;'),
  				),
 		'expid',
		'expinfo',
		'docid',
		'docinfo',
		array(
			'class'=>'CButtonColumn',
			 'template'=>'{setval}{invval}{delval}{delinval}',
			'buttons'=>array
			(
				'invval' => array
				(
					'name'=>'id',
 					'label'=>'Накладные',
                                       'imageUrl'=>Yii::app()->request->baseUrl.'/css/pay1.png',
                                    'url'=>'"js:_id=$data->id;void(0);"',
					'options'=>array(
					'ajax'=>array(
					   'type'=>'POST',
//					   'data'=>array('val_id'=>'js:$(this).attr("href")'),
					   'data'=>array('val_id'=>'js:getvalues()'),
						'url'=>array('ajaxInv',),
						'update'=>'#pay_table',
//						'complete' => 'function() {shodialog("invs",this);}',	  
						'beforeSend' => 'doshow("invs",this)'	  
						),
						)
				),
				'setval' => array
				(
					'name'=>'id',
 					'label'=>'Счета',
                                       'imageUrl'=>Yii::app()->request->baseUrl.'/css/pay0.png',
                                    'url'=>'"js:_id=$data->id;void(0);"',
					'options'=>array(
					'ajax'=>array(
					   'type'=>'POST',
//					   'data'=>array('val_id'=>'js:$(this).attr("href")'),
					   'data'=>array('val_id'=>'js:getvalues()'),
						'url'=>array('ajaxExp',),
						'update'=>'#pay_table',
						'beforeSend' => 'doshow("ordsub",this)'	  
						),
						)
				),
				'delval' => array
				(
                                     'label'=>'Очистить',
                                    'imageUrl'=>Yii::app()->request->baseUrl.'/css/del1.png',
                                     'url'=>'"javascript:_id=$data->id;_pay=$data->ckey;void(0);"',
                                   'options'=>array('onclick'=>'clearexpvalue(this);'),
                          	),  
				'delinval' => array
				(
                                     'label'=>'Очистить',
                                    'imageUrl'=>Yii::app()->request->baseUrl.'/css/del.png',
                                     'url'=>'"javascript:_id=$data->id;_pay=$data->ckey;void(0);"',
                                   'options'=>array('onclick'=>'clearinvvalue(this);'),
                          	),  
		),
	),	
            ),
)); 


?>