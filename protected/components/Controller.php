<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
  	public function getPermit()
	{
          	if(Yii::app()->user->hasState("perm"))
                {
                      switch (Yii::app()->user->perm) {
                          case 'superadmin':
                              return 5;
                              break;
                          case 'admin':
                              return 4;
                              break;
                          case 'superuser':
                              return 3;
                              break;
                         case 'user':
                              return 2;
                              break;
                          default:
                              return 1;
                              break;
                      }
                }
                return 0;
 
        }
      
}