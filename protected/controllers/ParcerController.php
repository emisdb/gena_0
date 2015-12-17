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
		$modelff=new FileRead;
		if(isset($_POST['TmpXml'])){
			$model=$_POST['TmpXml'];
			$res=$this->writesimple($model);
			$this->render('result',array('model'=>$res,));
		}
		else
		{
			if(isset($_POST['FileRead'])){
				$modelff->attributes=$_POST['FileRead'];
				if(!$modelff->validate())
				{
					$this->render('fform',array('model'=>$modelff,));
					return;
				}
				$modelff->image = CUploadedFile::getInstance($modelff, 'image');
				if (is_object($modelff->image)) {          
 //				$path=Yii::app()->params['load_xml'];
					$path='docs/go.csv';
					$modelff->image->saveAs($path);
				}
				$thefile=Yii::app()->params['load_csv'];
				$data=$this->readsimple($thefile,$modelff);
//				$model=new TmpXml('search');
//				$doc=new TmpDoc('search');
//				$this->render('admin',array('model'=>$model,'doc'=>$doc,'rr'=>$ii));
				$this->render('admin',array('model'=>$data));
			}
			else
			{
				$this->render('fform',array('model'=>$modelff,));
			}
		}
  	}
	private function readsimple($thefile,$model)
	{
            TmpXml::model()->deleteAll('user='.Yii::app()->user->uid);
            TmpDoc::model()->deleteAll('user='.Yii::app()->user->uid);
            TmpDocd::model()->deleteAll('user='.Yii::app()->user->uid);
            $connection=Yii::app()->db;  
//            $connection->createCommand('ALTER TABLE tmp_xml AUTO_INCREMENT = 1;')->execute();          
//            $connection->createCommand('ALTER TABLE tmp_docd AUTO_INCREMENT = 1;')->execute();          
            $ii=0;
            $result=false;
			$data=array();
            if(file_exists($thefile)) {
				if (($handle = fopen($thefile, "r")) === FALSE) return 'empty';
					while (($cols = fgetcsv($handle, 1000, ";")) !== FALSE) {
						$ii++;
						if(($ii>=$model->n_str)&&($ii<=$model->n_fin))
						{
							foreach( $cols as $key => $val ) {
								$cols[$key] = trim( $cols[$key] );
								$cols[$key] = iconv('windows-1251', 'UTF-8', $cols[$key]."\0") ;
								$cols[$key] = str_replace('""', '"', $cols[$key]);
								$cols[$key] = preg_replace("/^\"(.*)\"$/sim", "$1", $cols[$key]);
						   }
							$data[]=$cols;
						}
					}
					return $data;
        }
		return "hui";
	}

}