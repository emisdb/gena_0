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

}