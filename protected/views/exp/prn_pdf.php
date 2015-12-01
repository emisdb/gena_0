<div style="width:750px;font-family: freeserif;">
    <div style="text-align: center; margin: 0px 120px;">
        Внимание! Оплата данного счета означает согласие с условиями поставки товара. Уведомление об оплате обязательно, в
противном случае не гарантируется наличие товара на складе. Товар отпускается по факту прихода денег на р/с Поставщика,
самовывозом, при наличии доверенности и паспорта.
</div>
<div style="text-align: center; margin: 0px 180px; font-size: 12pt; font-weight: bold;">
Внимание! Изменились реквизиты.
Образец заполнения платежного поручения</div>
<table width="100%" cellspacing="0" cellpadding="0">
  <tbody><tr>
    <td  style="width:450px;min-height:54px;padding-bottom:0px;border-top:#000 solid 1px;border-left:#000 solid 1px;" rowspan="2" colspan="2">
    <table style="width:450px;" cellspacing="0" cellpadding="0" border="0">
    <tbody><tr>
    <td valign="top">
        <div style="width:430px;font-size:10pt;">
        <?php echo $dep['rs_t']." ".$dep['rs_p'] ?>
        </div>   
    </td>
    </tr>
    <tr>
    <td style="vertical-align: bottom; height:10px;">    
        <div style="width:350px;font-size:8pt;padding-top:5pt;">
Банк получателя
        </div>                    
    </td>
    </tr>
    </tbody></table>    
    </td>
    <td  style="width:100px;min-height:22px;height:auto; border-top:#000 solid 1px;border-left:#000 solid 1px;">
        <div style="width:100px;font-size:10pt;">БИK</div>    
    </td>
    <td  rowspan="2" style="border: #000 solid 1px;border-bottom:0px;width:200px;">
        <div style="width: 190px; font-size: 10pt; height: 22px; background-color: transparent;">
        <?php echo $dep['bik'] ?>
        </div>
        <div style="width: 190px; font-size: 10pt; background-color: transparent;">
       <?php echo $dep['rs_cr'] ?>
        </div>
    </td>
  </tr>
  <tr>
    <td  style="width: 100px; border-top: #000 solid 1px; border-left: #000 solid 1px">
        <div style="width:100px;font-size:10pt;">Сч. №</div>    
    </td>
  </tr>
  <tr>
    <td style="width:200px;min-height:16px;height:auto; border-top: #000 solid 1px;border-left: #000 solid 1px;">
        <div style="width:198px;font-size:10pt;">ИНН&nbsp;<?php echo $dep['inn'] ?></div>      
    </td>
    <td style="width:200px;min-height:16px;height:auto;border-top: #000 solid 1px;border-left: #000 solid 1px;">
        <div style="width:198px;font-size:10pt;">КПП&nbsp;<?php echo $dep['kpp'] ?></div>      
    </td>
    <td style="width:100px;min-height:62px;height:auto; border: #000 solid 1px;border-right:0px;" rowspan="2">
        <div style="width: 100px; font-size: 10pt; background-color: transparent;">Сч. №</div>     
    </td>
    <td style="width:200px;min-height:62px;height:auto; border: #000 solid 1px;" rowspan="2">
        <div style="width:190px;font-size:10pt;"><?php echo $dep['rs_n'] ?>
        </div>     
    </td>
  </tr>
  <tr>
    <td style="min-height:46px;height:auto;border: #000 solid 1px;border-right: 0px;" colspan="2">

    <table style="width:400px;" cellspacing="0" cellpadding="0" border="0">
    <tbody><tr>
    <td valign="top">
        <div style="width:400px;font-size:10pt;">
            <?php echo $dep['f_n'] ?>
        </div>  
    </td>
    </tr>
    <tr>
    <td valign="bottom" height="10">    
        <div style="width:400px;font-size:8pt;" id="seller_txt">Получатель</div>                        
    </td>
    </tr>
    </tbody></table>      

    </td>
  </tr>
</tbody></table> 
<br>
<div style="width: 700px; font-weight: bold; font-size: 14pt; padding-left: 5px; background-color: transparent;">
    Счет № <?php echo $model['name']; ?> от <?php echo Yii::app()->dateFormatter->formatDateTime($model['date'], 'long', null) ; ?>
</div>
<br>  
<div style="background-color:#000000;width:100%;font-size:1px;height:2px;">&nbsp;</div>
<table width="100%">
<tbody><tr>
<td style="width:70px;">
    <div style="width:70px;font-size:10pt;padding-left:2px;">
Поставщик:
    </div>
</td>
<td>
    <div style="width: 670px; font-weight: bold; font-size: 10pt; padding-left: 2px; background-color: transparent;">
    <?php 
    $postav="ИНН ".$dep['inn']." КПП ".$dep['kpp']." ".$dep['f_n']." ".$dep['inx'].", ".$dep['reg'].", ".$dep['add'];
     echo $postav;
    ?>
    </div>
