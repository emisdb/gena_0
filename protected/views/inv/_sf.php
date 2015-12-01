<table  cellspacing="0" cellpadding="0" class="maintab">
        <tbody><tr>
            <td>
<table width="100%" border="0">
<tbody><tr>
<td width="100%" align="right">
 <div style="width: 986px;" class="headnotes">Приложение №1
</div>
<div style="width: 986px; " class="headnotes">к постановлению Правительства Российской Федерации
</div>
<div style="width: 986px;" class="headnotes">от 26 декабря 2011 г. № 1137
</div>
</td>
</tr>
<tr>
<td>
    <div style="text-align:center;width:796px;font-size:10pt;font-weight:bold;">
&nbsp;                                                                                                                        
    </div>
    
</td>
</tr>
</tbody>
</table>

<div class="schetcom_number_date">
    СЧЕТ-ФАКТУРА №
<?php echo $model['name']; ?>  от 
    <?php echo Yii::app()->dateFormatter->formatDateTime($model['date'], 'long', null) ; ?>
</div>
<div  class="schetcom_number_date">
    Исправление № -- от --
 </div>

<table width="100%">
<tbody><tr>
<td>
    <div class="schetcom_prodavec">
        Продавец: <?php echo $dep['f_n']; ?> 
    </div>
</td>
</tr>
<tr>
<td>
 <div class="schetcom_prodavec">    
     Адрес: <?php echo $dep['inx'].", ".$dep['reg'].", ".$dep['add']; ?> 
     </div>
</td>
</tr>
<tr>
<td>
<div class="schetcom_prodavec"> 
    ИНН/КПП продавца: <?php echo $dep['inn']."\\".$dep['kpp']; ?> 
         </div>
</td>
</tr>
<tr>
<td>
<div class="schetcom_prodavec"> 
    Грузоотправитель и его адрес: Он же
         </div>
</td>
</tr>
<tr>
<td>
<div class="schetcom_prodavec"> 
        <?php 
   if (count($clix)>0)
    $clientx=$clix['f_n'].", ".$clix['inx'].", ".$clix['reg'].", ".$clix['add'];
    else 
    {
        if(is_null($cli['fadd']))     $clientx=$cli['f_n'].", ".$cli['inx'].", ".$cli['reg'].", ".$cli['add'];
        else  $clientx=$cli['f_n'].", ".$cli['finx'].", ".$cli['freg'].", ".$cli['fadd'];

    }
     ?>
    Грузополучатель и его адрес:<?php echo $clientx; ?> 
   </div>
</td>
</tr>
<tr>
<td>
 <div class="schetcom_prodavec"> 
     К платежно-расчетному документу № 
     <span style="min-width: 60px;text-decoration: underline;">
         <?php
         echo ((count($model->exp->pays)>0) ? $model->exp->pays[0]->name : "")
          ?>   
     </span>
             от 
     <span style="min-width: 60px;text-decoration: underline;">
         <?php
         echo ((count($model->exp->pays)>0) ? Yii::app()->dateFormatter->formatDateTime($model->exp->pays[0]->date, 'short', null) : "__.__.__")
           ?>   
     </span>

    </div>
</td>
</tr>
<tr>
<td>
<div class="schetcom_prodavec">
        Покупатель:<?php echo$cli['f_n']; ?> 
     </div>
</td>
</tr>
<tr>
<td>
<div class="schetcom_prodavec">
        Адрес: <?php echo $cli['inx'].", ".$cli['reg'].", ".$cli['add']; ?> 
    </div>
</td>
</tr>
<tr>
<td>
<div class="schetcom_prodavec">
        ИНН/КПП покупателя: <?php echo $cli['inn']."\\".$cli['kpp']; ?> 
   </div>
</td>
</tr>
</tbody></table>

<div style="width:100%;font-size:8pt;">
    Валюта: наименование, код Российский рубль, 643
  </div>


