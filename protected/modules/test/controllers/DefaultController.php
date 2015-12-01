<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
		public function actionGo()
	{
		if(isset($_POST))
		{
			$val=$_POST['constant'];
			Constants::model()->setCvalue('dayup',$val);
		}
		$this->render('go',array('model'=>$val));
	}
}