<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - set';
$this->breadcrumbs=array(
	'Login',
);
?>
<hr>
<?php 	echo "Author: ".Constants::model()->getCvalue('dayup'); ?>
<hr>
<h1>set</h1>


<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="row">
		<?php echo CHtml::textField('constant');  ?> 
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('set'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
