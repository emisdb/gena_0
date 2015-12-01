<?php

 Yii::import('zii.widgets.CMenu');
 
class EMenu extends CMenu
{
    // to make menu vertical
    public $vertical = false; 
    // to make menu right to left vertical, just will be considered if $vertical set to true
    public $rtl = false; 
    // to make menu upward
    public $upward = false;
    public $firstItemCssClass = 'first';
	
     public $lastItemCssClass = 'last';
    public $dirCssClass = 'dir';
    
    //to use a provided theme
    public $theme = 'default';
 
 
    //to use a personal theme. if set, $theme will be ignored
    public $themeCssFile = '';

    // self-built data parameters
 
	public $sametable = false;
 	public $model_name = '';
	public $top_name = '';
	public $bottom_name = '';
	public $url_name = '';
    public $relation_name = '';
	public $picktopvalue='';
	public $pickbottomvalue='';
	public $pickfunction='';


	private $menuTree=array();

    public function init()
    {
		if ($this->model_name != '')
			$this->items = $this->getMenuTree();
		$class=array('dropdown');
        $cssFile;
        if($this->vertical){
            $class[] = 'dropdown-vertical';
            if($this->rtl){
                $class[] = 'dropdown-vertical-rtl';
                $cssFile = 'dropdown.vertical.rtl.css';
            }
            else{
                $cssFile = 'dropdown.vertical.css';
            }
        }
        else if($this->upward){
            $class[] = 'dropdown-upward';
            $cssFile = 'dropdown.upward.css';
        }
        else{
            $class[] = 'dropdown-horizontal';
            $cssFile = 'dropdown.css';
        }
        
        $this->htmlOptions['class']=implode(' ',$class);
                        
        $basedir = dirname(__FILE__). '/free-css-drop-down-menu';
        $baseUrl = Yii::app()->getAssetManager()->publish($basedir);

        if($this->themeCssFile == ''){
            switch ($this->theme) {
                case 'adobe':
                    $this->themeCssFile = 'adobe.com/default.css';
                    break;
                case 'flikr':
                    $this->themeCssFile = 'flikr.com/default.css';
                    break;
                case 'lwis':
                    $this->themeCssFile = 'lwis.celebrity/default.css';
                    break;
                case 'mtv':
                    $this->themeCssFile = 'mtv.com/default.css';
                    break;
                case 'nvidia':
                    $this->themeCssFile = 'nvidia.com/default.css';
                    break;
                case 'vimeo':
                    $this->themeCssFile = 'vimeo.com/default.css';
                    break;
                case 'default':
                default:
                    $this->themeCssFile = 'default/default.css';
                    break;
            }
        }

        Yii::app()->getClientScript()->registerCSSFile($baseUrl.'/css/dropdown/'.$cssFile)
                                    ->registerCSSFile($baseUrl.'/css/dropdown/themes/'.$this->themeCssFile);

          //ToDo: these should added just for IE7, i don't know how to do this
//            Yii::app()->getClientScript()->registerCoreScript('jquery')
//                                            ->registerScriptFile($baseUrl.'/js/jquery.dropdown.js');
        parent::init();
    }

    /**
     * Recursively renders the menu items.
     * @param array $items the menu items to be rendered recursively
     */
    protected function renderMenuRecursive($items)
    {
        $count=0;
        $n=count($items);
        foreach($items as $item)
        {
            if($item == array())
                continue;
            $count++;
            $options=isset($item['itemOptions']) ? $item['itemOptions'] : array();
            $class=array();
//            if($item['active'] && $this->activeCssClass!='')
//                    $class[]=$this->activeCssClass;
            if($count===1 && $this->firstItemCssClass!='')
                $class[]=$this->firstItemCssClass;
            if($count===$n && $this->lastItemCssClass!='')
                $class[]=$this->lastItemCssClass;
            if($class!==array())
            {
                if(empty($options['class']))
                    $options['class']=implode(' ',$class);
                else
                    $options['class'].=' '.implode(' ',$class);
            }

            if(isset($item['items']) && count($item['items']))
                if(empty($options['class']))
                    $options['class']=' '.$this->dirCssClass;
                else
                    $options['class'].=' '.$this->dirCssClass;

            echo CHtml::openTag('li', $options);

            $menu=$this->renderMenuItem($item);
            if(isset($this->itemTemplate) || isset($item['template']))
            {
                $template=isset($item['template']) ? $item['template'] : $this->itemTemplate;
                echo strtr($template,array('{menu}'=>$menu));
            }
            else
                echo $menu;

            if(isset($item['items']) && count($item['items']))
            {
                echo "\n".CHtml::openTag('ul',isset($item['submenuOptions']) ? $item['submenuOptions'] : $this->submenuHtmlOptions)."\n";
                $this->renderMenuRecursive($item['items']);
                echo CHtml::closeTag('ul')."\n";
            }

            echo CHtml::closeTag('li')."\n";
        }
    }
	  private function getMenuTree() {
      if (empty($this->menuTree)) {
		if($this->relation_name=='')	$rows = CActiveRecord::model($this->model_name)->findAll();
		else	$rows = CActiveRecord::model($this->model_name)->with($this->relation_name)->findAll();
           foreach ($rows as $item) {
				if($this->sametable) $this->menuTree[] = $this->getHirMenuItems($item);
				else $this->menuTree[] = $this->getMenuItems($item);
            }
        }
      return $this->menuTree;
   }
 
	private function getMenuItems($modelRow) {
 
        if (!$modelRow)
            return;
		if ($this->relation_name != '')
		{
			$chump = $modelRow->getRelated($this->relation_name);
			$arr = array();
			$inti=0;
			foreach ($chump as $leaves)
			{
				 $arr[$inti] = array('label' => $leaves->getAttribute($this->bottom_name), 
								'url' =>$this->url_name);
				$linkop="";
				if ($this->pickfunction != '')
					if ($this->pickbottomvalue != '') 
						$linkop="".$this->pickfunction."('".$leaves->getAttribute($this->pickbottomvalue)."',this)";
				if ($linkop != '') $arr[$inti]['linkOptions']=array('onclick'=>$linkop);
				$inti++;
		   }
		}
		$res = array('label' => $modelRow->getAttribute($this->top_name), 
					'items' => $arr,
					'url' =>$this->url_name);
		$linkop="";
   		if ($this->pickfunction != '')
			if ($this->picktopvalue != '') 
				$linkop="".$this->pickfunction."('".$modelRow->getAttribute($this->picktopvalue)."',this)";
  		if ($linkop != '') $res['linkOptions']=array('onclick'=>$linkop);
		
        return $res;
    }
    private function getHirMenuItems($modelRow) {
 
        if (!$modelRow)
            return;
 
  
//  if (isset($modelRow->getRelated($this->relation_name))) {
	if (is_null($modelRow->getRelated($this->relation_name))) {
            $chump = $this->getHirMenuItems($modelRow->getRelated($this->relation_name));
            if ($chump != null)
                $res = array('label' => $modelRow->getAttribute($this->top_name), 'items' => $chump, 'url' =>$this->url_name);
            else
                $res = array('label' => $modelRow->getAttribute($this->top_name), 'url' =>$this->url_name);
            return $res;
        } 
		else 
		{
            if (is_array($modelRow)) {
                $arr = array();
                foreach ($modelRow as $leaves) {
                    $arr[] = $this->getHirMenuItems($leaves);
                }
                return $arr;
            } 
			else 
			{
                return array('label' => ($modelRow->getAttribute($this->top_name)), 'url' =>$this->url_name);
            }
        }
    }

}