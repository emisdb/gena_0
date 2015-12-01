
<table cellspacing="0" cellpadding="0" class="maintab">
        <tbody><tr>
            <td>
<table border="0" style="width:100%;border:0px;">
<tbody><tr>
<td>
</td>
<td align="left" style="width:300px;">
<div style="width: 300px; font-size: 7pt; background-color: transparent;" id="forma">
Унифицированная форма № ТОРГ-12 Утверждена<br>постановлением Госкомстата России от 25.12.98 № 132
</div>
</td>
</tr>
</tbody></table>

<table border="0"  id="headtab">
<tbody><tr>
<td width="800" style="z-index:100;">
<div>
    <?php 
    $postav=$dep['f_n'].", ИНН ".$dep['inn']."\\".$dep['kpp'].", ".$dep['inx'].", ".$dep['reg'].", ".$dep['add']
            .", р/с ".$dep['rs_n'].", в ".$dep['rs_t']." ".$dep['rs_p'].",БИК ".$dep['bik'].",корр/с ".$dep['rs_cr'] ;
    $client=$cli['f_n'].", ИНН ".$cli['inn'].", ".$cli['inx'].", ".$cli['reg'].", ".$cli['add'].", ".$cli['tel']
            .", р/с ".$cli['rs_n'].", в ".$cli['rs_t']." ".$cli['rs_p'].",БИК ".$cli['bik'].",корр/с ".$cli['rs_cr'] ;
    if (count($clix)>0)
    {
    $clientx=$clix['f_n'].", ИНН ".$clix['inn'].", ".$clix['inx'].", ".$clix['reg'].", ".$clix['add'].", ".$clix['tel']
            .", р/с ".$clix['rs_n'].", в ".$clix['rs_t']." ".$clix['rs_p'].",БИК ".$clix['bik'].",корр/с ".$clix['rs_cr'] ;
    }
    else 
    {
        if(is_null($cli['fadd']))     $clientx=$client;
        else
        {
      $clientx=$cli['f_n'].", ИНН ".$cli['inn'].", ".$cli['finx'].", ".$cli['freg'].", ".$cli['fadd'].", ".$cli['tel']
            .", р/с ".$cli['rs_n'].", в ".$cli['rs_t']." ".$cli['rs_p'].",БИК ".$cli['bik'].",корр/с ".$cli['rs_cr'] ;
          
        }

    }
    echo $postav;
    ?>
</div>
<div class="undertext undertext_long">грузоотправитель, адрес, номер телефона, банковские реквизиты</div>
<div  class="undertext undertext_long">структурное подразделение</div>
    <table width="100%">
        <tbody><tr>
            <td width="125" align="right">
                <div class="headlabel">Грузополучатель</div></td>
            <td class="underline"><?php echo $clientx; ?></td>
        </tr>
        <tr>
            <td width="125" align="right">
                <div class="headlabel">Поставщик</div></td>
            <td class="underline"><?php echo $postav; ?></td>
        </tr>
        <tr>
            <td width="125" align="right">
                <div class="headlabel">Плательщик</div></td>
            <td class="underline"><?php echo $client; ?></td>
        </tr>
        <tr>
            <td width="125" align="right">
                <div class="headlabel">Основание</div></td>
            <td>
                <?php echo (isset($model->exp)? "Заявка №".$model->exp['name']." от ".Yii::app()->dateFormatter->formatDateTime($model->exp['date'], 'short', null):"") ; ?>
                <?php
                    if(count($model->exp->pays)>0)
                    {
                        echo " по плат. док. №".$model->exp->pays[0]->name." от ".Yii::app()->dateFormatter->formatDateTime($model->exp->pays[0]->date, 'short', null);
                    }
                ?>
            
            </td>
         </tr>
        <tr>
            <td width="125" align="right"></td>
            <td valign="top">
                <div style="font-size: 6.5pt;" class="undertext">
                    договор, заказ-наряд</div></td>
        </tr>                   
    </tbody></table>
