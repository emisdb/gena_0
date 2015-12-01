<?php

class ParcerController extends Controller
{

	    private $filepath;
/**
	 * Declares class-based actions.
	 */
	public $layout='//layouts/column2';


	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionAdmin()
	{
		$model=new TmpDocd('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TmpDocd']))
			$model->attributes=$_GET['TmpDocd'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public function actionIndex()
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
                               $path='docs/go.csv';
                               $modelff->image->saveAs($path);
                        }  
                      $thefile=Yii::app()->params['load_csv'];
                          
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
	private function readsimple($thefile)
	{
            TmpXml::model()->deleteAll('user='.Yii::app()->user->uid);
            TmpDoc::model()->deleteAll('user='.Yii::app()->user->uid);
            TmpDocd::model()->deleteAll('user='.Yii::app()->user->uid);
            $connection=Yii::app()->db;  
//            $connection->createCommand('ALTER TABLE tmp_xml AUTO_INCREMENT = 1;')->execute();          
//            $connection->createCommand('ALTER TABLE tmp_docd AUTO_INCREMENT = 1;')->execute();          
            $ii=0;
            $result=false;
            if(file_exists($thefile)) 
            $result = fopen($thefile,'r');
            $db=1;
            foreach ($result as $key => $value) { 
                
            }
        }

}