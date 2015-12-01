<?php

/**
 * This is the model class for table "pay".
 *
 * The followings are the available columns in table 'pay':
 * @property integer $id
 * @property string $name
 * @property integer $exp_id
 * @property double $amount
 * @property string $dateinserted
 * @property string $date
 * @property string $date_g
 * @property integer $account_id
 *
 * The followings are the available model relations:
 * @property Exp $exp
 * @property Account $account
 */
class Pay extends CActiveRecord
{
	public $from_date;
	public $to_date;
	public $state_pay;
	private $null_dg;
	private $_cur = null;
	private $_cli = null;
	private $_dep = null;
	private $_name = null;
	private $_dat = null;
	public function getExpname(){
		if ($this->_name === null && $this->exp !== null)
		{
			$this->_name = $this->exp->name;
		}
		return $this->_name;
	}
	public function setExpname($value){
		$this->_name = $value;
	}	
	public function getExpdate(){
		if ($this->_dat === null && $this->exp !== null)
		{
			$this->_dat = $this->exp->date;
		}
		return $this->_dat;
	}
	public function setExpdate($value){
		$this->_dat = $value;
	}
	public function getCurname(){
		if ($this->_cur === null && $this->exp->currency !== null)
		{
			$this->_cur = $this->exp->currency->name;
		}
		return $this->_cur;
	}
	public function setCurname($value){
		$this->_cur = $value;
	}	
	public function getDepname(){
		if ($this->_dep === null && $this->exp->department !== null)
		{
			$this->_dep = $this->exp->department->name;
		}
		return $this->_dep;
	}
	public function setDepname($value){
		$this->_dep = $value;
	}
 	public function getDg_null(){
            if($this->date_g===null)
		return true;
            else
		return false;
	}
       public function setDg_null($value){
		$this->null_dg = $value;
                if($this->null_dg)
                    $this->date_g=null;
	}
	public function getCliname(){
		if ($this->_cli === null && $this->exp->client !== null)
		{
			$this->_cli = $this->exp->client->name;
		}
		return $this->_cli;
	}
	public function setCliname($value){
		$this->_cli = $value;
	}
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pay the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pay';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('exp_id, date', 'required'),
			array('exp_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('date_g', 'safe', 'on'=>'update,create,createID'),
			array('name', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, expname, expdate, name, curname, cliname, depname, exp_id, amount, date, date_g', 'safe', 'on'=>'search'),
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
			'exp' => array(self::BELONGS_TO, 'Exp', 'exp_id','with'=>array('currency','client','department')),
			'exp0' => array(self::HAS_MANY, 'Exp', 'id'),
			'currency1' => array(self::HAS_ONE, 'Currency', array('currency_id'=>'id'),'through'=>'exp'),
			'currency0' => array(self::HAS_ONE, 'Currency','exp(id,currency_id)'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '№',
			'name' => 'Номер',
			'exp_id' => 'По счету',
			'amount' => 'Оплата',
			'date' => 'Дата',
			'date_g' => 'Получено',
			'curname' => 'Валюта',
			'depname' => 'Фирма',
			'expname' => 'по сч.',
			'expdate' => 'от',
			'cliname' => 'Клиент',
		);
	}
protected function _beforeSave()
{
    if(parent::beforeSave())
    {
        if($this->null_dg)
              $this->date_g=NULL;
			 return true;
    }
    else
        return false;
}	
	protected function afterSave()
	{
	   parent::afterSave();
		Exp::model()->findByPk($this->exp_id)->save();
//		$row->save();
	}

	public function showme($data,$row)
	{	
		$pSum=Exp::model()->with('paySum')->findByPk($data->exp_id)->paySum;
		return Yii::app()->numberFormatter->formatCurrency($pSum, '');
	}
public function getTotals($ids,$what)
        {
                $ids = implode(",",$ids);
               if(strlen($ids)==0)  return Yii::app()->numberFormatter->formatCurrency(0,'');
                
                $connection=Yii::app()->db;
                if($what==0)
                {
                $command=$connection->createCommand("SELECT SUM(amount)
                                                     FROM `pay` where id in (".$ids.")");
                }
               else if($what==1)
                {
//                $command=$connection->createCommand("SELECT SUM(`exp`.amount)
//                                                     FROM `exp` INNER JOIN `pay` ON `pay`.exp_id=`exp`.id
//                                                     where `pay`.id in (".$ids.")");
                $command=$connection->createCommand("SELECT SUM(`exp`.amount)  FROM `exp` 
                                                     WHERE `exp`.id in (SELECT pay.exp_id FROM pay WHERE `pay`.id in (".$ids."))");
                }
               else if($what==2)
                {
                $command=$connection->createCommand("SELECT SUM(amount)FROM `pay`
                                                    WHERE (id in (".$ids.")) AND (date_g IS NOT NULL)" );
                }
                 return Yii::app()->numberFormatter->formatCurrency($command->queryScalar(),'');
        }
        private function paystate($criteria)
	{
 		if(!empty($this->state_pay))
               {
                    if($this->state_pay==0)
                    {
                        return;
                    }
                   else if($this->state_pay<3)
                  {
                      $criteria->addCondition("t.date_g IS NOT NULL");  
                  }
                   else if($this->state_pay==3)
                  {
                       $criteria->addCondition("t.date_g IS NULL");  
                  }
                   
                }
            
         }	
	 private function daterange($criteria)
	{
             if($this->state_pay==2)
                 $txtd='t.date_g';
             else {
                $txtd='t.date';
                 
             }
		if(!empty($this->from_date) && empty($this->to_date))
            {
                $criteria->addCondition($txtd." >= '$this->from_date'");  
                            // date is database date column field
            }
                    elseif(!empty($this->to_date) && empty($this->from_date))
            {
                $criteria->addCondition($txtd." <= '$this->to_date'");
            }
                    elseif(!empty($this->to_date) && !empty($this->from_date))
            {
                $criteria->addCondition($txtd."  >= '$this->from_date' and ".$txtd." <= '$this->to_date'");
            }
	}


	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$sort           = new CSort;
		$criteria=new CDbCriteria;
                $criteria->with = array("exp","exp.currency","exp.client","exp.department");
 		$criteria->compare('id',$this->id);
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('exp_id',$this->exp_id);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('dateinserted',$this->dateinserted,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('date_g',$this->date_g,true);
		$criteria->compare('currency.name', $this->curname, true);
		$criteria->compare('client.name', $this->cliname, true);
		$criteria->compare('department.name', $this->depname, true);
		$criteria->compare('exp.name', $this->expname, true);
		$criteria->compare('exp.date', $this->expdate, true);
                $criteria->compare('exp.pub',1);
		$this->daterange($criteria);
		$this->paystate($criteria);

                $sort->attributes=array('id','expname'=>array('asc'=>'exp.name','desc'=>'exp.name desc'),
                    'expdate'=>array('asc'=>'exp.date','desc'=>'exp.date desc'),
                    'cliname'=>array('asc'=>'client.name','desc'=>'client.name desc'),'date','date_g');
		$sort->defaultOrder= array(
            'expname'=>CSort::SORT_ASC,
        );

		return new CActiveDataProvider($this,array(
//            'pagination'=>array('pageSize'=>50),
           'pagination'=>false,
            'criteria'=>$criteria,
            'sort'=>$sort,
		));
	}
}