</td>
<td valign="top" align="right" rowspan="2">
<div id="codeblock">
<table  cellspacing="0" cellpadding="0" border="0" >
    <tbody><tr>
        <td colspan="2"></td>
        <td class="tdr" style="font-size:6.5pt; border: 1px solid; border-bottom-width: 2px;">
                Код
        </td>
    </tr>
    <tr>
        <td class="tdl" colspan="2">Форма по ОКУД</td>
        <td class="tdr" >0330212</td>
    </tr>  
    <tr>
        <td class="tdl" colspan="2">по ОКПО </td>
        <td class="tdr" ><?php echo $dep['okpo']; ?></td>
    </tr>   
    <tr>
        <td class="tdl" colspan="2">&nbsp;</td>
        <td class="tdr" ></td>
    </tr> 
    <tr>
        <td class="tdl" colspan="2">Вид деятельности по ОКДП</td>
        <td class="tdr" ></td>
    </tr>   
     <tr>
        <td class="tdl" colspan="2" style="padding: 6px 5px;">по ОКПО </td>
        <td class="tdr" ><?php echo $cli['okpo']; ?></td>
    </tr>   
    <tr>
        <td class="tdl" colspan="2" style="padding: 6px 5px;">по ОКПО </td>
        <td class="tdr" ><?php echo $dep['okpo']; ?></td>
    </tr>   
    <tr>
        <td class="tdl" colspan="2" style="padding: 6px 5px;">по ОКПО </td>
        <td class="tdr" ><?php echo $cli['okpo']; ?></td>
    </tr>   

    <tr>
        <td></td>
         <td class="tdl tdll">номер</td>
        <td class="tdr" ></td>
    </tr>     
    <tr>
        <td></td>
         <td class="tdl tdll">дата</td>
        <td class="tdr" ></td>
    </tr>     
 <tr>
         <td class="tdl">Транспортная накладная</td>
         <td class="tdl tdll">номер</td>
        <td class="tdr" ></td>
    </tr>     
    <tr>
        <td></td>
         <td class="tdl tdll" style="border-bottom-width: 1px;">дата</td>
        <td class="tdr" ></td>
    </tr>     
    <tr>
        <td class="tdl" colspan="2">Вид операции</td>
        <td class="tdr" style="border-bottom-width: 2px;" ></td>
    </tr>   
 
</tbody></table>
</div>
</td></tr>
    <tr>
<td style="vertical-align: bottom;">
        <table width="100%">
            <tbody><tr>
                <td width="50%" align="right" style="font-size:10pt;font-weight:bold;">
                         ТОВАРНАЯ НАКЛАДНАЯ
                </td>
                <td align="left">
                    <table cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                            <tr>
                                <td width="100" align="center" style="border:1px solid;">
                                    <div class="undertext undertext_short">Номер документа</div></td>
                                <td width="100" align="center" style="border:1px solid;border-left:0px;">
                                    <div class="undertext undertext_short">Дата составления</div></td>
                            
                            </tr>
                        <tr>
                            <td class="tdd" style="border-right-width: 1px;"><?php echo $model['name']; ?></td>
                            <td class="tdd" style="border-left-width: 1px;"><?php echo Yii::app()->dateFormatter->formatDateTime($model['date'], 'short', null) ; ?></td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
        </tbody></table>

 

</td>
</tr>

