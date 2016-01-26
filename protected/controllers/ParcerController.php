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
				$ii=$this->readsimple($thefile,$modelff);
//				$model=new TmpXml('search');
				$doc=new TmpDoc('search');
//				$this->render('admin',array('model'=>$model,'doc'=>$doc,'rr'=>$ii));
				Constants::model()->setCvalue('nstr_'.Yii::app()->user->uid,$modelff->n_str);
				Constants::model()->setCvalue('nfin_'.Yii::app()->user->uid,$modelff->n_fin);
				Constants::model()->setCvalue('nnom_'.Yii::app()->user->uid,$modelff->n_nom);
				Constants::model()->setCvalue('nart_'.Yii::app()->user->uid,$modelff->n_art);
				Constants::model()->setCvalue('nquant_'.Yii::app()->user->uid,$modelff->n_quant);
				Constants::model()->setCvalue('nprice_'.Yii::app()->user->uid,$modelff->n_price);
				
				$this->render('admin',array('model'=>$doc));
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
            $ii=0;$jj=0;
            $result=false;
//			$data=array();
            if(file_exists($thefile)) {
				if (($handle = fopen($thefile, "r")) === FALSE) return 'empty';
					while (($cols = fgetcsv($handle, 1000, ";")) !== FALSE) {
						$ii++;
						if(($ii>=$model->n_str)&&($ii<=$model->n_fin))
						{
							if($jj==0)$jj=1;
							$data=new TmpDoc;
							$data->id=$jj++;
							$data->user=Yii::app()->user->uid;
									
									$tmp = trim( $cols[$model->n_nom-1] );
									$tmp = iconv('windows-1251', 'UTF-8', $tmp."\0") ;
									$tmp = str_replace('""', '"', $tmp);
									$tmp = preg_replace("/^\"(.*)\"$/sim", "$1", $tmp);
									$data->docinfo=$tmp;

									$tmp = trim( $cols[$model->n_art-1] );
									$data->tnum=$tmp;
									$price = (float) $cols[$model->n_price-1] ;
									$data->bsum=$price;
									$sum = (float) $cols[$model->n_quant-1] ;
//									$data->tonum=$sum/$price;
									$data->cliname=$sum;
									$data->save();

						}
						
					}
       }
		return jj;
	}

}