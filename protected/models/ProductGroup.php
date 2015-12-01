<?php

/**
 * This is the model class for table "product_group".
 *
 * The followings are the available columns in table 'product_group':
 * @property integer $ckey
 * @property string $tnam
 * @property integer $cgr
 * @property integer $lf_key
 * @property integer $rg_key
 * @property integer $level
 *
 * The followings are the available model relations:
 * @property Product[] $products
 * @property ProductGroup $cgr0
 * @property ProductGroup[] $productGroups
 * @property ProductgroupId[] $productgroups
 */
class ProductGroup extends CActiveRecord
{
   private $lr;
    private $rf;
    private $lvl;
    private $ret;
    private $sess;
        public function _behaviors()
        {
            return array(
                'NestedSetBehavior'=>array(
                    'class'=>'ext.NestedSetBehavior',
                    'leftAttribute'=>'lf_key',
                    'rightAttribute'=>'rg_key',
                    'levelAttribute'=>'level',
                    'hasManyRoots'=>'true',
            ));
        }        
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tnam', 'required'),
			array('cgr, lf_key, rg_key, level', 'numerical', 'integerOnly'=>true),
			array('tnam', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ckey, tnam, cgr, lf_key, rg_key, level', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'products' => array(self::HAS_MANY, 'Product', 'cgr'),
			'cgr0' => array(self::BELONGS_TO, 'ProductGroup', 'cgr'),
			'productGroups' => array(self::HAS_MANY, 'ProductGroup', 'cgr'),
			'productgroups' => array(self::HAS_MANY, 'ProductgroupId', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ckey' => 'Ckey',
			'tnam' => 'Tnam',
			'cgr' => 'Cgr',
			'lf_key' => 'Lf Key',
			'rg_key' => 'Rg Key',
			'level' => 'Level',
		);
	}

	public function doSet(){
            $this->lr=0;
            $this->rf=0;   
            $this->sess=0;
            $this->lvl=1;
            $this->ret='';
            $lr=0;
           $connection=Yii::app()->db; 
 
            $sql="UPDATE product_group SET lf_key=NULL, rg_key=NULL, level=NULL";
            $command=$connection->createCommand($sql);
            $rowCount=$command->execute(); 
           
            $sql='SELECT ckey FROM product_group WHERE (cgr IS NULL)';
            $command=$connection->createCommand($sql);
            $roots=$command->query();
            $connection->active=false;

 //             $roots=  $model->findAll('parent_category_id IS NULL');
         if(count($roots)>0)
            { 
             foreach ($roots as $key => $value) {
                 $lr= ++$this->lr;
                 $this->dodoSet($value['ckey'],$connection);
                $this->ret.='UPDATE product_group SET lf_key='.$lr.", rg_key=".(++$this->lr).', level='.$this->lvl." WHERE ckey=".$value['ckey'].";".PHP_EOL;
                ++$this->rf;                
//                $this->ret.='<br>'.$value['category_id'].":(".$lr.':'.(++$this->lr).':'.$this->lvl.")<br>\n";
                if($this->rf==50)
                {
                   $command=$connection->createCommand($this->ret);  
                   $this->ret='';
                  $this->rf=0;  
                  $this->sess++;
                   $connection->active=true;                   
                   $rowCount=$command->execute(); 
                   $connection->active=false;                   
                 }
              }
                if(strlen($this->ret)>0)
                {
                   $command=$connection->createCommand($this->ret);  
                   $this->ret='';
                  $this->sess++;
                    $connection->active=true;                   
                 $rowCount=$command->execute(); 
                   $connection->active=false;                   
               }
             return  $this->sess;
 
         }
        }
 	protected function dodoSet($id,$connection){
            $lr=0;
             $connection->active=true;
            $sql='SELECT ckey FROM product_group WHERE (cgr='.$id.')';
            $command=$connection->createCommand($sql);
            $roo=$command->query();
           $connection->active=false;
//        $roo=  $model->findAll('parent_category_id=:id',array(':id'=>$id));
         if(count($roo)>0)
            { 
              $this->lvl++;
              foreach ($roo as $key => $value) {
                 $lr= ++$this->lr;
                 $this->dodoSet($value['ckey'],$connection);
                 $this->ret.='UPDATE product_group SET lf_key='.$lr.", rg_key=".(++$this->lr).', level='.$this->lvl." WHERE ckey=".$value['ckey'].";".PHP_EOL;
                 ++$this->rf;                
//                $this->ret.=$value['category_id'].":(".$lr.':'.(++$this->lr).':'.$this->lvl.");";
                if($this->rf==50)
                {
                   $command=$connection->createCommand($this->ret);  
                   $this->ret='';
                    $this->sess++;
                $this->rf=0;
                    $connection->active=true;                   
                 $rowCount=$command->execute(); 
                    $connection->active=false;                   
              }
                }
              $this->lvl--;
              }
//               $model->dbConnection->setActive(false);
        }
         

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ckey',$this->ckey);
		$criteria->compare('tnam',$this->tnam,true);
		$criteria->compare('cgr',$this->cgr);
		$criteria->compare('lf_key',$this->lf_key);
		$criteria->compare('rg_key',$this->rg_key);
		$criteria->compare('level',$this->level);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductGroup the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}