</tbody></table>
<br>
      <?php     
      $counts=array(
                    'totamount'=>0,
                     'totsum'=>0,
                     'totvat'=>0,
                     'totsumvat'=>0,
                     'gtotamount'=>0,
                     'gtotsum'=>0,
                     'gtotvat'=>0,
                     'gtotsumvat'=>0,
          );

                $totnum=0;
               $totpage=0;
                $totcount=count($model->invd);
                $strtab="";$gstrtab="";
                 foreach($model->invd as $key=>$value)
                 {
                    $price=$value['total']/$value['amount'];
                    $sumsum=$value['total']+$value['vat'];
                     $totnum++;
                    $gstrtab.=$strtab;
                $strtab="<tr>";
                 $strtab.="<td style='border-left:1px solid;text-align:center;'>".$value['id']
                           ."</td><td style='text-align:left;border-right:0px;'>".$value->product0['tnam']
                           ."</td><td style='border-width:0px 3px 1px;'></td>"
                           ."<td  style='text-align:center;'>".$value->product0->it0['sh_name']
                           ."</td><td style='text-align:center;border-left:2px solid;'>".$value->product0->it0['okei']."</td>"
                           ."<td></td><td></td><td></td><td></td>"
                           ."<td style='"."'>".$value['amount']."</td>"
                           ."<td style='"."'>".Yii::app()->numberFormatter->formatCurrency($price,"")."</td>"
                           ."<td style='border-right:3px solid;"."'>".Yii::app()->numberFormatter->formatCurrency($value['total'],"")."</td>"
                           ."<td style='text-align:center;'>18%</td>"
                           ."<td style='border-left:2px solid;"."'>".Yii::app()->numberFormatter->formatCurrency($value['vat'],"")."</td>"
                          ."<td style='border-right:3px solid;"."'>".Yii::app()->numberFormatter->formatCurrency($sumsum,"")."</td>";
                   $strtab.="</tr>\n";
                   
                    if(!(($totnum-18)%30))
                     {
                          echo $this->renderPartial('_torg_head', array('tabtype'=>0,'counts'=>$counts,'tab'=>$gstrtab)); 
                          $gstrtab='';
                         $counts['gtotamount']+=$counts['totamount'];
                        $counts['gtotsum']+=$counts['totsum'];
                        $counts['gtotvat']+=$counts['totvat'];
                        $counts['gtotsumvat']+=$counts['totsumvat'];
                        $counts['totamount']=0;
                        $counts['totsum']=0;
                        $counts['totvat']=0;
                        $counts['totsumvat']=0;
                        $totpage++;
                      }
                    if($totcount>$totnum)
                    {
                      $counts['totamount']+=$value['amount'];
                      $counts['totsum']+=$value['total'];
                      $counts['totvat']+=$value['vat'];
                      $counts['totsumvat']+=$sumsum;
                    }


                  }

                 if($totnum<3)
                 {
                    $counts['totamount']+=$value['amount'];
                    $counts['totsum']+=$value['total'];
                    $counts['totvat']+=$value['vat'];
                    $counts['totsumvat']+=$sumsum;
                    $counts['gtotamount']+=$counts['totamount'];
                    $counts['gtotsum']+=$counts['totsum'];
                    $counts['gtotvat']+=$counts['totvat'];
                    $counts['gtotsumvat']+=$counts['totsumvat'];
                       echo $this->renderPartial('_torg_head', array('tabtype'=>1,'counts'=>$counts,'tab'=>$gstrtab.$strtab)); 
                        $totpage++;
                 }
                 elseif($totnum<18)
                 {
                        $counts['gtotamount']+=$counts['totamount'];
                        $counts['gtotsum']+=$counts['totsum'];
                        $counts['gtotvat']+=$counts['totvat'];
                        $counts['gtotsumvat']+=$counts['totsumvat'];
                           echo $this->renderPartial('_torg_head', array('tabtype'=>0,'counts'=>$counts,'tab'=>$gstrtab)); 
                         $totpage++;
                        $counts['totamount']=$value['amount'];
                        $counts['totsum']=$value['total'];
                        $counts['totvat']=$value['vat'];
                        $counts['totsumvat']=$sumsum;
                        $counts['gtotamount']+=$counts['totamount'];
                        $counts['gtotsum']+=$counts['totsum'];
                        $counts['gtotvat']+=$counts['totvat'];
                        $counts['gtotsumvat']+=$counts['totsumvat'];
                         echo $this->renderPartial('_torg_head', array('tabtype'=>1,'counts'=>$counts,'tab'=>$strtab)); 
                        $totpage++;
                 }
                 else
                 {
                     $rnum=($totnum-18)%30;
                     if(!$rnum)
                     {
                         $counts['totamount']=$value['amount'];
                        $counts['totsum']=$value['total'];
                        $counts['totvat']=$value['vat'];
                        $counts['totsumvat']=$sumsum;
                        $counts['gtotamount']+=$counts['totamount'];
                        $counts['gtotsum']+=$counts['totsum'];
                        $counts['gtotvat']+=$counts['totvat'];
                        $counts['gtotsumvat']+=$counts['totsumvat'];
                            echo $this->renderPartial('_torg_head', array('tabtype'=>1,'counts'=>$counts,'tab'=>$strtab)); 
                           $totpage++;
                  }
                     elseif($rnum<18)
                     {
                            $counts['totamount']+=$value['amount'];
                            $counts['totsum']+=$value['total'];
                            $counts['totvat']+=$value['vat'];
                            $counts['totsumvat']+=$sumsum;
                            $counts['gtotamount']+=$counts['totamount'];
                            $counts['gtotsum']+=$counts['totsum'];
                            $counts['gtotvat']+=$counts['totvat'];
                            $counts['gtotsumvat']+=$counts['totsumvat'];
                                  echo $this->renderPartial('_torg_head', array('tabtype'=>1,'counts'=>$counts,'tab'=>$gstrtab.$strtab)); 
                               $totpage++;
              }
                        else
                       {
                         $counts['gtotamount']+=$counts['totamount'];
                        $counts['gtotsum']+=$counts['totsum'];
                        $counts['gtotvat']+=$counts['totvat'];
                        $counts['gtotsumvat']+=$counts['totsumvat'];
                                 echo $this->renderPartial('_torg_head', array('tabtype'=>0,'counts'=>$counts,'tab'=>$gstrtab)); 
                             $totpage++;
                    $counts['totamount']=$value['amount'];
                        $counts['totsum']=$value['total'];
                        $counts['totvat']=$value['vat'];
                        $counts['totsumvat']=$sumsum;
                        $counts['gtotamount']+=$counts['totamount'];
                        $counts['gtotsum']+=$counts['totsum'];
                        $counts['gtotvat']+=$counts['totvat'];
                        $counts['gtotsumvat']+=$counts['totsumvat'];
                                echo $this->renderPartial('_torg_head', array('tabtype'=>1,'counts'=>$counts,'tab'=>$strtab)); 
                         $totpage++;
                      }
                 }

     ?>
