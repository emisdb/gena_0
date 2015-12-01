 <div id="opmenu" class="noprintarea">
<?php
Yii::app()->getClientScript()->registerCoreScript('jquery');
//Yii::app() ->clientScript -> registerScriptFile(Yii::app()->request->baseUrl."/js/printThis.js", CClientScript::POS_END);

		$this->widget('zii.widgets.CMenu', array(
			'items'=>array(
	array('label'=>'ТОРГ-12',  'url'=>'javascript:void(0);' , 'linkOptions'=>array('onclick'=>'doprint(0)'),),
	array('label'=>'Счет-Фактура',  'url'=>'javascript:void(0);' , 'linkOptions'=>array('onclick'=>'doprint(1)'),),
),
			'htmlOptions'=>array('class'=>'opmenu'),
		));

?>    
 </div>

<div class="outprintarea">
 <div id="printtorg">
<?php $this->renderPartial('_torg', array('model'=>$model,'dep'=>$dep,'cli'=>$cli,'clix'=>$clix)); ?>
 </div>
 </div>
<br>
<hr>
<br>
<div class="outprintarea">
 <div id="printsf">
<?php $this->renderPartial('_sf', array('model'=>$model,'dep'=>$dep,'cli'=>$cli,'clix'=>$clix)); ?>
 </div>
 </div>