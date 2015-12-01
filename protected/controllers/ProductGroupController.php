<?php

class ProductGroupController extends Controller
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
				'actions'=>array('create','update','test','tree'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
		$model=new ProductGroup;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProductGroup']))
		{
			$model->attributes=$_POST['ProductGroup'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ckey));
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

		if(isset($_POST['ProductGroup']))
		{
			$model->attributes=$_POST['ProductGroup'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ckey));
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
		$dataProvider=new CActiveDataProvider('ProductGroup');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ProductGroup('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProductGroup']))
			$model->attributes=$_GET['ProductGroup'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public function actionTest()
	{
            $model='';
//            $dataProvider=ProductGroup::model()->doSet();
             $sql='select ckey, tnam, level FROM product_group WHERE level>0 ORDER BY lf_key';
           $connection=Yii::app()->db; 
           $command=$connection->createCommand($sql);
            $roots=$command->query();
              if(count($roots)>0)
                { 
                  $lvl=0;
                   foreach ($roots as $key => $value) {
                       if($lvl<$value['level'])
                       {
                           $lvl=$value['level'];
                           $model.="<ol>\n";
                           $model.="<li>".$value['ckey']." ".$value['tnam']."</li>\n";
                       }
                       elseif($lvl>$value['level'])
                       {
                          $lvl=$value['level'];
                          $model.="</ol>\n";
                          $model.="<li>".$value['ckey']." ".$value['tnam']."</li>\n";
                       }
                       else 
                              $model.="<li>".$value['ckey']." ".$value['tnam']."</li>\n";
                    
                   }
                }
		$this->render('show',array(
			'model'=>$model,
		));

        }
	private function doTree($roots,$i,$lvl)
        {
            $arr=array();
            while(count($roots)>$i)
            {
                 $rec=array('text'=>$roots[$i]['tnam'],'hasChildren'=>false);
                 if (count($roots)>$i+1)
                 {
                     if($roots[$i+1]['level']>$lvl)
                     {
                         $rec['hasChildren']=true;
                         $rec['children']=doTree($roots,$i+1,$lvl+1);
                     }
                     elseif($roots[$i+1]['level']<$lvl)
                     {
                         
                     }
 
                 }
                else 
                    {
                    $arr[]=$rec;
                    }

     
            }
            return $arr;
        }
private function createTree($roots, $left = 0, $right = null) {
    $tree = array();
    foreach ($roots as $cat => $range) {
        if ($range['lf_key'] == $left + 1 && (is_null($right) || $range['rg_key'] < $right)) {
            $tree[]=array('text'=>$range['tnam'],'children'=> $this->createTree($roots, $range['lf_key'], $range['rg_key']));
            $left = $range['rg_key'];
        }
    }
    return $tree;
}
	public function actionTree()
	{
            $model=array();
             $sql='select ckey, tnam, level, lf_key, rg_key FROM product_group WHERE level>0 ORDER BY lf_key';
           $connection=Yii::app()->db; 
           $command=$connection->createCommand($sql);
            $roots=$command->query();
                if($roots->rowCount>0)
                { 
                  $model=$this->createTree($roots->readAll());

                 }
		$this->render('_test',array(
			'model'=>$model,
		));

        }
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ProductGroup the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ProductGroup::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ProductGroup $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-group-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