<table style="width:1040px;" cellspacing="0" cellpadding="0" border="0" class="invoice_com_items items">
<thead>
 <tr>
  <th rowspan="2" style="width:160px;">
    <div style="width:160px;">Наименование товара (описание выполненных работ, оказанных услуг), имущественного права</div>  
  </th> 
  <th colspan="2" style="width:124px;">
    <div style="width:122px;"  id="ed_txt">Единица<br>измерения</div>
  </th> 
  <th rowspan="2" style="width:58px;">
    <div style="width:58px;"  class="editable_sys" id="kol_txt">Коли-<br>чество</div>       
  </th>
  <th rowspan="2" style="width:68px;">
    <div style="width: 65px; background-color: transparent;"  class="editable_sys" id="item_price_txt">Цена<br> (тариф) за<br> единицу<br> измерения</div>         
  </th>
  <th rowspan="2" style="width:81px;">
    <div style="width: 80px; background-color: transparent;"  class="editable_sys" id="price_txt">Стоимость товаров (работ, услуг), имущественных прав без налога - всего</div>
  </th>
  <th rowspan="2" style="width:74px;">
    <div style="width:71px;"  class="editable_sys" id="akciz_txt">В том числе сумма акциза</div>           
  </th>  
  <th rowspan="2" style="width:60px;">
    <div style="width:60px;"  class="editable_sys" id="nds_txt">Налоговая ставка</div>           
  </th>    
  <th rowspan="2" style="width:85px;">
    <div style="width:81px;"  class="editable_sys" id="nds_summ_txt">Сумма налога,<br>предъявляемая<br>покупателю</div>
  </th>    
  <th rowspan="2" style="width:85px;">
    <div style="width:85px;"  class="editable_sys" id="total_summ_txt">Стоимость товаров (работ, услуг), имущественных прав с налогом - всего</div>
  </th>    
  <th colspan="2" style="width:130px;">
    <div style="width:128px;"  class="editable_sys" id="country_txt">Страна происхождения товара</div>
  </th>      
  <th rowspan="2" style="width:108px;">
    <div style="width:108px;"  class="editable_sys" id="gtd_txt">Номер<br>таможенной<br>декларации</div>           
  </th>          
  </tr>
<tr>
    <th style="width: 40px; background-color: transparent;"  class="editable_sys" id="ed_txt_1">код</th>
    <th style="width:80px;"  class="editable_sys" id="ed_txt_2">условное обозначение (национальное)</th>
    <th style="width:46px;"  class="editable_sys" id="country_txt_1">цифровой <br>код</th>
    <th style="width:84px;"  class="editable_sys" id="country_txt_2">краткое<br>наименование</th>
</tr>
  

 <tr>
  <th style="width:160px;">
    <div style="width:160px;"  class="editable_sys" id="name_id">1</div>  
  </th> 
  <th style="width:40px;">
    <div style="width:40px;"  class="editable_sys" id="ed_id">2</div>    
  </th>
  <th style="width:45px;">
    <div style="width:80px;"  class="editable_sys" id="ed_id2">2а</div>
  </th>
  <th style="width:58px;">
    <div style="width: 58px; background-color: transparent;"  class="editable_sys" id="kol_id">3</div>       
  </th>
  <th style="width:68px;">
    <div style="width: 65px; background-color: transparent;"  class="editable_sys" id="item_price_id">4</div>         
  </th>
  <th style="width:81px;">
    <div style="width:81px;"  class="editable_sys" id="price_id">5</div>         
  </th>
  <th style="width:54px;">
    <div style="width:50px;"  class="editable_sys" id="akciz_id">6</div>           
  </th>  
  <th style="width:60px;">
    <div style="width:60px;"  class="editable_sys" id="nds_id">7</div>           
  </th>    
  <th style="width:71px;">
    <div style="width:67px;"  class="editable_sys" id="nds_summ_id">8</div>           
  </th>    
  <th style="width:80px;">
    <div style="width: 80px; background-color: transparent;"  class="editable_sys" id="total_summ_id">9</div>           
  </th>    
  <th style="width:46px;">
    <div style="width:46px;"  class="editable_sys" id="country_id">10</div>
  </th>
  <th style="width:84px;">
    <div style="width:84px;"  class="editable_sys" id="country_id2">10а</div>
  </th>
  <th style="width:108px;">
    <div style="width:108px;"  class="editable_sys" id="gtd_id">11</div>           
  </th>          
  </tr> 