<table width="100%" class="footer">
    <tbody><tr>
            <td rowspan="3" style="width:150px"></td>
        <td style="text-align:left;font-size:8pt;" colspan="3">Товарная накладная имеет приложение на  
          <?php echo ($totpage>1)? "$totpage листах" : "$totpage листе"; ?>  
         </td>
      </tr>
      <tr>
         <td style="text-align:left;font-size:8pt;padding-right:10px;">и содержит</td>
        <td style="text-align:left;font-size:8pt;border-bottom: 1px solid;width:400px;padding-left:10px;">
            <?php echo CommonFunc::num2str($totnum,2); ?></td>
        <td style="text-align:left;font-size:8pt;">порядковых номеров записей</td>
        </tr>
        <tr>
            <td style="width: 87%; font-size: 6.5pt; text-align: center; background-color: transparent;" colspan="3">прописью</td>
        </tr>
</tbody></table>   
<table width="100%" class="footer">
    <tbody><tr>
        <td width="365" valign="bottom" align="right">
        <div style="font-size:8pt;display:inline;">Всего мест</div><div style="display:inline;">___________________________</div>
        <div style="width:180px;font-size:6.5pt;text-align:center;">прописью</div>
        
        </td>
        <td valign="top" align="right" style="padding-left:80px;"> 
            <table width="100%"  cellspacing="0" cellpadding="0" border="0" >
                <tr>
                    <td style="width:110px;"><div style="font-size:10px;padding: 3px 0;">Масса груза (нетто)</div></td> 
                    <td style="border-bottom: 1px solid;"></td>
                    <td style="border:2px solid;width:80px;margin-bottom:0px;"></td> 
                </tr>    
                <tr>
                    <td style="width:110px;"><div style="font-size:10px;padding: 3px 0;">Масса груза (брутто)</div></td>
                    <td style="border-bottom: 1px solid;font-size: 6.5px; text-align: center; vertical-align: top; ">прописью</td>
                    <td style="border:2px solid;width:80px;margin-bottom:2px;"></td> 
                </tr>    
                <tr>
                    <td></td> <td style="font-size: 6.5px; text-align: center;">прописью</td> <td></td> 
                </tr>    
            </table>
         </td>
    </tr>            