</td>
</tr>
<tr>
<td style="width:70px;">
    <div style="width:70px;font-size:10pt;padding-left:2px;">
Покупатель:
    </div>
</td>
<td>
    <div style="width: 670px; font-weight: bold; font-size: 10pt; padding-left: 2px; background-color: transparent;" id="buyer_full">
    <?php 
    $client="ИНН ".$cli['inn']." КПП ".$cli['kpp']." ".$cli['f_n'].", ".$cli['tel'];
     echo $client;
    ?>
    </div>
</td>
</tr>
</tbody>
</table>

 <?php
 $dis=0;
 if($model->expSum>$model->expTot)     $dis=1;
 ?>
 
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<thead>
 <tr>
  <th style="width:30px; border: #000 solid 2px;border-right: 0px;">
    <div style="width:30px;text-align: center;">№</div>  
  </th> 
  <?php if($dis): ?>
     <th style="width:343px; border: #000 solid 2px;border-right: 0px;border-left: 1px;">
    <div style="background-color: transparent;text-align: center;">Товар</div>     
  </th>  
  <th style="width:55px; border: #000 solid 2px;border-right: 0px;border-left: 1px;">
    <div style="width:55px;text-align: center;">Кол - во</div>       
  </th>
  <th style="width:50px; border: #000 solid 2px;border-right: 0px;border-left: 1px;">
    <div style="width:50px;text-align: center;">Ед.</div>         
  </th>
  <th style="width:60px; border: #000 solid 2px;border-right: 0px;border-left: 1px;">
    <div style="width: 60px; background-color: transparent;text-align: center;">Цена</div>         
  </th>
   <th style="width:70px; border: #000 solid 2px;border-left: 1px;border-right: 0px;">
    <div style="width:70px;text-align: center;" >Сумма без скидки</div>           
  </th> 
   <th style="width:60px; border: #000 solid 2px;border-left: 1px;border-right: 0px;">
    <div style="width:60px;text-align: center;" >Скидка</div>           
  </th> 
   <th style="width:80px; border: #000 solid 2px;border-left: 1px;">
    <div style="width:80px;text-align: center;" >Сумма</div>           
  </th> 
 
   <?php else: ?>  
   <th style="width:460px; border: #000 solid 2px;border-right: 0px;border-left: 1px;">
    <div style="background-color: transparent;text-align: center;">Товар</div>     
  </th>  
  <th style="width:60px; border: #000 solid 2px;border-right: 0px;border-left: 1px;">
    <div style="width:60px;text-align: center;">Кол - во</div>       
  </th>
  <th style="width:50px; border: #000 solid 2px;border-right: 0px;border-left: 1px;">
    <div style="width:50px;text-align: center;">Ед.</div>         
  </th>
  <th style="width:70px; border: #000 solid 2px;border-right: 0px;border-left: 1px;">
    <div style="width: 70px; background-color: transparent;text-align: center;">Цена</div>         
  </th>
   <th style="width:80px; border: #000 solid 2px;border-left: 1px;">
    <div style="width:80px;text-align: center;" >Сумма</div>           
  </th>  
  <?php endif; ?>  
 </tr> 
</thead>                
 <tbody>
 <?php
		$resa=0;
		$resb=0;
		$rest=0;
    		$resv=0;
                $ii=0;
               $totcount=count($model->expd);
  	foreach($model->expd as $key=>$row) 	{
            $ii++;
 	$ret="<tr><td style='border-left:2px solid;text-align: right;".($ii==$totcount ? "":"border-bottom:1px dotted;")."'>".$row['id']."</td>"
                . "<td style='".($ii==$totcount ? "":"border-bottom:1px dotted;")."border-left:1px solid;text-align:left;padding-left:5px;'>".$row->product0['tnam']."</td>\n";
        $sumka=$row['amount']*$row['price'];
 	$ret.="<td style='text-align:right;border-left:1px solid;".($ii==$totcount ? "":"border-bottom:1px dotted;")."'>".Yii::app()->numberFormatter->formatCurrency($row['amount'], '')."</td>\n"; 
	$ret.="<td style='text-align:center;border-left:1px solid;".($ii==$totcount ? "":"border-bottom:1px dotted;")."'>".$row->product0->it0['sh_name']."</td>\n"; 
	$ret.="<td style='text-align:right;border-left:1px solid;".($ii==$totcount ? "":"border-bottom:1px dotted;")."'>".Yii::app()->numberFormatter->formatCurrency($row['price'], '')."</td>\n"; 
        if($dis)
        {
            $ret.="<td style='text-align:right;border-left:1px solid;".($ii==$totcount ? "":"border-bottom:1px dotted;")."'>".Yii::app()->numberFormatter->formatCurrency($sumka, '')."</td>\n";
             if($sumka==$row['total'])   $rate=0;
            else     $rate=$sumka-$row['total'];            
            $ret.="<td style='text-align:right;border-left:1px solid;".($ii==$totcount ? "":"border-bottom:1px dotted;")."'>".Yii::app()->numberFormatter->formatCurrency($rate, '')."</td>\n"; 
        }
	$ret.="<td style='text-align:right;border-right:2px solid;border-left:1px solid;".($ii==$totcount ? "":"border-bottom:1px dotted;")."'>".Yii::app()->numberFormatter->formatCurrency($row['total'], '')."</td>\n"; 
	$ret.="</tr>\n"; 
	$resa+=$sumka;
	$resb+=$row['total'];
	$rest+=$row['total']+$row['vat'];
	$resv+=$row['vat'];
		echo $ret;
	}
  
