<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Администрирование';
$this->breadcrumbs=array(
	'Администрирование',
);
?>
<h1>Меню</h1>

	<div id="admmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Расчетные счета', 'url'=>array('account/admin')),			
				array('label'=>'Города', 'url'=>array('city/admin')),			
				array('label'=>'Контрагенты', 'url'=>array('client/admin')),			
				array('label'=>'Страны', 'url'=>array('country/admin')),			
				array('label'=>'Валюты', 'url'=>array('currency/admin')),			
				array('label'=>'Статьи', 'url'=>array('expence/admin')),			
				array('label'=>'Концерты', 'url'=>array('concert/admin')),			
				array('label'=>'Отделы', 'url'=>array('department/admin')),			
				array('label'=>'Пользователи', 'url'=>array('users/admin')),			

		))); ?>
	</div><!-- mainmenu -->