</thead>             
 <tbody>
    <?php
                $totamount=0;
                $totsum=0;
                $totnum=0;
                $totvat=0;
                $totsumvat=0;
                $totcount=count($model->invd);
                 foreach($model->invd as $key=>$value)
                 {
                    $price=$value['total']/$value['amount'];
                    $sumsum=$value['total']+$value['vat'];
                    $totamount+=$value['amount'];
                    $totsum+=$value['total'];
                    $totvat+=$value['vat'];
                    $totsumvat+=$sumsum;
                    $totnum++;
                 echo "<tr>";
                   echo "<td style='text-align:left;border-left:1px solid;'>".$value->product0['tnam']
                        ."</td><td style='text-align:center;border-left:1px solid;'>".$value->product0->it0['okei']."</td>"
                        ."</td><td  style='text-align:center;'>".$value->product0->it0['sh_name']."</td>"
                        ."<td style='border-top: 1px solid;'>".$value['amount']."</td>"
                        ."<td style='border-top: 1px solid;'>".Yii::app()->numberFormatter->formatCurrency($price,"")."</td>"
                        ."<td style='border-right:1px solid;border-top: 1px solid;'>".Yii::app()->numberFormatter->formatCurrency($value['total'],"")."</td>"
                        ."<td style='text-align:center;'>без акциза</td>"
                        ."<td style='text-align:center;'>18%</td>"
                        ."<td style='border-left:1px solid;'>".Yii::app()->numberFormatter->formatCurrency($value['vat'],"")."</td>"
                       ."<td style='border-right:1px solid;'>".Yii::app()->numberFormatter->formatCurrency($sumsum,"")."</td>"
                       ."<td style='text-align:center;'></td>"
                        ."<td style='text-align:center;'></td>"
                       ."<td style='border-right:1px solid;'></td>";
                   echo "</tr>\n";
                   
                 }
 
     ?>

 <tr>
     <td valign="center" colspan="5" style="border-left: 1px solid;">
    <div style="font-weight:bold;font-size:10pt;width:300px;text-align: left;">Всего к оплате:</div>    
  </td>
  <td>
      <?php echo Yii::app()->numberFormatter->formatCurrency($totsum,"") ?>
  </td>
 <td style="text-align: center;" colspan="2">
     X
 </td>
 <td>    <?php echo Yii::app()->numberFormatter->formatCurrency($totvat,"") ?>

 </td>
  <td style="font-weight:bold;font-size:10pt;text-align:right;">
 <?php echo Yii::app()->numberFormatter->formatCurrency($totsumvat,"") ?>
  </td>
<td style="border:0px;" colspan="3"></td>
 </tr> 
</tbody></table>

<br>
    <table width="100%" cellspacing="0" cellpadding="0" border="0" >
    <tr>
        <td style="background-color: transparent; padding: 10px 10px 0; text-align: right;width:170px;">
            Руководитель организации <br> или иное уполномоченное лицо
        </td>    
        <td style="width:135px;border-bottom: 1px solid;"></td>
        <td style="background-color: transparent; padding-top: 10px;">
            (<?php echo $dep['man_n']; ?> )
            </td>
       <td style="background-color: transparent; padding: 10px 10px 0;  text-align: right;width:190px;">
            Главный бухгалтер <br> или иное уполномоченное лицо
        </td>    
        <td style="width:135px;border-bottom: 1px solid;"></td>
        <td style="background-color: transparent; padding-top: 10px;">
            (<?php echo $dep['buh_n']; ?> )
            </td>
    </tr>
    <tr>
        <td> </td>    
       <td style="padding:0px 3px;">
            <div style="font-size:6.5pt;text-align:center;">(подпись)</div></td>
        <td></td>
       <td></td>    
       <td style="padding:0px 3px;">
            <div style="font-size:6.5pt;text-align:center;">(подпись)</div></td>
        <td></td>
    </tr></table>

<table width="100%">
<tbody><tr>
<td width="500" valign="top">

<div  class="editable_sys">Индивидуальный предприниматель ______________________ </div>
<div style="font-size: 6.5pt; text-align: center; background-color: transparent;"   id="ip_mile">подпись</div>
</td>
<td valign="top">
<br>
<div  class="editable_sys" id="ogrn" style="background-color: transparent;">___________________________________________________________________</div>
<div style="font-size: 6.5pt; width: 402px; text-align: center; background-color: transparent;"  class="editable_sys" id="ogrn_mile">(реквизиты свидетельства о государственной<br>регистрации индивидуального предпринимателя)</div>
<br>
<br>
</td>
</tr>
</tbody></table>
<div style="font-size: 7pt; background-color: transparent;"  class="editable_sys" id="prim">ПРИМЕЧАНИЕ. Первый экземпляр - покупателю, второй экземпляр - продавцу</div>
<br>


</td>
        </tr>
        </tbody></table>