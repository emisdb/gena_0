<?php
/* @var $this PayController */
/* @var $model Pay */
Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish('js/common.js' ), CClientScript::POS_HEAD);
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'smart',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Редакция компании',
		'width'=>'620px',
//		'height'=>'450px',
        'modal'=>'true',
       'autoOpen'=>false,
    ),
));/**/
 ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'companies-form',
 	'enableAjaxValidation'=>false,
)); ?>


    <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
		<?php echo CHtml::button('Отменить',array('onclick'=>'doedit("smart", false)')); ?>
	</div>

<?php
$this->endWidget(); 
$this->endWidget('zii.widgets.jui.CJuiDialog');	

$this->breadcrumbs=array(
	'Платежи'=>array('admin'),
	'Новый',
);

$this->menu=array(
	array('label'=>'Журнал платежей', 'url'=>array('admin')),
	array('label'=>'Новые комиссии',  'url'=>array('createC', 'id'=>$model->exp_id),'visible'=>$model->exp_id != null ),
//	array('label'=>'Новые комиссии',  'url'=>'javascript:void(0);' , 'linkOptions'=>array('onclick'=>'doedit("smart", true)'),),
);
?>

<h1>Новая комиссия с оплатой</h1>

<?php echo $this->renderPartial('_formexp', array('model'=>$modele,'modelp'=>$model));
 //echo $this->renderPartial('_form', array('model'=>$model,'expid'=>$expid)); ?>
