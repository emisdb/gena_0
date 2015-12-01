<?php
/* @var $this ExpController */
/* @var $model Exp */

$this->breadcrumbs=array(
	'Группы'=>array('admin'),
	$model->name,
);

?>

<h1>Тест <?php echo $rr ?></h1>

<?php 
    $ii=0;
    echo "<table><thead><tr><th>ckey</th><th>tnam</th><th>cgr</th><th>id.ckey</th></tr></thead>\n";
         foreach ($model as $key => $value) {
            echo "<tr>";
            echo "<td>".$value['zid']."</td><td>".$value['zname']."</td><td>".$value['zgr']."</td><td>".$value['zkey']."</td>";
             echo "</tr>\n";
               }  
     echo "</table>";
?>
