<?php

class PayController extends Controller
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
				'actions'=>array('create','createID','createN','update','ajaxUpdate'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','ddo'),
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
		$model=new Pay;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pay']))
		{
			$model->attributes=$_POST['Pay'];
			if($model->save())
                            	$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	public function actionCreateN($id)
	{
		$model=new Pay;
		$modele=Exp::model()->with('currency','paySum')->findByPk($id);
                $modele->isNewRecord=true;
		if(isset($_POST['Exp']))
		{
                    var_dump($_POST['Exp']);
                    echo "<hr>";
                    var_dump($_POST['Pay']);
                    echo "<hr>";
                    return;
 
/*			$modele->attributes=$_POST['Exp'];
			if($modele->save())
                        {
                            if(isset($_POST['Pay']))
                            {
                                $model->attributes=$_POST['Pay'];
                                if($model->save())
                                        $this->redirect(array('exp/admin'));
                            }

 *                         }
 */
		}
		$model->exp_id=$id;
		$this->render('createn',array(
			'model'=>$model,'modele'=>$modele,'id'=>$id,
		));
	}
	public function actionCreateID()
	{
		$model=new Pay;
  		$val1 = $_POST['val_id'];
 		sscanf($val1,"js:_id=%d;",$id);
 		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pay']))
		{
			$model->attributes=$_POST['Pay'];
			$model->setAttribute('date_g', $_POST['Pay']['date_g']);
                        $model->dg_null=$_POST['Pay']['dg_null'];
			if($model->save())
//				$this->redirect(array('exp/admin'));
                          $this->redirect(array('exp/admin','ret'=>1,'#'=>'e_'.$model->exp_id,'tmp'=>$model->attributes));
		}
               	$model->exp_id=$id;
		$row=Exp::model()->with('currency','paySum')->findByPk($id);
		if (!($row==null))
		{
			$model->curname=$row->currency->name;
                        $modelamount=$row->amount-$row->paySum;
                        if($modelamount<0)
                        {
                            $model->amount=0;
                        }
                            else
                        {
                            $model->amount=$modelamount;
                        }
		}

                echo $this->renderPartial('_form', array('model'=>$model));
                }
	public function actionAjaxUpdate()
	{
		$model=new Pay;
  		$val1 = $_POST['val_id'];
 		sscanf($val1,"js:_id=%d;_exp=%d;",$id,$exp);
 		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pay']))
		{
			$model->attributes=$_POST['Pay'];
			if($model->save())
                           	$this->redirect(array('view','id'=>$model->id));
//				$this->redirect(array('admin'));
		}
		$row=$model->with('exp')->findByAttributes(array('id'=>$id,'exp_id'=>$exp));
		if (!($row==null))
		{
                  echo $this->renderPartial('_form', array('model'=>$model));	}
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

		if(isset($_POST['Pay']))
		{
			$model->attributes=$_POST['Pay'];
                        $model->dg_null=$_POST['Pay']['dg_null'];
 			if($model->save())
                        {
                          $this->redirect(array('admin','ret'=>1,'#'=>'p_'.$id));
                           
                        }
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
		$model=$this->loadModel($id);
		$expid=$model->exp_id;
		$model->delete();
		Exp::model()->findByPk($expid)->doPay();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Pay');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($ret=0)
	{
		$model=new Pay('search');
		$model->unsetAttributes();  // clear any default values
		 if(empty($_POST))
		 {
			$model->from_date = Constants::model()->getCvalue('payf_'.Yii::app()->user->uid);
			$model->to_date = Constants::model()->getCvalue('payt_'.Yii::app()->user->uid);
			$model->state_pay = Constants::model()->getCvalue('paya_'.Yii::app()->user->uid);
                        if($ret==1)
                            $model->cliname = Constants::model()->getCvalue('payc_'.Yii::app()->user->uid);

		 }
		 else
		  {
                        Constants::model()->setCvalue('payf_'.Yii::app()->user->uid,$_POST['Pay']['from_date']);
			Constants::model()->setCvalue('payt_'.Yii::app()->user->uid,$_POST['Pay']['to_date']);
			Constants::model()->setCvalue('paya_'.Yii::app()->user->uid,$_POST['Pay']['state_pay']);
			$model->from_date = $_POST['Pay']['from_date'];
			$model->to_date = $_POST['Pay']['to_date'];
			$model->state_pay = $_POST['Pay']['state_pay'];
		}

		if(isset($_GET['Pay']))
                {
			$model->attributes=$_GET['Pay'];
               }
                if(isset($model->cliname))
                   Constants::model()->setCvalue('payc_'.Yii::app()->user->uid,$model->cliname);
                 else 
                 {
                   Constants::model()->delCvalue('payc_'.Yii::app()->user->uid);  
                 }
 		$this->render('admin',array(
			'model'=>$model,'tmp'=>$_GET['Exp']
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Pay the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Pay::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	/**
	 * Performs the AJAX validation.
	 * @param Pay $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pay-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
