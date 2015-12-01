<?php

class ExpController extends Controller
{
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
//			'postOnly + delete', // we only allow deletion via POST request
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
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','ajaxReq','ajaxInv','ajaxExp','ajaxExpd','report','test','reqTest01Loading','print','pdf','admin','arc','delete','checkmail','mail'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionCheckMail($id)
	{
            try
            {
                $model=$this->loadModel($id);
                $address="emisdb@yahoo.com";
              $dep=array();
             $cli=array();
             foreach($model->department->departmentProps as $key=>$value)
                 $dep[$value['_key']]=$value['_value'];
            foreach($model->client->clientProps as $key=>$value)
                 {
                  $cli[$value['_key']]=$value['_value'];
//                   if($value['_key']=="email"){ $address=$value['_value']; }
                 }
//                  if(strlen($address)==0)
//                 {
//                    $this->renderText('У заказчика нет email адреса');  
//                    return;
//                 }
//	        $html2pdf = Yii::app()->ePdf->HTML2PDF('P','A4','en', true, 'UTF-8', array(1, 1, 1, 1));
//                $html2pdf->WriteHTML($this->renderPartial('prn_pdf',array(
//		'dep'=>$dep,'cli'=>$cli,'model'=>$model,
//		), true));
                $filename="exp_".Yii::app()->user->uid."_".$model->department_id."_".$model->name."_".$model->client_id.".pdf";
//                $html2pdf->Output(Yii::app()->params['load_xml_pdf'].$filename,'F');
                Yii::import('ext.yii-mail.YiiMailMessage');
                $message = new YiiMailMessage;
                $message->setBody("<h2>Добрый день</h2>Просим проверить счет. <br>"
                        . " Если согласны, то просим прислать платежное поручение.<br>"
                        . "<i>C уважением, Отдел продаж.</i>", 'text/html');
                $message->subject = "Счет №".$model->name." от ".$model->department->name." для ".$model->client->name;
                $message->addTo($address);
//                $message->addTo(Yii::app()->params['adminEmail']);
                $message->from = Yii::app()->params['adminEmail'];
//                $pathto=Yii::app()->params['load_xml_pdf'].$filename;
//                $swiftAttachment = Swift_Attachment::fromPath($pathto); 
//               $message->attach($swiftAttachment);
               $res=Yii::app()->mail->send($message);
               if($res)
                 $this->renderText('Отправлена почта. Файл:'.$filename); 
               else
                  $this->renderText('Не отправлена почта'); 
            } catch (Exception $ex) {
                $this->renderText('Не отправлена почта:'.$ex); 
 
            }
            
        }
	public function actionMail($id)
	{
            try
            {
                $model=$this->loadModel($id);
                $address="";
              $dep=array();
             $cli=array();
             foreach($model->department->departmentProps as $key=>$value)
                 $dep[$value['_key']]=$value['_value'];
            foreach($model->client->clientProps as $key=>$value)
                 {
                  $cli[$value['_key']]=$value['_value'];
                   if($value['_key']=="email"){ $address=$value['_value']; }
                 }
                  if(strlen($address)==0)
                 {
                    $this->renderText('У заказчика нет email адреса');  
                    return;
                 }
	        $html2pdf = Yii::app()->ePdf->HTML2PDF('P','A4','en', true, 'UTF-8', array(1, 1, 1, 1));
                $html2pdf->WriteHTML($this->renderPartial('prn_pdf',array(
		'dep'=>$dep,'cli'=>$cli,'model'=>$model,
		), true));
                $filename="exp_".Yii::app()->user->uid."_".$model->department_id."_".$model->name."_".$model->client_id.".pdf";
                $html2pdf->Output(Yii::app()->params['load_xml_pdf'].$filename,'F');
                Yii::import('ext.yii-mail.YiiMailMessage');
                $message = new YiiMailMessage;
                $message->setBody("<h2>Добрый день</h2>Просим проверить счет. <br>"
                        . " Если согласны, то просим прислать платежное поручение.<br>"
                        . "<i>C уважением, Отдел продаж.</i>", 'text/html');
                $message->subject = "Счет №".$model->name." от ".$model->department->name." для ".$model->client->name;
                $message->addTo($address);
                $message->addTo(Yii::app()->params['adminEmail']);
                $message->from = Yii::app()->params['adminEmail'];
                $pathto=Yii::app()->params['load_xml_pdf'].$filename;
                $swiftAttachment = Swift_Attachment::fromPath($pathto); 
               $message->attach($swiftAttachment);
               $res=Yii::app()->mail->send($message);
               if($res)
                 $this->renderText('Отправлена почта. Файл:'.$filename); 
               else
                  $this->renderText('Не отправлена почта'); 
            } catch (Exception $ex) {
                $this->renderText('Не отправлена почта:'.$ex); 
 
            }
            
        }
	public function actionPdf($id)
	{
//             $this->layout='//layouts/print';
             $this->layout='//layouts/print_e';
              $model=$this->loadModel($id);
             $dep=array();
             $cli=array();
             foreach($model->department->departmentProps as $key=>$value)
                 $dep[$value['_key']]=$value['_value'];
            foreach($model->client->clientProps as $key=>$value)
                 $cli[$value['_key']]=$value['_value'];
            
// 		$this->render('prn_pdf',array(
//		'dep'=>$dep,'cli'=>$cli,'model'=>$model,
//		));
//                return;
           try
            {
                $html2pdf = Yii::app()->ePdf->HTML2PDF('P','A4','en', true, 'UTF-8', array(1, 1, 1, 1));
                $html2pdf->WriteHTML($this->renderPartial('prn_pdf',array(
		'dep'=>$dep,'cli'=>$cli,'model'=>$model,
		), true));
                 $html2pdf->Output();

//                $html2pdf->Output(Yii::app()->params['load_xml_fdir'].'utf_file.pdf','F');
//                echo "Получился PDF";
            }
            catch(HTML2PDF_exception $e) {
                     throw new CHttpException(403,'No pdf output:'.$e);
                exit;
            }
         
        }
	public function actionPrint($id)
	{
             $this->layout='//layouts/print';
             $model=$this->loadModel($id);
             $dep=array();
             $cli=array();
             foreach($model->department->departmentProps as $key=>$value)
                 $dep[$value['_key']]=$value['_value'];
            foreach($model->client->clientProps as $key=>$value)
                 $cli[$value['_key']]=$value['_value'];
		$this->render('prn_torg',array(
		'dep'=>$dep,'cli'=>$cli,'model'=>$model,
		));
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
	public function actionTest($id=false)
	{
                $xml=new XmlForm;
                $rr=$xml->readsimple($id);
                if($id)
                {
                    $this->render('test_2',array('model'=>array(),'rr'=>$rr));
                    return;   
                 }
               $connection=Yii::app()->db; 
               $sql='SELECT productgroup_id.ckey AS zkey,'
                       . 'product_group.ckey AS zid, '
                       . 'product_group.tnam AS zname, '
                       . 'product_group.cgr AS zgr '
               . 'FROM product_group  LEFT JOIN  productgroup_id ON product_group.ckey=productgroup_id.id';
                $res=$connection->createCommand($sql)->queryAll();
               $this->render('test_2',array('model'=>$res,'rr'=>$rr));
 	}
        public function actionReqTest01Loading() {
               sleep(4);   // Sleep for 4 seconds just to demonstrate the Loading Image can be seen, for learning purpose only      
               echo date('H:i:s');
            Yii::app()->end();
        }	
        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Exp;
		$modelff=new FileForm;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Exp']))
		{
			$model->attributes=$_POST['Exp'];
			$modelff->attributes=$_POST['FileForm'];
			$modelff->image = CUploadedFile::getInstance($modelff, 'image');
  			if($model->save())
				{
				if (is_object($modelff->image)) {          
					$path='docs/'.$modelff->image;
					$modelff->image->saveAs($path);
				}  
				$this->redirect(array('admin'));
			}		
		}

		$this->render('create',array(
			'model'=>$model,'ff'=>$modelff,
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
		$modelff=new FileForm;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Exp']))
		{
			$model->attributes=$_POST['Exp'];
        		$modelff->attributes=$_POST['FileForm'];
                    	$modelff->image = CUploadedFile::getInstance($modelff, 'image');
			if($model->save())
			{
				if (is_object($modelff->image)) {          
					$path='docs/'.$modelff->image;
					$modelff->image->saveAs($path);
			}  
				$this->redirect(array('admin'));
			}
		}
		$this->render('update',array(
			'model'=>$model,'ff'=>$modelff,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionArc($id)
	{
		$model=$this->loadModel($id);
                if($model->pub==0)  $model->setAttribute('pub',1);
                else        $model->setAttribute('pub',0);
                $model->save();
 
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		$this->redirect(array('admin','ret'=>1,'#'=>'e_'.($id-1)));
	}
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
		$dataProvider=new CActiveDataProvider('Exp');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($ret=0)
	{
	// first unset cookie for dates
//		unset(Yii::app()->request->cookies['from_date']);  
//		unset(Yii::app()->request->cookies['to_date']);
		$model=new Exp('search');
		$model->unsetAttributes();  // clear any default values
		 if(empty($_POST))
		 {
			$model->from_date = Constants::model()->getCvalue('expf_'.Yii::app()->user->uid);
			$model->to_date = Constants::model()->getCvalue('expt_'.Yii::app()->user->uid);
			$model->state_pay = Constants::model()->getCvalue('expa_'.Yii::app()->user->uid);
                        if($ret==1)
                            $model->cliname = Constants::model()->getCvalue('expc_'.Yii::app()->user->uid);
		 }
		 else
		  {
//			Yii::app()->request->cookies['from_date'] = new CHttpCookie('from_date', $_POST['from_date']);  
			// define cookie for from_date
//			Yii::app()->request->cookies['to_date'] = new CHttpCookie('to_date', $_POST['to_date']);
			Constants::model()->setCvalue('expf_'.Yii::app()->user->uid,$_POST['Exp']['from_date']);
			Constants::model()->setCvalue('expt_'.Yii::app()->user->uid,$_POST['Exp']['to_date']);
			Constants::model()->setCvalue('expa_'.Yii::app()->user->uid,$_POST['Exp']['exp_all']);
			$model->from_date = $_POST['Exp']['from_date'];
			$model->to_date = $_POST['Exp']['to_date'];
			$model->state_pay = $_POST['Exp']['exp_all'];
			if(isset($_POST['checks']))
			{
				$this->savechecks($_POST['checks']);
			}
		}

		if(isset($_GET['Exp']))
			$model->attributes=$_GET['Exp'];
                if(isset($model->cliname))
                {
                    if(is_null($model->cliname))
                    {
                      Constants::model()->delCvalue('expc_'.Yii::app()->user->uid); 
                       
                    }
                    else
                   Constants::model()->setCvalue('expc_'.Yii::app()->user->uid,$model->cliname);
                }
                 else 
                 {
                   Constants::model()->delCvalue('expc_'.Yii::app()->user->uid);  
                 }
//                 if($this->permit>1)
                    $this->render('admin',array(
                            'model'=>$model,
                    ));
//                 else
//                    $this->render('admin_0',array(
//                            'model'=>$model,
//                    ));
	}

	public function actionReport()
	{
//		$model=Exp::model()->with(array('city','concert','expence'))->findByPk($id);
		$model=new Exp('search');
		$show=false;
		$model->unsetAttributes();  // clear any default values
		$model->arr_cur = Currency::model()->findAll();	
		 if(empty($_POST))
		 {
			$model->from_date = Constants::model()->getCvalue('repf_'.Yii::app()->user->uid);
			$model->to_date = Constants::model()->getCvalue('rept_'.Yii::app()->user->uid);
		 }
		 else
		  {
			$show=true;
			Constants::model()->setCvalue('repf_'.Yii::app()->user->uid,$_POST['Exp']['from_date']);
			Constants::model()->setCvalue('rept_'.Yii::app()->user->uid,$_POST['Exp']['to_date']);
		 if(isset($_POST['Exp']))
                 {
			foreach($_POST['Exp'] as $key =>$row)
			{
				switch ($key)
				{
				case 'from_date':
					$model->from_date = $row;
					break;
				case 'to_date':
					$model->to_date = $row;
					break;
				case 'state_pay':
					$model->state_pay = $row;
					break;
				case 'state_cur':
					$model->state_cur = $row;
					break;
				}
			}
 		}
                  }
  		$this->render('report',array(
			'model'=>$model,'show'=>$show
		));
	}

	private function savechecks($ids)
	{
		if(!(strlen($ids)>0)) return -1;
		$arids=explode("&",$ids);
        if (is_array($arids)) 
		{
			if(count($arids)>0)
			{
				if(strlen($arids[0])>0) 
				{
					$aridon=explode(",",$arids[0]);
					if (is_array($aridon))
				   {
						foreach ($aridon as $itm) 
						{
							$model=$this->loadModel($itm);
							$model->setAttribute('pay',3);
							if(!($model->save())) return $itm;

						}
					}
				}
            } 
			if(count($arids)>1)
			{
				if(strlen($arids[1])>0)
				{
					$aridon=explode(",",$arids[1]);
					if (is_array($aridon))
				   {
						foreach ($aridon as $itm) 
						{
							$model=$this->loadModel($itm);
							$model->setAttribute('pay',0);
							if(!($model->save())) return $itm;

						}
					}
				}
	
            } 
		}
		return -1;
	}
	public function actionAjaxExpd()
	{
		$val1 = $_POST['val_id'];
 		sscanf($val1,"js:_id=%d;_pay=%d;",$id,$pay);
		if($id==null){
                   echo "R:".$val1;
                    return;
                }
		$ret.="";
//		$ret.="<div id='mydialog_buts'>".CHtml::link('Новый платеж',array('pay/createID','id'=>$id), array('target'=>'_blank','class'=>'menuitem'))."</div>";
		$dataReader=Expd::model()->with('product0')->findAll('exp=:id',array(':id'=>$id));
		$ret.="<table class='acctable'>";
		$ret.="<tr><th>№</th>"
                        . "<th>Товар</th>"
                        . "<th>Колич.</th>"
                        . "<th>Цена</th>"
                        . "<th>Сумма</th>"
                        . "<th>Со скид.</th>"
                        . "<th>%</th>"
                        . "<th>НДС</th>"
                        . "<th>Всего</th></tr>";
		$resa=0;
		$resb=0;
		$rest=0;
 	foreach($dataReader as $row) 	{ 
 	$ret.="<tr><td>".$row['id']."</td><td>".$row->product0['tnam']."</td>\n";
//	$ret.="<tr><td>".$row['id']."</td><td>wtf</td>\n";
        $sumka=$row['amount']*$row['price'];
 	$ret.="<td style='text-align:right;'>".Yii::app()->numberFormatter->formatCurrency($row['amount'], '')."</td>\n"; 
	$ret.="<td style='text-align:right;'>".Yii::app()->numberFormatter->formatCurrency($row['price'], '')."</td>\n"; 
	$ret.="<td style='text-align:right;'>".Yii::app()->numberFormatter->formatCurrency($sumka, '')."</td>\n";
	$ret.="<td style='text-align:right;'>".Yii::app()->numberFormatter->formatCurrency($row['total'], '')."</td>\n"; 
        if($sumka==$row['total'])
            $rate=0;
        else
            $rate=($sumka-$row['total'])/$sumka;            
	$ret.="<td style='text-align:right;'>".Yii::app()->numberFormatter->formatPercentage($rate, '')."</td>\n"; 
	$ret.="<td style='text-align:right;'>".Yii::app()->numberFormatter->formatCurrency($row['vat'], '')."</td>\n"; 
	$ret.="<td style='text-align:right;'>".Yii::app()->numberFormatter->formatCurrency($row['total']+$row['vat'], '')."</td></tr>\n"; 
	$resa+=$sumka;
	$resb+=$row['total'];
	$rest+=$row['total']+$row['vat'];
	}
	$ret.="<tr><td colspan='4'>Итого:</td>"
                . "<td style='font-weight: bold;text-align:right;'>".Yii::app()->numberFormatter->formatCurrency($resa, '')."</td>"
                . "<td style='font-weight: bold;text-align:right;'>".Yii::app()->numberFormatter->formatCurrency($resb, '')."</td>"
                . "<td colspan='3' style='font-weight: bold;text-align:right;'>".Yii::app()->numberFormatter->formatCurrency($rest, '')."</td>"
                . "</tr>\n";
	 $ret.="</table>\n";
		echo $ret;
	}
	public function actionAjaxInv()
	{
		$val1 = $_POST['val_id'];
 		sscanf($val1,"js:_id=%d;_pay=%d;",$id,$pay);
		if($id==null){
                   echo "R:".$val1;
                    return;
                }
		$ret.="";
		$dataReader=Inv::model()->with(array('invd'=>array('with'=>array('product0'),'together'=>true)))->findAll('t.exp_id=:id',array(':id'=>$id));
//                var_dump($dataReader);
//                return;
		$ret.="<table class='acctable'>";
		$ret.="<tr><th>№</th>"
                        . "<th>Товар</th>"
                        . "<th>Колич.</th>"
                        . "<th>Цена</th>"
                        . "<th>Сумма</th>"
                        . "<th>Со скид.</th>"
                        . "<th>%</th>"
                        . "<th>НДС</th>"
                        . "<th>Всего</th></tr>";
           
            	foreach($dataReader as $row) 	{ 
                   $ret.="<tr class='ord'><td>".$row['id']."</td><td colspan='2'>".$row['name']
                           ."</td><td colspan='3'>".Yii::app()->dateFormatter->formatDateTime($row['date'], 'short', null)."</td><td colspan='3'>"
                           .Yii::app()->numberFormatter->formatCurrency($row['amount'],'')."</td></tr>\n";
                            $resa=0;
                           $resb=0;
                           $rest=0;
           	foreach($row->invd as $rowi) 	{
  
                        $ret.="<tr><td>".$rowi['id']."</td><td style='text-align:left;'>".$rowi->product0['tnam']."</td>\n";
                       $sumka=$rowi['amount']*$rowi['price'];
                        $ret.="<td style='text-align:right;'>".Yii::app()->numberFormatter->formatCurrency($rowi['amount'], '')."</td>\n"; 
                        $ret.="<td style='text-align:right;'>".Yii::app()->numberFormatter->formatCurrency($rowi['price'], '')."</td>\n"; 
                        $ret.="<td style='text-align:right;'>".Yii::app()->numberFormatter->formatCurrency($sumka, '')."</td>\n";
                        $ret.="<td style='text-align:right;'>".Yii::app()->numberFormatter->formatCurrency($rowi['total'], '')."</td>\n"; 
                        if($sumka==$rowi['total'])
                            $rate=0;
                        else
                            $rate=($sumka-$rowi['total'])/$sumka;            
                        $ret.="<td style='text-align:right;'>".Yii::app()->numberFormatter->formatPercentage($rate, '')."</td>\n"; 
                        $ret.="<td style='text-align:right;'>".Yii::app()->numberFormatter->formatCurrency($rowi['vat'], '')."</td>\n"; 
                        $ret.="<td style='text-align:right;'>".Yii::app()->numberFormatter->formatCurrency($rowi['total']+$rowi['vat'], '')."</td></tr>\n"; 
                        $resa+=$sumka;
                        $resb+=$rowi['total'];
                        $rest+=$rowi['total']+$rowi['vat'];

                } 
                $ret.="<tr class='ord'><td colspan='4'>Итого:</td>"
               . "<td style='font-weight: bold;text-align:right;'>".Yii::app()->numberFormatter->formatCurrency($resa, '')."</td>"
               . "<td style='font-weight: bold;text-align:right;'>".Yii::app()->numberFormatter->formatCurrency($resb, '')."</td>"
               . "<td colspan='3' style='font-weight: bold;text-align:right;'>".Yii::app()->numberFormatter->formatCurrency($rest, '')."</td>"
               . "</tr>\n";

 	}
 	 $ret.="</table>\n";
		echo $ret;
	}
/*
        этот экшн запускается при щелчке в форме Счета по ссылкам в платежах:
    он заполняет состав всплывающего окна инфой по платежам по заказу
 */       
        public function actionAjaxReq()
	{
		$val1 = $_POST['val_id'];
 		sscanf($val1,"js:_id=%d;_pay=%d;",$id,$pay);
		if($id==null){
                   echo "R:".$val1;
                    return;
                }
		$ret.="";
//		$ret.="<div id='mydialog_buts'>".CHtml::link('Новый платеж',array('pay/createID','id'=>$id), array('target'=>'_blank','class'=>'menuitem'))."</div>";
		$dataReader=Pay::model()->findAll('exp_id=:id',array(':id'=>$id));
		$ret.="<table class='acctable'>";
		$ret.="<tr>"
                        . "<th>№</th>"
                        . "<th>Инфо.</th>"
                        . "<th>Дата</th>"
                        . "<th>Получен</th>"
                        . "<th>Сумма</th>"
                        . "</tr>";
		$res=0;
	foreach($dataReader as $row) 	{ 
	$ret.="<tr><td>".$row['id']."</td><td>".$row['name']."</td>\n";
	$ret.="<td>".Yii::app()->dateFormatter->formatDateTime($row['date'], 'short', null)."</td>\n";
	$ret.="<td>".Yii::app()->dateFormatter->formatDateTime($row['date_g'], 'short', null)."</td>\n";
//	$ret.="<td>".$row->account['name']."</td>\n"; 
//	$ret.="<td style='text-align:right;'>".Yii::app()->numberFormatter->formatCurrency($row['amount'], '')."</td></tr>\n"; 
         if( Yii::app()->Controller->permit>2)
            $ret.="<td style='text-align:right;'>".CHtml::link(Yii::app()->numberFormatter->formatCurrency($row['amount'], ''),array('pay/update','id'=>$row['id']),array('target'=>'_blank'))."</td></tr>";
         else
           $ret.="<td style='text-align:right;'>".Yii::app()->numberFormatter->formatCurrency($row['amount'], '')."</td></tr>";
	$res+=$row['amount'];
	}
	$ret.="<tr><td colspan='4'>Оплачено:</td><td style='font-weight: bold;text-align:right;'>".Yii::app()->numberFormatter->formatCurrency($res, '')."</td></tr>\n";
	 $ret.="</table>\n";
		echo $ret;
	}
	public function actionAjaxExp()
	{
		$val1 = $_POST['val_id'];
		sscanf($val1,"js:_id=%d;",$id);
		if($id==null)
                {
                    return;
                }
		$ret="<div id='mydialog_buts'>".CHtml::link('Новый счет',array('exp/createID',
                   'id'=>$id), array('target'=>'_blank','class'=>'menuitem'))."</div>";
		$dataReader=Expexp::model()->with(array('expExp'=>array('with'=>array('pays'))))->findAll('t.exp_id=:id',array(':id'=>$id));
//                echo 'c:'.count($dataReader);
		$ret.="<table class='acctable'>";
		$ret.="<tr><th>№</th>"
                        ."<th>Инфо.</th>"
                        . "<th>Дата</th>"
                        . "<th>Сумма</th>"
                        . "<th>Опл.</th></tr>";
		$res=0;
		$resp=0;
	foreach($dataReader as $row) 	{ 
	$ret.="<tr><td>".$row['exp_expid']."</td>"
                ."<td>".$row->expExp['name']."</td>\n"
                ."<td>".Yii::app()->dateFormatter->formatDateTime($row->expExp['date'], 'short', null)."</td>\n"
                ."<td style='text-align:right;'>".CHtml::link(Yii::app()->numberFormatter->formatCurrency($row->expExp['amount'], ''),array('exp/update','id'=>$row['exp_expid']), array('target'=>'_blank'))."</td>"
                ."<td style='text-align:right;'>".CHtml::link(Yii::app()->numberFormatter->formatCurrency($row->expExp->pays[0]['amount'], ''),array('pay/update','id'=>$row->expExp->pays[0]['id']),array('target'=>'_blank'))."</td></tr>";
	$res+=$row->expExp['amount'];
	$resp+=$row->expExp->pays[0]['amount'];
	}
	$ret.="<tr><td colspan='3'>Итого:</td>"
              . "<td style='font-weight: bold;text-align:right;'>".Yii::app()->numberFormatter->formatCurrency($res, '')."</td>\n"
              . "<td style='font-weight: bold;text-align:right;'>".Yii::app()->numberFormatter->formatCurrency($resp, '')."</td></tr>\n";
	 $ret.="</table>\n";
		echo $ret;
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Exp the loaded model
	 * @throws CHttpException
	 */
	public function findModel($id)
	{
 		$model=new Exp('search');
           
        }
	public function loadModel($id)
	{
		$model=Exp::model()->with(array('department'=>array('departmentProps'),
                                                'client'=>array('clientProps'),
                                               'account',
//                                                'expSum','expTot',                                                        
                                                'expd'=>array('product0'=>array('it0'))))->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Exp $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='exp-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}