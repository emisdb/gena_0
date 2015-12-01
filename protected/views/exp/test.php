<?php
/* @var $this ExpController */
/* @var $model Exp */

$this->breadcrumbs=array(
	'Расходы'=>array('admin'),
	$model->name,
);

?>

<h1>Тест #<?php echo $model['id']; ?></h1>

<?php 
//In view:
echo CHtml::ajaxLink(
    CHtml::image(Yii::app()->request->baseUrl.'/css/pay0.png'),
    array('reqTest01Loading'), // the URL for the AJAX request. If empty, it is assumed to be the current URL.
    array(
        'update'=>'#req_res_loading',
        'beforeSend' => 'function() {           
           $("#maindiv").addClass("loading");
        }',
        'complete' => 'function() {
          $("#maindiv").removeClass("loading");
        }',        
    )
);
 
echo '<div id="req_res_loading">...</div>';
?>