</tbody></table> 
<table width="100%" class="footer">  
    <tbody><tr>
        <td style="border-right:1px solid;width:50%;">
<div style="display:inline;">Приложение (паспорта, сертификаты и т.п) на</div><div style="display:inline;">  _________________</div> <div style="display:inline;">листах</div>
        <div style="font-size: 6.5pt; padding-left: 270px; background-color: transparent;">прописью</div>
<div style="font-weight:bold;margin-bottom:5px;">Всего отпущено <?php echo CommonFunc::num2str($totnum,1); ?><br>на сумму 
<?php echo CommonFunc::num2str($counts['gtotsumvat']); ?>
</div>
<table style="width:100%;" cellspacing="1">
    <tbody><tr>
        <td style="text-align:left;width:130px;"><div>Отпуск разрешил</div></td>
        <td style="text-align:center;width:150px;"> <?php echo $dep['man_p']; ?></td>
        <td style="text-align:left;width:80px;">&nbsp;</td>
        <td style="text-align:center;"><div style="background-color: transparent;">
               <?php echo $dep['man_n']; ?>
                </div></td>
   </tr>
    <tr>
        <td align="left" style="font-size:6.5pt;">&nbsp;</td>
        <td style="padding:0px;padding-left:3px;padding-right:3px;">
            <div style="border-top:1px solid;font-size:6.5pt;text-align:center;">должность</div></td>
        <td style="padding:0px 3px;">
            <div style="border-top:1px solid;font-size:6.5pt;text-align:center;">подпись</div></td>
        <td style="padding:0px 3px;">
            <div style="border-top-width: 1px; border-top-style: solid; font-size: 6.5pt; text-align: center; background-color: transparent;" >расшифровка подписи</div></td>
   </tr>   
   
    <tr>
        <td align="left" colspan="2"><div>Главный (старший бухгалтер)</div></td>        
        <td style="width:100px;"> &nbsp;</td>
        <td style="width:100px;text-align:center;">
            <div style="background-color: transparent;">
 <?php echo $dep['buh_n']; ?>
            </div></td>
   </tr>
    <tr>
        <td align="left" style="font-size:6.5pt;" colspan="2">&nbsp;</td>        
        <td style="padding:0px;padding-left:3px;padding-right:3px;">
            <div style="border-top:1px solid;font-size:6.5pt;text-align:center;">подпись</div></td>
        <td style="padding:0px;padding-left:3px;padding-right:3px;">
            <div style="border-top-width: 1px; border-top-style: solid; font-size: 6.5pt; text-align: center; background-color: transparent;">расшифровка подписи</div></td>
   </tr>      
   
    <tr>
        <td align="left">
            <div>Отпуск груза произвел</div></td>
        <td style="width:100px;">&nbsp;</td>
        <td style="width:100px;">&nbsp;</td>
        <td style="text-align:center;width:100px;">
            <div style="background-color: transparent;">&nbsp;</div></td>
   </tr>
    <tr>
        <td align="left" style="font-size:6.5pt;">&nbsp;</td>
        <td style="padding:0px;padding-left:3px;padding-right:3px;">
            <div style="border-top:1px solid;font-size:6.5pt;text-align:center;">должность</div></td>
        <td style="padding:0px;padding-left:3px;padding-right:3px;">
            <div style="border-top:1px solid;font-size:6.5pt;text-align:center;">подпись</div></td>
        <td style="padding:0px;padding-left:3px;padding-right:3px;">
            <div style="border-top:1px solid;font-size:6.5pt;text-align:center;">расшифровка подписи</div></td>
   </tr>      