?>
<tr>
  <td style="width:670px;border-top:2px #000 solid;" <?php echo ($dis==0 ? "colspan='5'":"colspan='7'"); ?>>
    <div style="font-weight:bold;font-size:10pt;text-align:right;padding-right:5px;">Итого:</div>  
  </td>
  <td style="font-weight:bold;font-size:10pt;text-align:right;border-top:2px solid #000;">
 <?php echo Yii::app()->numberFormatter->formatCurrency($resb, ''); ?>
  </td>
   </tr>
<tr>
  <td style="border:0px;width:670px;" <?php echo ($dis==0 ? "colspan='5'":"colspan='7'"); ?>>
    <div style="font-weight:bold;font-size:10pt;text-align:right;padding-right:5px;">НДС:</div>  
  </td>
  <td style="font-weight:bold;font-size:10pt;text-align:right;border:0px;">
 <?php echo Yii::app()->numberFormatter->formatCurrency($resv, ''); ?>
  </td>
  </tr><tr>
  <td style="border:0px;width:670px;" <?php echo ($dis==0 ? "colspan='5'":"colspan='7'"); ?>>
    <div style="font-weight:bold;font-size:10pt;text-align:right;padding-right:5px;">Всего:</div>  
  </td>
  <td style="font-weight:bold;font-size:10pt;text-align:right;border:0px;">
  <?php echo Yii::app()->numberFormatter->formatCurrency($rest, ''); ?>

  </td>

 </tr>
</tbody></table>
 
<div>Всего наименований <?php echo $totcount ?> на сумму <?php echo Yii::app()->numberFormatter->formatCurrency($rest, ''); ?> руб.</div>
<div style="font-weight: bold;font-size: 12pt;"><?php echo CommonFunc::num2str($rest); ?></div>
<div style="font-style: italic ;font-size: 12pt;">С Вашей организацией работает <?php echo $model->account['name']; ?></div>
<div style="position: relative;">
<div style="font-size: 8pt;width:700px;">
    <ol>
   <li>Настоящий договор является офертой договора поставки указанной в счете</li>
<li>Заключение договора (акцепт) производится путем оплаты счета безналичным способом</li>
<li>Срок действия оферты (Срок оплаты настящего счета) 20 (двадцать) дней</li>
<li>Предоплата по данному счету 100%</li>
<li>Срок поставки продукции после получения предоплаты 30 дней</li>
<li> Под поставкой подразумевается самовывоз Покупателем продукции со склада поставщика или дата передачи продукции транспортной компании, указанной в пункте 6.1
    <ol>
 <li>Транспортная компания <?php echo $model->rtransport['name']; ?> </li>   
 <li>Покупатель несет ответственность за правильность предоставленных Поставщику отгрузочных реквизитов. </li>   
    </ol>
 </li>   
<li>За правильность подбора оборудования ответственность несет Покупатель</li>
</ol>
</div>
<div style="background-color:#000000;width:100%;font-size:1px;height:2px;">
    &nbsp;
</div>

<br/>
 
<table width="100%" cellspacing="0" cellpadding="0" border="0" >
    <tr>
        <td style="background-color: transparent; padding: 10px 10px 0; font-weight: bold; width:50px;">
            Руководитель
        </td>    
        <td style="width:100px;border-bottom: 1px solid;"></td>
        <td style="background-color: transparent; padding-top: 10px;">
            (<?php echo $dep['man_n']; ?> )
            </td>
       <td style="background-color: transparent; padding: 10px 10px 0; font-weight: bold; width:120px;">
            Главный бухгалтер
        </td>    
        <td style="width:100px;border-bottom: 1px solid;"></td>
        <td style="background-color: transparent; padding-top: 10px;">
            (<?php echo $dep['buh_n']; ?> )
            </td>
    </tr>
</table>
<br>
<div style="width:300px;text-align:center;padding-top: 20px;margin-left:50px;">М.П.</div>
<div style="position: absolute; left: 30px;top:80px;width:100%;">
<img src="<?php echo Yii::app()->params['pic_dir'].$dep['sign']; ?>" style="width:70px;position: absolute; left: 90px;top:70px;">
<img src="<?php echo Yii::app()->params['pic_dir'].$dep['stamp']; ?>" style="width:140px;position: absolute; left: 130px;top:10px;">
<img src="<?php echo Yii::app()->params['pic_dir'].$dep['sign']; ?>" style="width:70px;position: absolute; left: 450px;top:70px;">
</div>
</div>
</div>