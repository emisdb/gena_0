<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="ru" />
        <meta name="viewport" content="width-device-width, initial-scale=1" />

	<!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/css/bootstrap.min.css" />
	<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />

        <script  type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQuery/jQuery-2.1.4.min.js"></script>
        <script  type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap/js/bootstrap.min.js"></script>

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
    <div class="navbar navbar-default navbar-static-top" >
        <div class="container-fluid">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main_menu">
                    <span class="sr-only">navigation</span>
                    <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button> 
                <?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl.'/images/favicon.png', CHtml::encode(Yii::app()->name)),array('/site/index'),array('class'=>'navbar-brand')); ?>
            </div>
        <div class="collapse navbar-collapse" id="main_menu">
       <?php 		
		$this->widget('ext.AjaxMenu',array(
			'items'=>array(
				array('label'=>'Главная', 'url'=>array('/site/index'),'visible'=>Yii::app()->user->isGuest, 'ajax' => false),
//				array('label'=>'Счета', 'url'=>array('exp/admin'),'visible'=>((!Yii::app()->user->isGuest)&&($this->permit>0)), 'ajax' => false),			
//				array('label'=>'Поступления', 'url'=>array('inc/admin'),'visible'=>!Yii::app()->user->isGuest, 'ajax' => false),
				array('label'=>'Поступления', 'url'=>array('exp/admin'),'visible'=>((!Yii::app()->user->isGuest)&&($this->permit>1)), 'ajax' => false),
//				array('label'=>'Платежи', 'url'=>array('pay/admin'),'visible'=>((!Yii::app()->user->isGuest)&&($this->permit>1)), 'ajax' => false),
				array('label'=>'Отгрузки', 'url'=>array('inv/admin'),'visible'=>((!Yii::app()->user->isGuest)&&($this->permit>0)), 'ajax' => false),
                array('label'=>'Отчет', 'url'=>array('exp/report'),'visible'=>((!Yii::app()->user->isGuest)&&($this->permit>2)), 'ajax' => false),
				array('label'=>'Загрузка', 'url'=>array('parcer/index'),'visible'=>((!Yii::app()->user->isGuest)&&($this->permit>0)), 'ajax' => false),
                array('label'=>'Администрирование', 'url'=>array('/site/page', 'view'=>'admin'),'visible'=>((!Yii::app()->user->isGuest)&&($this->permit>2)), 'ajax' => false),
//				array('label'=>'Отчет', 'url'=>array('exp/report'),'visible'=>!Yii::app()->user->isGuest, 'ajax' => false),			
/*				array('label'=>'Остатки', 'url'=>array('account/ajaxReq'),'visible'=>!Yii::app()->user->isGuest,'ajax' => array( 'update'=>'#pay_table',
				        'complete' => 'function() {
				        $("#accountsdialog").dialog("option","title","Остатки на рассчетных счетах");
					$("#accountsdialog").dialog("open");
				        }', 
				)),
*/
 //				array('label'=>'Администрирование', 'url'=>array('/site/page', 'view'=>'admin'),'visible'=>!Yii::app()->user->isGuest, 'ajax' => false),
 
				array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest, 'ajax' => false),
				array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest, 'ajax' => false)
			),
                        'optionalIndex'=>true,
                        'ajax'=>array('update' => '#page',  ),
                    'randomID'=>true,                   
                    'htmlOptions'=>array('class'=>'nav navbar-nav'),                   
                    )); 
		?>

	</div><!-- main_menu -->
        </div>
   </div>

<div class="container-fluid" id="page">
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
