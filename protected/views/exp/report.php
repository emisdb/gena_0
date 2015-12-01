<?php
/* @var $this ExpController */
/* @var $model Exp */

$this->breadcrumbs=array(
	'Администрирование'=>array('/site/page','view'=>'admin'),
	'Расходы'=>array('index'),
	'Отчет',
);

?>


<h1>Отчет по заказам, оплатам и отгрузкам (включая архив)</h1>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'date-form',
    'htmlOptions'=>array(
	'name'=>'date-form',
    ),
//  'name'=>'date-form',
    'enableAjaxValidation'=>true,
)); ?>
 	<div class="row">

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

</div>
<p>
<!--	<div class="row">

		<?php
                // echo $form->labelEx($model,'state_pay'); 
		 // echo $form->DropDownList($model,'state_pay',array(0=>'Все',1=>'Оплаченные',2=>'Неоплаченные'))
                // echo $form->error($model,'state_pay'); 
                ?>

</div>-->

<?php $this->endWidget(); ?>
<hr>
<?php 
Yii::app()->clientScript->registerScriptFile(  Yii::app()->assetManager->publish('js/user.js' ), CClientScript::POS_BEGIN);

echo "<h3>Отчет по ".($model->state_pay==0 ? " всем " :($model->state_pay==1 ? " оплаченным " : "неоплаченным "))." заказам ";
echo	" за период c ".Yii::app()->dateFormatter->formatDateTime($model->from_date, 'short', null);
echo	" по ".Yii::app()->dateFormatter->formatDateTime($model->to_date, 'short', null);
echo " </h3>";


if(!$show) return;
$rows=$model->report();
	if(!count($rows)>0) return;

	$inti=0;
	$expsum=0;
	$invsum=0;
	$paysum=0;
	echo "<table class='bigtable'>\n";
	echo "<tr><th>№</th><th>Контрагенты</th><th>Заказано</th><th>Оплачено</th><th>Отгружено</th></tr>\n";
	foreach($rows as $row)
	{	
               if(!is_null($row['expsum']))
                    $expsum+=$row['expsum'];
              if(!is_null($row['paysum']))
                    $paysum+=$row['paysum'];
              if(!is_null($row['invsum']))
                    $invsum+=$row['invsum'];
		echo "<tr><td>".++$inti."</td>";
		echo "<td>".$row['cliname']."</td>";
		echo "<td>".Yii::app()->numberFormatter->formatCurrency($row['expsum'], '')."</td>";
		echo "<td>".Yii::app()->numberFormatter->formatCurrency($row['paysum'], '')."</td>";
		echo "<td>".Yii::app()->numberFormatter->formatCurrency($row['invsum'], '')."</td></tr>";
 	}
		echo "<tr><th colspan='2'>Итог:</th>";
		echo "<th class='summary'>".Yii::app()->numberFormatter->formatCurrency($expsum,'')."</th>";
		echo "<th class='summary'>".Yii::app()->numberFormatter->formatCurrency($paysum,'')."</th>";
		echo "<th class='summary'>".Yii::app()->numberFormatter->formatCurrency($invsum,'')."</th>";
		echo "</tr>\n";
	echo "</table>\n";

 ?>
