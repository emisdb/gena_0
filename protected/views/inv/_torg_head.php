<table width="1040px" cellspacing="0" cellpadding="0" border="0" class="items">
<thead>
<tr>
    <td width="36" height="12" rowspan="2" class="upper">Но-<br>мер<br>по по-<br>рядку</td>
    <td height="12" colspan="2" style="width: 255px;" class="upper">Товар</td>
    <td height="12" colspan="2" style="width: 108px;" class="upper">Единица измерения</td>   
    <td height="12" rowspan="2" style="width: 42px;" class="upper">Вид<br>упа-<br>ковки</td>
    <td height="12" colspan="2" class="upper">Количество</td>   
    <td height="12" rowspan="2" style="width:53px;" class="upper">Масса<br>брутто</td>
    <td width="61" height="12" rowspan="2" class="upper">Количе-<br>ство<br>(масса<br>нетто)</td>
    <td width="67" height="12" rowspan="2" class="upper">Цена,<br>руб. коп.</td>
    <td width="60" height="12" rowspan="2" class="upper">Сумма без<br>учета НДС,<br>руб. коп.</td>
    <td height="12" colspan="2" class="upper">НДС</td>   
    <td width="67" height="12" rowspan="2" class="upper" style="border-right: 1px solid;">Сумма с<br>учетом<br>НДС,<br>руб. коп.</td>
</tr>

<tr>

    <td width="200">наименование, характеристика, сорт,<br>артикул товара</td>
    <td width="55">код</td>
    <td width="54">наиме-<br>нование</td>
    <td width="54">код по<br>ОКЕИ</td>

    <td width="42">в<br>одном<br>месте</td>
    <td width="55">мест,<br>штук</td>

    <td width="60">ставка, %</td>   
    <td width="67">сумма,<br>руб. коп.</td>   

</tr>
 <tr>
  <td style="width:36px;">1</td> 
  <td style="width:200px;">2</td> 
  <td style="width:55px;border-bottom: 3px solid;">3</td>
  <td style="width:54px;">4</td>
  <td style="width:54px;border-bottom: 3px solid;">5</td>
  <td style="width:42px;border-bottom: 3px solid;">6</td>  
  <td style="width:42px;border-bottom: 3px solid;">7</td>    
  <td style="width:55px;border-bottom: 3px solid;">8</td>    
  <td style="width:53px;border-bottom: 3px solid;">9</td>    
  <td style="width:61px;border-bottom: 3px solid;">10</td>      
  <td style="width:67px;border-bottom: 3px solid;">11</td>   
  <td style="width:60px;border-bottom: 3px solid;">12</td>    
  <td style="width:60px;">13</td>    
  <td style="width:67px;border-bottom: 3px solid;">14</td>    
  <td style="width:67px;border-right: 1px solid;border-bottom: 3px solid;">15</td>                   
 </tr> 
</thead>         
 <tbody>
   <?php echo $tab; ?>   
  <tr id="last_item">
  <td style="border-width:0;" colspan="2"></td>
  <td style="border-width:3px 0 0;"></td>
  <td style="border-width:0;"></td>
  <td style="border-width:3px 0 0; text-align:right; padding-right: 10px;" colspan="3">
  Итого
  </td>
   <td style="border-width:3px 1px 1px;"></td><td style="border-top:3px solid;"></td>
   <td style="border-top:3px solid;"><?php echo Yii::app()->numberFormatter->format("0.000", $counts['totamount']) ?></td>
   <td style="text-align: center;border-top:3px solid;">X</td>
   <td style="border-top:3px solid;"><?php echo Yii::app()->numberFormatter->formatCurrency($counts['totsum'],"") ?></td>
   <td style="text-align: center;">X</td>
   <td style="border-top:3px solid;"><?php echo Yii::app()->numberFormatter->formatCurrency($counts['totvat'],"") ?></td>
   <td style="border-top:3px solid;"><?php echo Yii::app()->numberFormatter->formatCurrency($counts['totsumvat'],"") ?></td>
 </tr>
 <?php if($tabtype==1) : ?>
 <tr id="last_item">
  <td style="border:0; text-align:right; padding-right:10px; " colspan="7">
  Всего по накладной
  </td>
    <td style="border-width:0px 1px 1px;">
   </td><td></td>
   <td><?php echo Yii::app()->numberFormatter->format("0.000", $counts['gtotamount']) ?></td>
   <td style="text-align: center;">X</td>
   <td><?php echo Yii::app()->numberFormatter->formatCurrency($counts['gtotsum'],"") ?></td>
   <td style="text-align: center;">X</td>
   <td><?php echo Yii::app()->numberFormatter->formatCurrency($counts['gtotvat'],"") ?></td>
   <td><?php echo Yii::app()->numberFormatter->formatCurrency($counts['gtotsumvat'],"") ?></td>
 </tr>
 <?php endif; ?>
 </tbody>
</table>
<?php 
if($tabtype==0) echo '<p class="page-break"><hr><br>';
?>