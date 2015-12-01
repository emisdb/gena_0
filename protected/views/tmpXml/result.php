<?php
/* @var $this TmpXmlController */
/* @var $model TmpXml */

$this->breadcrumbs=array(
	'Загрузка'=>array('admin'),
);

$this->menu=array(
	array('label'=>'Повторить', 'url'=>array('xml')),
	array('label'=>'Загрузка', 'url'=>array('admin')),
);
?>

<h1>Результат переноса:</h1>

<?php 
//            var_dump($model);
 
echo "<ol>";
foreach ($model as $value) {
    if(is_array($value))
    {
       echo "<li>";   
        var_dump ($value);
       echo "</li>";   
    }
    else if(is_object($value))
    {
       echo "<li>";   
        var_dump ($value);
       echo "</li>";   
    }
    else 
        echo "<li>$value</li>";   
}
echo "</ol>";
?>