</tbody></table>       
<table width="100%">
<tbody><tr>
    <td width="50%" align="center"><div style="font-size:8pt;text-align:center;">М.П.</div></td>
    <td><div style="font-size:8pt;text-align:center;float:left;" >''</div><div style="width:20px;float: left;">&nbsp</div><div style="float: left;">''&nbsp;______________ 20</div><div style="width:20px;float:left;">&nbsp</div>года</td>
</tr>
</tbody></table>     
         
        </td>
        <td style="width:50%;padding-left:30px;vertical-align:top;"><br>
        <table width="100%"  cellspacing="0" cellpadding="0" border="0" style="text-align: left;" >
                <tr>
                    <td style="width:200px;">По доверенности №</td> <td style="width:60px;"></td> <td>от</td> 
                </tr>    
                 <tr>
                    <td style="width:110px;">выданной</td> <td colspan="2" style="border-bottom: 1px solid;"></td> 
                </tr>    
                <tr>
                    <td></td> <td colspan="2" style="font-size: 6.5px; text-align: center;">кем, кому (организация, должность, фамилия, и.о.)</td> 
                </tr>    
            </table>

<div style="font-size:6.5pt;"></div>

<div style="border-bottom:1px solid;width:100%;">&nbsp;</div>
<table style="width:100%;margin-top:10px;" cellspacing="1">
    <tbody><tr>
        <td align="left"><div>Груз принял</div></td>
        <td width="100" style="padding:2px;">&nbsp;</td>
        <td width="100" style="padding:2px;">&nbsp;</td>
        <td width="100" style="text-align:center;padding:2px;"><div> </div></td>
   </tr>
    <tr>
        <td align="left" style="font-size:6.5pt;">&nbsp;</td>
        <td style="padding:0px;padding-left:3px;padding-right:3px;">
            <div style="border-top:1px solid;font-size:6.5pt;text-align:center;">должность</div></td>
        <td style="padding:0px;padding-left:3px;padding-right:3px;">
            <div style="border-top:1px solid;font-size:6.5pt;text-align:center;">подпись</div></td>
        <td style="padding:0px;padding-left:3px;padding-right:3px;">
            <div style="border-top:1px solid;font-size:6.5pt;text-align:center;">расшифровка подписи</div></td>
   </tr>   
   
    <tr>
        <td valign="top" align="left" rowspan="2"><div>Груз получил<br>грузополучатель</div></td>
        <td width="100" style="padding:2px;">&nbsp;</td>
        <td width="100" style="padding:2px;">&nbsp;</td>
        <td width="100" style="text-align:center;padding:2px;">
            <div> </div></td>
   </tr>
    <tr>
        
        <td style="padding:0px;padding-left:3px;padding-right:3px;">
            <div style="border-top:1px solid;font-size:6.5pt;text-align:center;">должность</div></td>
        <td style="padding:0px;padding-left:3px;padding-right:3px;">
            <div style="border-top:1px solid;font-size:6.5pt;text-align:center;">подпись</div></td>
        <td style="padding:0px;padding-left:3px;padding-right:3px;">
            <div style="border-top:1px solid;font-size:6.5pt;text-align:center;">расшифровка подписи</div></td>
   </tr>      
</tbody></table> 
<table style="width:100%;margin-top:10px;">
<tbody><tr>
    <td style="width:50%;text-align:center;">
        <div style="font-size:8pt;text-align:center;">М.П.</div></td>
    <td><div style="font-size:8pt;text-align:center;float:left;" >''</div><div style="width:20px;float: left;">&nbsp</div><div style="float: left;">''&nbsp;______________ 20</div><div style="width:20px;float:left;">&nbsp</div>года</td>
</tr>
</tbody></table>    
        </td>        
    </tr>
</tbody></table>        

</td>
        </tr>
        </tbody></table>
