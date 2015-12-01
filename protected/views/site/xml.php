<?php
$this->widget("ext.smartwizard.smartWizard",array(
               "onFinish"=>'onFinishCallback',
               "onLeaveStep"=>'leaveAStepCallback',//more options check attached documentation
 
               "tabs"=>array(
                  array(
                     "StepTitle"=>"Контрагенты и фирмы",
                     "stepDetails"=>"Проверьте обнаруженные значения фирм и клиентов",                    
                     "content"=>$this->renderPartial("clients",array(),true,false)
                     ),
                   array(
                     "StepTitle"=>"Товары",
                     "stepDetails"=>"Проверьте обнаруженные значения товаров",                    
                     "content"=>$this->renderPartial("products",array(),true,false)
                     ),
                    array(
                     "StepTitle"=>"Счета",
                     "stepDetails"=>"Проверьте обнаруженные счета",                    
                     "content"=>$this->renderPartial("orders",array(),true,false)
                     ),
                    array(
                     "StepTitle"=>"Накладные",
                     "stepDetails"=>"Проверьте обнаруженные накладные",                    
                     "content"=>$this->renderPartial("invoices",array(),true,false)
                     ),
 
                  ),
         ));
 ?>