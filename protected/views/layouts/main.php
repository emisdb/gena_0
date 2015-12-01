<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<span id="piclogo"><?php echo CHtml::image('images/logo.png', 'Моя компания'); ?></span>
		<span id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></span>
	</div><!-- header -->

	
		<?php 

Yii::app()->clientScript->registerScriptFile(  Yii::app()->assetManager->publish('js/common.js' ), CClientScript::POS_HEAD);
		$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'accountsdialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Остатки на рассчетных счетах',
       'modal'=>'true',
       'width'=>'620px',
       'autoOpen'=>false,
    ),
));
								
echo("<div id='pay_table'></div>");
								
$this->endWidget('zii.widgets.jui.CJuiDialog');	
		
?>

	<div id="mainmenu">
	
	
<?php 		
		$this->widget('ext.AjaxMenu',array(
			'items'=>array(
				array('label'=>'Главная', 'url'=>array('/site/index'),'visible'=>Yii::app()->user->isGuest, 'ajax' => false),
//				array('label'=>'Счета', 'url'=>array('exp/admin'),'visible'=>((!Yii::app()->user->isGuest)&&($this->permit>0)), 'ajax' => false),			
//				array('label'=>'Поступления', 'url'=>array('inc/admin'),'visible'=>!Yii::app()->user->isGuest, 'ajax' => false),
				array('label'=>'Поступления', 'url'=>array('pay/admin'),'visible'=>((!Yii::app()->user->isGuest)&&($this->permit>1)), 'ajax' => false),
//				array('label'=>'Платежи', 'url'=>array('pay/admin'),'visible'=>((!Yii::app()->user->isGuest)&&($this->permit>1)), 'ajax' => false),
				array('label'=>'Отгрузки', 'url'=>array('inv/admin'),'visible'=>((!Yii::app()->user->isGuest)&&($this->permit>0)), 'ajax' => false),
                                array('label'=>'Отчет', 'url'=>array('exp/report'),'visible'=>((!Yii::app()->user->isGuest)&&($this->permit>2)), 'ajax' => false),
				array('label'=>'Загрузка', 'url'=>array('tmpXml/admin'),'visible'=>((!Yii::app()->user->isGuest)&&($this->permit>0)), 'ajax' => false),
//				array('label'=>'Отчет', 'url'=>array('exp/report'),'visible'=>!Yii::app()->user->isGuest, 'ajax' => false),			
//				array('label'=>'Остатки', 'url'=>array('account/ajaxReq'),'visible'=>!Yii::app()->user->isGuest,'ajax' => array( 'update'=>'#pay_table',
//        'complete' => 'function() {
//        $("#accountsdialog").dialog("option","title","Остатки на рассчетных счетах");
//		$("#accountsdialog").dialog("open");
//        }',        
//)),
//				array('label'=>'Администрирование', 'url'=>array('/site/page', 'view'=>'admin'),'visible'=>!Yii::app()->user->isGuest, 'ajax' => false),
				array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest, 'ajax' => false),
				array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest, 'ajax' => false)
			),
  'optionalIndex'=>true,
  'ajax'=>array(
      'update' => '#page',
  ),
  'randomID'=>true,		)); 
		?>

	</div><!-- mainmenu -->
	
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by EMIS.DB on Yii.<?php echo Yii::getVersion(); ?><br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
