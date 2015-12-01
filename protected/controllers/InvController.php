<?php

class InvController extends Controller
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
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','print','ajaxExpd','ajaxInvd'),
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
        
	public function actionPrint($id)
	{
             $this->layout='//layouts/print';
             $model=$this->loadModel($id);
             $dep=array();
             $cli=array();
            $clix=array();
             $pay=array();
              foreach($model->exp->department->departmentProps as $key=>$value)
                 $dep[$value['_key']]=$value['_value'];
            foreach($model->exp->client->clientProps as $key=>$value)
                 $cli[$value['_key']]=$value['_value'];
            if(!is_null($model->client))
           foreach($model->client->clientProps as $key=>$value)
                 $clix[$value['_key']]=$value['_value'];
            foreach($model->exp->pays as $key=>$value)
                 $pay[]=$value;
  		$this->render('print',array(
			'dep'=>$dep,'cli'=>$cli,'clix'=>$clix,'model'=>$model,'pay'=>$pay
		));
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Inv;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Inv']))
		{
			$model->attributes=$_POST['Inv'];
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

		if(isset($_POST['Inv']))
		{
			$model->attributes=$_POST['Inv'];
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
		$dataProvider=new CActiveDataProvider('Inv');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Inv('search');
		$model->unsetAttributes();  // clear any default values
		 if(empty($_POST))
		 {
			$model->from_date = Constants::model()->getCvalue('invf_'.Yii::app()->user->uid);
			$model->to_date = Constants::model()->getCvalue('invt_'.Yii::app()->user->uid);
		 }
		 else
		  {
			Constants::model()->setCvalue('invf_'.Yii::app()->user->uid,$_POST['Inv']['from_date']);
			Constants::model()->setCvalue('invt_'.Yii::app()->user->uid,$_POST['Inv']['to_date']);
			$model->from_date = $_POST['Inv']['from_date'];
			$model->to_date = $_POST['Inv']['to_date'];
		}
                if(isset($_GET['Inv']))
			$model->attributes=$_GET['Inv'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Inv the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Inv::model()->with(array('exp'=>array(
                                                    'pays',
                                                    'department'=>array('departmentProps'),
                                                    'client'=>array('clientProps')
                                                ),
                                                'invd'=>array('product0'=>array('it0'))))->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Inv $model the model to be validated
	 */
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
	public function actionAjaxInvd()
	{
		$val1 = $_POST['val_id'];
 		sscanf($val1,"js:_id=%d;_pay=%d;",$id,$pay);
		if($id==null){
                   echo "R:".$val1;
                    return;
                }
		$ret.="";
//		$ret.="<div id='mydialog_buts'>".CHtml::link('Новый платеж',array('pay/createID','id'=>$id), array('target'=>'_blank','class'=>'menuitem'))."</div>";
		$dataReader=Invd::model()->with('product0')->findAll('inv=:id',array(':id'=>$id));
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
        protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='inv-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
