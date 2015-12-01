<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
        <style type="text/css" media="print">
            body {visibility:hidden; }
            .noprintarea {visibility:hidden; display:none;}
            #noprintcontent { visibility:hidden; }
            #printarea, #printtorg, #printsf 
            { visibility:visible; display:block;
            font-size: 8pt;
            }
            .page-break {
                page-break-after: always;
               }            
    </style>

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print_doc.css" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container">
<div class="noprintarea">
	<div id="header">
		<span id="piclogo"><?php echo CHtml::image('images/logo.png', 'Лого'); ?></span>
		<span id="logo">Печать <?php echo CHtml::encode(Yii::app()->name); ?></span>
	</div><!-- header -->

	
		<?php 
Yii::app()->clientScript->registerScript('search','var baseDir="'.Yii::app()->request->baseUrl.'";',CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(  Yii::app()->assetManager->publish('js/print.js' ), CClientScript::POS_HEAD);
?>

	<div id="mainmenu">
	
	
<?php 
                $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
                            array('label'=>'Главная', 'url'=>array('/site/index'),'visible'=>Yii::app()->user->isGuest),
                            array('label'=>'Счета', 'url'=>array('exp/admin'),'visible'=>((!Yii::app()->user->isGuest)&&($this->permit>0))),			
                            array('label'=>'Платежи', 'url'=>array('pay/admin'),'visible'=>((!Yii::app()->user->isGuest)&&($this->permit>1))),
                            array('label'=>'Отгрузки', 'url'=>array('inv/admin'),'visible'=>((!Yii::app()->user->isGuest)&&($this->permit>0))),
                            array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
)); 
		?>

	</div><!-- mainmenu -->
	
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
</div>
	<?php echo $content; ?>
<div class="noprintarea">
	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by EMIS.DB on Yii.<?php echo Yii::getVersion(); ?><br/>
	</div><!-- footer -->
</div>
</div><!-- page -->

</body>
</html>