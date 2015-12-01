<?php

/**
 * XmlForm class.
 * XmlForm is the data structure for keeping
 * xml parsing form data. It is used by the 'xml' action of 'ProductController'.
 */
class XmlForm extends CFormModel
{
   private $textic;
   private $fp;
   private $stopfp=false;
   public $map = array();
  public $total;
    /**
     * Declares the validation rules.
     */
  public function rules()    {
		return array(
			array('textic', 'required'),
			array('textic', 'safe', 'on'=>'search'),
		);
    }
  public function attributeLabels()  {
        return array(
            'textic'=>'Файл загрузки',
        );
    }

  protected function getfilename()   {
             $id=$this->cid;
             $sysmodel=Systems::model()->find('vendor_company_id=:uID', array(':uID'=>$id));
             if(!($sysmodel==null))
            {
                  return $sysmodel->Xml_file;
            }
            return  '';
  }
  
        /*
         * Algorythm for this procedure:
         * 1.Gets the number of the page to be displayed, sets $this->page
         * 2.Gets the file name of setting
         * 3.Checks on file existance
         * 
         */
  public function readnomen() {
         $thefile=Yii::app()->params['load_xml_nom'];
         $result=false;
          if(file_exists($thefile)) 
            $result = simplexml_load_file($thefile);
          if(!$result) return '';
          $ii=0;$iii=0;$j=0;$retstr="";
          foreach ($result->item as $key => $value) {
          $found=  Item::model()->findByPk((int)$value->ckey);
          if($found)
          {
              $iii++;            
          }
          else
         {
             $found= new Item;
             $ii++;
             }
            $found->id=(int)$value->ckey;
            $found->name=$value->tfnam;
            $found->sh_name=$value->tnam;
            $found->okei=$value->ckey;
            $found->save();
                       
         }
       $retstr.= "NI:".$ii."<br>OI:".$iii."<br>";
           foreach ($result->acc as $key => $value) {
          $found=  Account::model()->findByPk((int)$value->ckey);
          if($found)
          {
              $iii++;            
          }
          else
         {
             $found= new Account;
             $ii++;
             }
            $found->id=(int)$value->ckey;
            $found->name=$value->tnam;
             $found->save();
                       
         }
         $retstr.= "NA:".$ii."<br>OA:".$iii."<br>";
          $connection=Yii::app()->db; 
          
          $sql='SELECT product_id.ckey AS zkey,product_id.id AS zid, product.tnam AS zname '
               .'FROM  product_id INNER JOIN product ON product.ckey=product_id.id';
           $pgs=$connection->createCommand($sql)->queryAll();
           $pgsk=array('0');
           $pgsn=array(array('0',0));
          $ii=0;$iii=0;
           foreach($pgs as $row) {  $pgsk[]=$row['zkey']; $pgsn[]=array($row['zname'],$row['zid']);}
                    foreach ($result->xnom as $key => $value) {
                     if($key=array_search($value->ckey, $pgsk))
                     {
                             $this->setPG ($pgsn[$key][1],$value,1);
                               $ii++;
                     }
                    else
                    {
                          $this->newPG ($value,1);
                          $iii++;

                    }
                    $j++;
                  } 
                        $retstr.=" PN:".$j."<br> PE:".$ii."<br> PN:".$iii;
                        return $retstr;
  }
  
  public function readsimple() {
//      sets the number of the shown page through the total set outside
          $this->total=0;

//          finds file name of the xml to be parsed and checks if it exists, ges out if can't find it
        $thefile=Yii::app()->params['load_xml_nom'];
         $result=false;
          if(file_exists($thefile)) 
            $result = simplexml_load_file($thefile);
          if(!$result) return '';
          $ii=0;$iii=0;$j=0;
           $connection=Yii::app()->db; 
          $sql='SELECT productgroup_id.ckey AS zkey,productgroup_id.id AS zid, product_group.tnam AS zname '
               .'FROM  productgroup_id INNER JOIN product_group ON product_group.ckey=productgroup_id.id';
           $pgs=$connection->createCommand($sql)->queryAll();
           $pgsk=array('0');
           $pgsn=array(array('0',0));
           foreach($pgs as $row) {  $pgsk[]=$row['zkey']; $pgsn[]=array($row['zname'],$row['zid']);}
                    foreach ($result->xgr as $key => $value) {
                     if($key=array_search($value->ckey, $pgsk))
                     {
                             $this->setPG ($pgsn[$key][1],$value);
                               $ii++;
                     }
                    else
                    {
                          $this->newPG ($value);
                          $iii++;

                    }
                    $j++;
                  } 
              $der=ProductGroup::model()->doSet();
                      return "GD:".$j."<br>GC:".$ii."<br>GN:".$iii."<br>sess:".$der;
          }
          
   private function setPG($id,$val,$prod=0) {
      $found=ProductgroupId::model()->findByPk(array('ckey'=>$val->par,'db'=>1));
       if($found)
       {
        if($prod==0)
            $pg= ProductGroup::model()->findByPk($id);
       else
            $pg= Product::model()->findByPk($id);
          if($pg)
            {
         if($prod!=0)
             $pg->it=(int)$val->it;
             $pg->cgr=$found->id;
             $pg->save();
            }
        }
   }
   private function newPG($val,$prod=0) {
        if($prod==0){
      $pgi= new ProductgroupId;
       $pg= new ProductGroup;
       $found=  ProductgroupId::model()->findByPk(array('ckey'=>$val->par,'db'=>1));
        }
       else{
         $pgi= new ProductId;
         $pg= new Product;
         $found= ProductId::model()->findByPk(array('ckey'=>$val->par,'db'=>1));
        $pg->it=(int)$val->it;
      }
       $pg->tnam=$val->tnam;
       if($found)
       {
            $pg->cgr=$found->id;
       }
       $pg->save();
       $pgi->ckey=$val->ckey;
       $pgi->db=1;
       $pgi->id=$pg->ckey;
       $pgi->save();

   }
}