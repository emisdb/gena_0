<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<h1>About</h1>
<?php 
	if(Yii::app()->user->hasState("title"))
		echo "User Title:".Yii::app()->user->title."<br>"; 
	if(Yii::app()->user->hasState("perm"))
		echo "User Permission:".Yii::app()->user->perm."<br>"; 
	if(Yii::app()->user->hasState("uid"))
		echo "User ID:".Yii::app()->user->uid."<br>"; 
	echo "Author: ".Constants::model()->getCvalue('author');



?>