<?php

class TmpXmlController extends Controller
{
    private $filepath;
    private $ids=array();
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','ajaxExp','ajaxInv','test','xml','cxml','loaddep'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new TmpXml;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TmpXml']))
		{
			$model->attributes=$_POST['TmpXml'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TmpXml']))
		{
			$model->attributes=$_POST['TmpXml'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('TmpXml');
                
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
        public function actionTest()
	{
            $prods=TmpXml::model()->with('productgroupid')->findAll();
            $ii=0;
           if(count($prods)>0){
                    $ii+=count($prods);
                 foreach ($prods as $value) {
                   $value['lid']=$value['productgroupid']['productgroup1']['ckey'];
                   $value['lname']=$value['productgroupid']['productgroup1']['tnam'];
                   $value['state']=10;
                   if($value->save()) $ii++;
           }    }             
		$this->render('test',array(
			'model'=>$ii,
		));
	}
       public function actionLoadDep($id)
	{
           $ii=0;
           $result=false;
           $thefile=Yii::app()->params['load_xml_tdir']."department.xml";
           if(file_exists($thefile)) 
            $result = simplexml_load_file($thefile);
            $db=1;
            if($result)
            {
//                var_dump($result);
//                return;
            foreach ($result as $key => $value) { 
               switch ($key)  {
                    case 'xFir':
                        if($value[0]->dbKey==$id)
                        {
                    foreach ($value[0]->props[0] as $ke => $valu) { 
                    $model=new DepartmentProp;
                        $model->id=$id;
                       $model->_key=(string)$ke;
                       $model->_value=(string)$valu[0];
                    if($model->save()) $ii++;                   
                    }
                        }
                       break;
               }
            }
            }
            $this->renderText("Loaded department:".$id);
	}
	public function actionAjaxExp()
	{
		$val1 = $_POST['val_id'];
 		sscanf($val1,"%s %s %d",$from,$to,$dep);
 		if($from==null)
                {
                    echo "D:".$val1;
                    return;
                }
               $criteria=new CDbCriteria;
             $Datef= date('Y-m-d', strtotime($from));
            $Datet= date('Y-m-d', strtotime($to));
            $criteria->addCondition("t.date  >= '$Datef' and t.date <= '$Datet'");
            $criteria->addCondition("t.department_id=$dep");
 		$dataReader=Exp::model()->with(array('client','department'))->findAll($criteria);
		$ret="<table class='acctable'>";
		$ret.="<tr><th>№</th>"
                        ."<th>Номер</th>"
                        . "<th>Дата</th>"
                       . "<th>Фирма</th>"
                       . "<th>Клиент</th>"
                        . "<th>Сумма</th></tr>";
		$res=0;
		$resp=0;
	foreach($dataReader as $row) 	{ 
	$ret.="<tr><td>".$row['id']."</td>"
                ."<td>".$row['name']."</td>\n"
                ."<td>".Yii::app()->dateFormatter->formatDateTime($row['date'], 'short', null)."</td>\n"
               ."<td>".$row['depname']."</td>\n"
               ."<td>".$row['cliname']."</td>\n"
                ."<td style='text-align:right;'>".CHtml::link(Yii::app()->numberFormatter->formatCurrency($row['amount'], ''),"javascript:void(0);",array('onclick'=>'setexp(this);'))."</td></tr>";
	}
	 $ret.="</table>\n";
		echo $ret;       }
                
                public function actionAjaxInv()
	{
		$val1 = $_POST['val_id'];
 		sscanf($val1,"%s %s %d",$from,$to,$dep);
 		if($from==null)
                {
                    echo "D:".$val1;
                    return;
                }
               $criteria=new CDbCriteria;
             $Datef= date('Y-m-d', strtotime($from));
            $Datet= date('Y-m-d', strtotime($to));
            $criteria->addCondition("t.date  >= '$Datef' and t.date <= '$Datet'");
            $criteria->addCondition("exp.department_id=$dep");
 		$dataReader=Inv::model()->with(array("exp","exp.client","exp.department"))->findAll($criteria);
                echo "RR:".$dataReader->rowCount."<br>";
		$ret="<table class='acctable'>";
		$ret.="<tr><th>№</th>"
                        ."<th>Номер</th>"
                        . "<th>Дата</th>"
                       . "<th>Фирма</th>"
                       . "<th>Клиент</th>"
                        . "<th>Сумма</th>"
                       . "<th>Счет</th>"
                        ."<th style='display:none;'>E#</th></tr>";
 		$res=0;
		$resp=0;
                
	foreach($dataReader as $row) 	{ 
	$ret.="<tr><td>".$row['id']."</td>"
                ."<td>".$row['name']."</td>\n"
                ."<td>".Yii::app()->dateFormatter->formatDateTime($row['date'], 'short', null)."</td>\n"
               ."<td>".$row['depname']."</td>\n"
               ."<td>".$row['cliname']."</td>\n"
                ."<td style='text-align:right;'>".CHtml::link(Yii::app()->numberFormatter->formatCurrency($row['amount'], ''),"javascript:void(0);",array('onclick'=>'setinv(this);'))."</td>"
               ."<td>".$row['expname']." ".Yii::app()->dateFormatter->formatDateTime($row['expdate'], 'short', null)."</td>\n";
             $ret.="<td style='display:none;'>".$row['exp_id']."</td></tr>\n";
  	}
	 $ret.="</table>\n";
		echo $ret;       }

	/**
	 * Manages all models.
	 */
	private function readsimple($thefile)
	{
            $clis=array();
            $firs=array();
            $ords=array();
            $invs=array();
            $inf=array();
            TmpXml::model()->deleteAll('user='.Yii::app()->user->uid);
            TmpDoc::model()->deleteAll('user='.Yii::app()->user->uid);
            TmpDocd::model()->deleteAll('user='.Yii::app()->user->uid);
            $connection=Yii::app()->db;  
//            $connection->createCommand('ALTER TABLE tmp_xml AUTO_INCREMENT = 1;')->execute();          
//            $connection->createCommand('ALTER TABLE tmp_docd AUTO_INCREMENT = 1;')->execute();          
            $ii=0;
            $result=false;
            if(file_exists($thefile)) 
            $result = simplexml_load_file($thefile);
            $db=1;
            foreach ($result as $key => $value) { 
               switch ($key)  {
                    case 'xNom':
                    $model=new TmpXml;
                        $model->ckey=(string)$value[0]->cKey;
                        $model->cname=(string)$value[0]->tNam;
                        $model->cgr=(string)$value[0]->cGr;
                        $model->ctype=0;
                        $model->user=Yii::app()->user->uid;
                     if($model->save()) $ii++;
                   $model=new TmpXml;
                        $model->ckey=(string)$value[0]->cKey;
                       $model->cname=(string)$value[0]->it;
                        $model->ctype=10;
                         $model->user=Yii::app()->user->uid;
                    if($model->save()) $ii++;                   
                     
                        break;
                   case 'xCli':
                    $model=new TmpXml;
                        $model->ckey=(string)$value[0]->cKey;
                        $model->cname=(string)$value[0]->tNam;
                         $model->cgr=(string)$value[0]->cGr;
                       $model->ctype=1;
                         $model->user=Yii::app()->user->uid;
                    if($model->save())
                     {
                       $clis[$model->ckey]=$model->cname;
                       $ii++;
                     }
                    foreach ($value[0]->props[0] as $ke => $valu) { 
                   $model=new TmpXml;
                        $model->ckey=(string)$value[0]->cKey;
                       $model->cname=(string)$ke;
                       $model->lname=(string)$valu[0];
                        $model->ctype=11;
                          $model->user=Yii::app()->user->uid;
                   if($model->save()) $ii++;                   
                        
                    }
                       break;
                  case 'xFir':
                    $model=new TmpXml;
                        $model->ckey=(string)$value[0]->cKey;
                        $model->cname=(string)$value[0]->tNam;
                        $model->ctype=2;
                           $model->user=Yii::app()->user->uid;
                    if($model->save())
                       {
                        $firs[$model->ckey]=$model->cname;
                        $ii++;
                      }
                      break;
                  case 'xGrN':
                    $model=new TmpXml;
                        $model->ckey=(string)$value[0]->cKey;
                        $model->cname=(string)$value[0]->tNam;
                        $model->ctype=3;
                          $model->user=Yii::app()->user->uid;
                   if($model->save()) $ii++;
                        break;
                 case 'xGrC':
                    $model=new TmpXml;
                        $model->ckey=(string)$value[0]->cKey;
                        $model->cname=(string)$value[0]->tNam;
                        $model->ctype=4;
                            $model->user=Yii::app()->user->uid;
                 if($model->save()) $ii++;
                        break;
                case 'xInv':
                    $model=new TmpDoc;
                        $model->id=(int)$value[0]->cKey+(100*Yii::app()->user->uid);
                        $model->tnum=(string)$value[0]->tNum;
                        $model->tonum=(string)$value[0]->tONum;
                        $model->ddat=(string)$value[0]->dDat;
                        $model->dodat=(string)$value[0]->dODat;
                        $model->cfir=(string)$value[0]->cFir;
                        $model->ccli=(string)$value[0]->cCli;
                        $model->bsum=(double)$value[0]->bSum;
                        $model->transport=(string)$value[0]->cClix;
                       $model->ctype=1;
                            $model->user=Yii::app()->user->uid;
                 if($model->save())
                     {
                         $ii++;
                        $invs[$model->id]=array($model->tnum,$model->ddat,$model->tonum,$model->dodat);
                     }
                        break;
               case 'xOrd':
                    $model=new TmpDoc;
                        $model->id=(int)$value[0]->cKey+(100*Yii::app()->user->uid);
                        $model->tnum=(string)$value[0]->tNum;
                        $model->tonum=(string)$value[0]->Acc;
                         $model->ddat=(string)$value[0]->dDat;
                        $model->cfir=(string)$value[0]->cFir;
                        $model->ccli=(string)$value[0]->cCli;
                       $model->bsum=(double)$value[0]->bSum;
                       $model->transport=(string)$value[0]->Tran;
                       $model->man=(int)$value[0]->Man;
                        $model->ctype=0;
                             $model->user=Yii::app()->user->uid;
                if($model->save())  
                      {
                        $ii++;
                        $ords[$model->id]=array($model->tnum,$model->ddat);
                     }
                  break;
                case 'xInvT':
                    $model=new TmpDocd;
                        $model->ckey=(int)$value[0]->cDoc+(100*Yii::app()->user->uid);
                        $model->cnom=(string)$value[0]->cNom;
                        $model->bqua=(string)$value[0]->bQua;
                        $model->bvat=(string)$value[0]->bVat;
                        $model->bpri=(string)$value[0]->bPri;
                        $model->bsum=(double)$value[0]->bSum;
                        $model->state=1;
                         $model->user=Yii::app()->user->uid;
                if($model->save())
                     {
                         $ii++;
                     }
                        break;
               case 'xOrdT':
                    $model=new TmpDocd;
                        $model->ckey=(int)$value[0]->cDoc+(100*Yii::app()->user->uid);
                         $model->cnom=(string)$value[0]->cNom;
                        $model->bqua=(string)$value[0]->bQua;
                        $model->bvat=(string)$value[0]->bVat;
                        $model->bpri=(string)$value[0]->bPri;
                         $model->bsum=(double)$value[0]->bSum;
                        $model->state=0;
                                $model->user=Yii::app()->user->uid;
             if($model->save())  
                      {
                        $ii++;
                     }
                  break;
             }  
            }
            $ii=0;

           $prods=TmpXml::model()->with('productid')->findAll('user='.Yii::app()->user->uid);
           if(count($prods)>0){
                $ii=count($prods);
               foreach ($prods as $value) {
                   $value['lid']=$value['productid']['product1']['ckey'];
                   $value['lname']=$value['productid']['product1']['tnam'];
                   $value['state']=10;
                   $value->save();
             }   
              }
              $inf[]="Товары:$ii";
           $prods=TmpXml::model()->with('clientid')->findAll('user='.Yii::app()->user->uid);
           if(count($prods)>0){
                  $ii=count($prods);
                 foreach ($prods as $value) {
                   $value['lid']=$value['clientid']['client1']['id'];
                   $value['lname']=$value['clientid']['client1']['name'];
                   $value['state']=10;
                   $value->save();
             }   
            }
              $inf[]="Клиенты:$ii";
          $prods=TmpXml::model()->with('departmentid')->findAll('user='.Yii::app()->user->uid);
           if(count($prods)>0){
                    $ii=count($prods);
                 foreach ($prods as $value) {
                   $value['lid']=$value['departmentid']['department1']['id'];
                   $value['lname']=$value['departmentid']['department1']['name'];
                   $value['state']=10;
                   $value->save();
             }   
             }         
             $inf[]="Фирмы:$ii";
         $prods=TmpXml::model()->with('productgroupid')->findAll('user='.Yii::app()->user->uid);
           if(count($prods)>0){
                    $ii+=count($prods);
                 foreach ($prods as $value) {
                   $value['lid']=$value['productgroupid']['productgroup1']['ckey'];
                   $value['lname']=$value['productgroupid']['productgroup1']['tnam'];
                   $value['state']=10;
                   $value->save();
  
          }          }
        $prods=TmpXml::model()->with('countryid')->findAll('user='.Yii::app()->user->uid);
           if(count($prods)>0){
                    $ii+=count($prods);
                 foreach ($prods as $value) {
                   $value['lid']=$value['countryid']['country1']['id'];
                   $value['lname']=$value['countryid']['country1']['name'];
                   $value['state']=10;
                   $value->save();
  
          }          }
            foreach ($ords as $key => $value) 
            {
            $criteria=new CDbCriteria;
            $Datet = $value[1];
            $Datef= date('Y-m-d', strtotime($Datet. ' - 3 days'));
            $Datet= date('Y-m-d', strtotime($Datet. ' + 3 days'));
            $criteria->addCondition("date  >= '$Datef' and t.date <= '$Datet'");
             $exp=Exp::model()->with(array('client','department'))->findByAttributes(array('name'=>$value[0]),$criteria);  
              $prod=TmpDoc::model()->findByPk($key); 
              $prod->cliname=$clis[$prod->ccli];
              $prod->firname=$firs[$prod->cfir];
               if(!($exp===null))
             {
                  $prod->expid=$exp->id;
                  $prod->expinfo=$exp->name." - ".Yii::app()->dateFormatter->formatDateTime($exp->date, 'short', null)
                          ." - ".$exp->depname." - ".$exp->cliname
                          ." - ".Yii::app()->numberFormatter->formatCurrency($exp->amount, '') ;
              }
              $prod->save();
            } 
            foreach ($invs as $key => $value) 
            {
              $criteria=new CDbCriteria;
            $Datet = $value[1];
            $Datef= date('Y-m-d', strtotime($Datet. ' - 3 days'));
            $Datet= date('Y-m-d', strtotime($Datet. ' + 3 days'));
            $criteria->addCondition("t.date  >= '$Datef' and t.date <= '$Datet'");
             $inv=Inv::model()->with(array('exp','exp.client','exp.department'))->findByAttributes(array('name'=>$value[0]),$criteria);  
             $prod=TmpDoc::model()->findByPk($key); 
              $prod->cliname=$clis[$prod->ccli];
              $prod->firname=$firs[$prod->cfir];
              if($inv===null)
             {
                $criteria=new CDbCriteria;
                 $Datet = $value[3];
                 $Datef= date('Y-m-d', strtotime($Datet. ' - 3 days'));
                 $Datet= date('Y-m-d', strtotime($Datet. ' + 3 days'));
                 $criteria->addCondition("date  >= '$Datef' and t.date <= '$Datet'");
                  $exp=Exp::model()->with(array('client','department'))->findByAttributes(array('name'=>$value[2]),$criteria);  
                if(!($exp===null))
                 {
                     $prod->expid=$exp->id;
                     $prod->expinfo=$exp->name." - ".Yii::app()->dateFormatter->formatDateTime($exp->date, 'short', null)
                             ." - ".$exp->depname." - ".$exp->cliname
                             ." - ".Yii::app()->numberFormatter->formatCurrency($exp->amount, '') ;
                 }
                 
             }
                 else
              {
                  $prod->docid=$inv->id;
                  $prod->docinfo=$inv->name." - ".Yii::app()->dateFormatter->formatDateTime($inv->date, 'short', null)
                           ." - ".Yii::app()->numberFormatter->formatCurrency($inv->amount, '') ;
                  $prod->expid=$inv->exp_id;
                  $prod->expinfo=$inv->exp->name." - ".Yii::app()->dateFormatter->formatDateTime($inv->exp->date, 'short', null)
                          ." - ".$inv->depname." - ".$inv->cliname
                          ." - ".Yii::app()->numberFormatter->formatCurrency($inv->exp->amount, '') ;
               
              }
             $prod->save();
            }
                
          return $ii;
          
        }

        /* 
       * добавляем строки счета
       */      	private function updatedocstr($iid,$rid,$ty)
        {

                               $sql="SELECT a.* , p.id AS p_id "
                                    . " FROM tmp_docd a LEFT JOIN  product_id p ON a.cnom=p.ckey AND p.db=1"
                                    . " WHERE a.user=".Yii::app()->user->uid." AND a.ckey=".$iid; //.$value['id']; 
                                   $dets=Yii::app()->db->createCommand($sql)->query();
                                if(count($dets)>0){
                                        $id=0;
                                          foreach ($dets as $value) {
                                            if(!($value['p_id']==null))
                                             {
                                                if($ty==0){
                                                    $expd=new Expd();
                                                    $expd->exp=$rid;//$group->id;
                                                }
                                                else{
                                                    $expd=new Invd();
                                                   $expd->inv=$rid;
                                               }
                                                   $expd->id=++$id;
                                                   $expd->product=$value['p_id'];
                                                  $expd->amount=$value['bqua'];
                                                  $expd->price=$value['bpri'];
                                                  $expd->vat=$value['bvat'];
                                                  $expd->total=$value['bsum'];
                                                 $expd->save();
                                             }
                                        }
                                       }

        }
  	private function updatedocs($docs,&$info)
  {
      /* 
       * отбор загруженных на этапе считывания документов из tmp_doc
       */      
            $sql="SELECT a.* ,"
                     . " c.id AS c_id, d.id AS d_id, t.id AS t_id, m.id AS m_id, u.id AS u_id "
                     . " FROM (((((tmp_doc a LEFT JOIN  client_id c ON a.ccli=c.ckey AND c.db=1)"
                     . " LEFT JOIN  department_id d ON a.cfir=d.ckey AND c.db=1)"
                     . " LEFT JOIN  client_id t ON a.transport=t.ckey AND c.db=1)"
                     . " LEFT JOIN  currency u ON a.tonum=u.longname)"
                     . " LEFT JOIN  account m ON a.man=m.id)"
                     . " WHERE a.user=".Yii::app()->user->uid; 
       $recs=Yii::app()->db->createCommand($sql)->query();
        $resdoc=array();
      
                     $j=0;$i=0;$jj=0;$ii=0;
       /* 
       * обход строк из tmp_doc
       */      
     if(count($recs)>0){
                 foreach ($recs as $value) {
                     if($value['ctype']==0){    // <если это счет
     /* 
       * если у счета найден клиент и фирма (на этом этапе все новые клиенты и фирмы должны быть загружены)
      * без проидентифицированной фирмы и клмента запись будет проигнорирована
       */      
                         if(!(($value['c_id']==null)&&($value['d_id']==null)))  
                         {
                             $id=(int)$value['expid'];  //счет найден - имеется уже в базе данных - редакция
                             $fid=$docs[$value['id']];
                             if($fid==null)
                                        $id=0;
                           else
                             {
                                 if($fid>0) $id=$fid;   //счет был подобран пользователем на этапе идентификации
                                 else $id=0;
                             }
      /* 
       * получение AR модели Exp:
       * найденной если $id>0
       * новой в обратном случае
       */      
                           if($id>0)  
                             {
                                 $group=Exp::model()->findByPk($id);
                                 if($group==null) continue; 
                                 Expd::model()->deleteAll('exp='.$id);
                             }
                             else  $group=new Exp();
                               $group->name=$value['tnum'];
                               $group->client_id=$value['c_id'];
                               $group->department_id=$value['d_id'];
                               $group->transport=$value['t_id'];
                               $group->account_id=$value['m_id'];
                               $group->amount=$value['bsum'];
                               $group->date=$value['ddat'];
                               $group->currency_id=$value['u_id'];
                               if($group->save())
                               {
                                   if($id>0)  {
                                       $jj++;
                                       $resdoc[]=array('t'=>0,'s'=>0,'n'=>$group->id);
                                   }
                                   else {
                                          $resdoc[]=array('t'=>0,'s'=>1,'n'=>$group->id);
                                    $j++;
                                   }
                                   $this->updatedocstr($value['id'], $group->id, 0);

                          }
                       }
                         
                     }
                     else // <если это накладная
                     {
                      $oid=(int)$value['expid'];
                       $iid=(int)$value['docid'];
                       $fid=$docs[$value['id']];
                        if($fid===null)
                        {
                         $oid=0;
                         $iid=0;                          
                        }
                        else
                        {
                          $iid=$fid[1];
                          $oid=$fid[0];
                        }
     
                       $group=NULL;
                        if($iid>0)
                        {
                              $group=Inv::model()->findByPk($iid);
                              if($group==null) continue;
                            Invd::model()->deleteAll('inv='.$iid);
                        }
                         if($group===null)
                        {
                         if($oid>0)
                             $group=new Inv(); 
                         else
                             continue;
                      }
                       $group->name=$value['tnum'];
                       $group->amount=$value['bsum'];
                       $group->date=$value['ddat'];
                       $group->client_id=$value['t_id'];
                       $group->exp_id=$oid;
                               if($group->save())
                               {
                                    if($iid>0)  {
                                       $ii++;
                                       $resdoc[]=array('t'=>1,'s'=>0,'n'=>$group->id);
                                   }
                                   else {
                                          $resdoc[]=array('t'=>1,'s'=>1,'n'=>$group->id);
                                    $i++;
                                   }
                                   $this->updatedocstr($value['id'], $group->id, 1);

                          }  
                   }
           
        }
       }
                            $info[]='Создано новых счетов:'.$j;
                            $info[]='Создано новых накладных:'.$i;
                            $info[]='Отредактикровано счетов:'.$jj;
                            $info[]='Отредактикровано накладных:'.$ii;
                            $info['doc']=$resdoc;
       }
       
  	private function updatesimple($typic,$grtype,$result,&$info)
        {
            if($typic==2)
            {
            $sql="SELECT a.id AS p_id, a.ckey AS p_key, a.cname AS p_name , a.lid AS p_lid "
                     . " FROM tmp_xml a WHERE a.user=".Yii::app()->user->uid." AND a.ctype=".$typic;
            }
            else
            {
            $sql="SELECT a.id AS p_id, a.ckey AS p_key, a.cname AS p_name , a.lid AS p_lid,"
                     . " b.id AS g_id, b.ckey AS  g_key, b.cname AS g_name, b.lid as g_lid "
                     . " FROM tmp_xml a LEFT JOIN  tmp_xml b ON a.cgr=b.ckey AND b.user=".Yii::app()->user->uid." AND b.ctype=".$grtype
                     ." WHERE a.user=".Yii::app()->user->uid." AND a.ctype=".$typic;
            }
         $recs=Yii::app()->db->createCommand($sql)->query();
      
                     $i=0;$j=0;$jj=0;
         if(count($recs)>0){
                 foreach ($recs as $value) {
                 $doprod=0;
                 $doprodid=0;
                 $edid=0;
                   if($value['p_lid']===null)
                   {
                      if($result[$value['p_id']]===null)
                      {
                          $doprod=-1;
                          $doprodid=1;
                      }
                        else
                         {
                            $edid=(int)$result[$value['p_id']];
                            if($edid>0)
                            {
                                 $doprodid=2;  
                                 $doprod=$edid;
                                
                            }
                            else
                            {
                                $doprod=-1;
                               $doprodid=1;
                            }
                       }
                      }
                      else
                      {
                      if($result[$value['p_id']]===null)
                      {
                          $doprod=$value['p_lid'];

                      }
                          else
                         {
                            $edid=$result[$value['p_id']];
                            if($edid>0)
                            {
                                 $doprodid=3;                           
                                 $doprod=$edid;
                           }
                            else
                            {
                               $doprod=-1;
                               $doprodid=4;
                            }
                       }
                      }
                      $grid=0;
                      if($doprod<0)
                      {
              if($typic!=2)
              {
                       if($value['g_lid']===null) 
                         {
                           if($typic==0)
                             $prodid=ProductgroupId::model()->findByPk(array('ckey'=>$value['g_key'],'db'=>1)); 
                           else
                             $prodid=CountryId::model()->findByPk(array('ckey'=>$value['g_key'],'db'=>1)); 
                            if($prodid ===null)
                            {
                                if($typic==0)
                                {
                                    $group=new ProductGroup();
                                    $group->tnam=$value['g_name'];
                               $group->save();
                                     $grid=$group->ckey;
                                     $groupid=new ProductgroupId();
                                }
                                else
                                {
                                     $group=new Country();
                                     $group->name=$value['g_name'];
                                  $group->save();
                                 $grid=$group->id;
                                     $groupid=new CountryId();
                                 }
                               $groupid->ckey=$value['g_key'];
                                $groupid->db=1;
                                $groupid->id=$grid;
                                $groupid->save();
                                 $i++;
                            }
                            else
                                $grid=$prodid->id;
     
                        }
                        else
                           $grid=$value['g_lid']; 
              }
              else {
                   $grid=1;
              }
                         if($grid>0)
                         {
                               if($typic==0)
                                {
                                   $prod=new Product();
                                   $prod->tnam=$value['p_name'];
                                   $prod->cgr=$grid;
                                    $it=TmpXml::model()->find('ctype=:ctype AND ckey=:ckey AND user=:user',array(':ctype'=>10,':ckey'=>$value['p_key'],':user'=>Yii::app()->user->uid));
                                    if($it) $prod->it=(int)$it->cname;
                                    $prod->save();
                                $grid=$prod->ckey;
                             }
                                else if($typic==1)
                                {
                                    $prod=new Client();
                                   $prod->name=$value['p_name'];
                                   $prod->country_id=$grid;
                                $prod->save();
                                  $grid=$prod->id;
                  $it=TmpXml::model()->findAll("ctype=:ctype AND ckey=:ckey AND user=:user",array(':ctype'=>11,':ckey'=>$value['p_key'],':user'=>Yii::app()->user->uid));
                                     if(!($it===null))
                                    {
                                        foreach ($it as $valu) {
                                            $prop=new ClientProp();
                                            $prop->id=$grid;
                                            $prop->_key=$valu->cname;
                                            $prop->_value=$valu->lname;
                                         $prop->save();
                                        }
                                    }
                                }
                                else 
                                {
                                    $prod=new Department();
                                   $prod->name=$value['p_name'];
                                 $prod->save();
                                  $grid=$prod->id;
                                }
                               $j++;
                          if($doprodid==1)
                          {
                                 if($typic==0)
                                  $prodid=new ProductId();
                                 else if($typic==1)
                                 $prodid=new ClientId();
                                else 
                                 $prodid=new DepartmentId();

                            $prodid->ckey=$value['p_key'];
                            $prodid->db=1;
                            $prodid->id=$grid;
                            $prodid->save();
                          }
                          else
                          {
                           if($typic==0)
                              $prodid=ProductId::model()->findByPk(array('ckey'=>$value['p_key'],'db'=>1));
                           else if($typic==1)
                                $prodid=ClientId::model()->findByPk(array('ckey'=>$value['p_key'],'db'=>1));
                          else
                             $prodid=DepartmentId::model()->findByPk(array('ckey'=>$value['p_key'],'db'=>1));
                              if(!($prodid===null))
                                {
                                    $prodid->id=$grid;
                                    $prodid->save();
                                }
                           }
                         }
                    }
                    if($doprodid==2)
                    {
                         if($typic==0)
                            $prodid=new ProductId();
                                    else if($typic==1)
                            $prodid=new ClientId();
                        else
                             $prodid=new DepartmentId();
                            $prodid->ckey=$value['p_key'];
                            $prodid->db=1;
                            $prodid->id=$edid;
                            $prodid->save();
                    }
                    else if($doprodid==3)
                    {
                            if($typic==0)
                              $prodid=ProductId::model()->findByPk(array('ckey'=>$value['p_key'],'db'=>1));
                            else if($typic==1)
                            $prodid=ClientId::model()->findByPk(array('ckey'=>$value['p_key'],'db'=>1));
                           else
                             $prodid=DepartmentId::model()->findByPk(array('ckey'=>$value['p_key'],'db'=>1));
                            if(!($prodid===null))
                             {
                                 $prodid->id=$edid;
                                 $prodid->save();
                             }
                    }
                    if($doprod>0)
                    {
                             if($typic==0)
                             {
                                  $prod=Product::model()->findByPk($doprod);
                                if(!($prod===null))
                               {
                                   if($prod->tnam!=$value['p_name'])
                                   {
                                       $prod->tnam=$value['p_name'];
                                       $prod->save();
                                       $jj=0;
                                  }
                               }                             
                             }
                                 else if($typic==1)
                           {
                                $prod=Client::model()->findByPk($doprod);
                                if(!($prod===null))
                               {
                                   if($prod->name!=$value['p_name'])
                                   {
                                       $prod->name=$value['p_name'];
                                       $prod->save();
                                       $jj=0;
                                  }
                     $it=TmpXml::model()->findAll("ctype=:ctype AND ckey=:ckey AND user=:user",array(':ctype'=>11,':ckey'=>$value['p_key'],':user'=>Yii::app()->user->uid));
                                if($it)
                                    {
                                        foreach ($it as $valu) {
                                            if(!($prop= ClientProp::model()->findByPk(array('id'=>$prod->id,'_key'=>$valu->cname))))
                                                    $prop=new ClientProp();
                                            $prop->id=$prod->id;
                                            $prop->_key=$valu->cname;
                                            $prop->_value=$valu->lname;
                                            $prop->save();
                                        }
                                    }

                               }                             
                           
                           }
                              else
                           {
                             if(!($prop= DepartmentProp::model()->findByPk(array('id'=>$doprod,'_key'=>'stop'))))
                       //если имеется параметр stop, то значения параметров контрагента не обновляются
                             {
                                $prod=Department::model()->findByPk($doprod);
                                if(!($prod===null))
                               {
                                   if($prod->name!=$value['p_name'])
                                   {
                                       $prod->name=$value['p_name'];
                                       $prod->save();
                                       $jj=0;
                                  }
                               } 
                             }
                           }
                    }
               }

                }
                                if($typic==0)
                                {
                                    $info[]='Создано новых групп товаров:'.$i;
                                   $info[]='Создано новых товаров:'.$j;
                                   $info[]='Обновлено товаров:'.$jj;
                              }
                                  else if($typic==1)
                                {
                                    $info[]='Создано новых групп клиентов:'.$i;
                                    $info[]='Создано новых клиентов:'.$j;
                                    $info[]='Обновлено клиентов:'.$jj;
                                }
                              else
                                {
                                     $info[]='Создано новых фирм:'.$j;
                                    $info[]='Обновлено фирм:'.$jj;
                                }
             return ;           
        }
  	private function writesimple($model)
        {
            $result=array();
            $docs=array();
             $info=array();
            $resu = explode(".",$model['product']);
             foreach ($resu as $value) {
                 $res = explode("=",$value);
                 if(strlen($res[0])>0)
                         $result[(int)$res[0]]=(int)$res[1];
             }
           $resu = explode(".",$model['doc']);
             foreach ($resu as $value) {
                 $res = explode("=",$value);
                 if(strlen($res[0])>0)
                 {
                    if(count($res)>2)
                       $docs[(int)$res[0]]=array((int)$res[1],(int)$res[2]); 
                    else
                      $docs[(int)$res[0]]=(int)$res[1]; 
 
                 }
             }
             $this->updatesimple(0,3,$result,$info);
             $this->updatesimple(1,4,$result,$info);
             $this->updatesimple(2,4,$result,$info);
             $ii=$this->updatedocs($docs,$info);
             return $info;
//             return $docs;
        }
         public function actionCXML()
	{
		if(isset($_POST['TmpXml']))
                {
                     $model=$_POST['TmpXml'];
                     $res=$this->writesimple($model);
                     $doci=$res['doc'][0];
                     if(!is_null($doci))
                     {

                        $this->redirect(array(($doci['t']==0 ? "exp" : "inv")."/print",'id'=>(int)$doci['n']));
                        return;
                     }
                     else
                     {
                         $this->render('result',array(
                            'model'=>$res,
                     ));
                     
                     }
                }
                else
                {
                    $id=Yii::app()->user->uid;
                    $fileid=Yii::app()->params['load_xml_id'];
                    $pathfrom=Yii::app()->params['load_xml_fdir'].$fileid."_".$id.".xml";
                    $pathto=Yii::app()->params['load_xml_tdir'].$fileid."_".$id.".xml";
                     if (!copy($pathfrom, $pathto))
                     {
                       $res=array("не удалось скопировать $pathfrom");
                               $this->render('result',array(
                                     'model'=>$res,
                             ));
                               return;
                     }
                     else
                     {
                                  $ii=$this->readsimple($pathto);
                                 $model=new TmpXml('search');
                                 $doc=new TmpDoc('search');
                                 $this->render('admin',array(
                                         'model'=>$model,'doc'=>$doc,'rr'=>$ii
                                 ));
                       }
                }
         
         }
         public function actionXML()
	{
		if(isset($_POST['TmpXml']))
                {
                     $model=$_POST['TmpXml'];
                     $res=$this->writesimple($model);
                      $this->render('result',array(
                            'model'=>$res,
                    ));
                }
                else
                {
                        $thefile=Yii::app()->params['load_xml'];
                         $ii=$this->readsimple($thefile);
                        $model=new TmpXml('search');
                        $doc=new TmpDoc('search');
                        $this->render('admin',array(
                                'model'=>$model,'doc'=>$doc,'rr'=>$ii
                        ));
                     }
                }
    
        public function actionAdmin()
	{
 		$modelff=new FileForm;
		if(isset($_POST['TmpXml']))
                {
                     $model=$_POST['TmpXml'];
                     $res=$this->writesimple($model);
                      $this->render('result',array(
                            'model'=>$res,
                    ));
                }
                else
                {
                    if(isset($_POST['FileForm']))
                    {
                        $modelff->attributes=$_POST['FileForm'];
                        $modelff->image = CUploadedFile::getInstance($modelff, 'image');
                        if (is_object($modelff->image)) {          
 //                             $path=Yii::app()->params['load_xml'];
                               $path='docs/go.xml';
                               $modelff->image->saveAs($path);
                        }  
                      $thefile=Yii::app()->params['load_xml'];
                          
                        $ii=$this->readsimple($thefile);
                        $model=new TmpXml('search');
                        $doc=new TmpDoc('search');
                        $this->render('admin',array(
                                'model'=>$model,'doc'=>$doc,'rr'=>$ii
                        ));
                     }
                   else
                   {
                         $this->render('fform',array(
                                'ff'=>$modelff,
                        ));
                    
                   }
                  
                }
  	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TmpXml the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TmpXml::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TmpXml $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tmp-xml-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
