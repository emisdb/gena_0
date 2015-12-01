<?php

/**
 * This is the model class for table "inv".
 *
 * The followings are the available columns in table 'inv':
 * @property integer $id
 * @property string $name
 * @property integer $exp_id
 * @property double $amount
 * @property string $dateinserted
 * @property string $date
 *
 * The followings are the available model relations:
 * @property Exp $exp
 */
class Inv extends CActiveRecord
{
	public $from_date;
	public $to_date;
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
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'inv';
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
			array('client_id, exp_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('name', 'length', 'max'=>64),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, exp_id, amount, cliname,  depname, dateinserted, date', 'safe', 'on'=>'search'),
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
			'exp' => array(self::BELONGS_TO, 'Exp', 'exp_id'),
			'invd' => array(self::HAS_MANY, 'Invd', 'inv'),
			'client' => array(self::BELONGS_TO, 'Client', 'client_id'),
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
			'exp_id' => 'сч.',
			'amount' => 'Отгружено',
			'date' => 'Дата',
			'curname' => 'Валюта',
			'depname' => 'Фирма',
			'expname' => 'по сч.',
			'expdate' => 'от',
			'cliname' => 'Клиент',
		);
	}
         public function nameic($data, $row)
{
        $link=CHtml::ajaxLink(
             $data->expname,
             $url=array('ajaxExpd'),
             $ajaxOptions= array(
            'data'=>array('val_id'=>'js:$(this).attr("href")'),
              'type'=>'POST',
             'update'=>'#pay_table',
             'complete' => 'function() {$("#accountsdialog").dialog("open");}',	  
         //						'complete' => 'function() {doshowpay(this);}'	  
             'beforeSend' => 'doshowpay(this)'	        ),
             $htmlOptions=array('href'=>'js:_id='.$data->exp->id.';_pay=100;')
     );
           return $link;
}
         public function nameinv($data, $row)
{
        $link=CHtml::ajaxLink(
             $data->name,
             $url=array('ajaxInvd'),
             $ajaxOptions= array(
            'data'=>array('val_id'=>'js:$(this).attr("href")'),
              'type'=>'POST',
             'update'=>'#pay_table',
             'complete' => 'function() {$("#accountsdialog").dialog("open");}',	  
         //						'complete' => 'function() {doshowpay(this);}'	  
             'beforeSend' => 'doshowpay(this)'	        ),
             $htmlOptions=array('href'=>'js:_id='.$data->id.';_pay=500;')
     );
           return $link;
}
public function getTotals($ids,$what)
        {
                $ids = implode(",",$ids);
                if(strlen($ids)==0)  return Yii::app()->numberFormatter->formatCurrency(0,'');
               
                $connection=Yii::app()->db;
                if($what==0)
                {
                $command=$connection->createCommand("SELECT SUM(amount)
                                                     FROM `inv` where id in (".$ids.")");
                }
               else if($what==1)
                {
                $command=$connection->createCommand("SELECT SUM(`exp`.amount)
                                                     FROM `exp` INNER JOIN `inv` ON `inv`.exp_id=`exp`.id
                                                     where `inv`.id in (".$ids.")");
                }
                 return Yii::app()->numberFormatter->formatCurrency($command->queryScalar(),'');
        }
        private function daterange($criteria)
	{	
		if(!empty($this->from_date) && empty($this->to_date))
        {
            $criteria->addCondition("t.date >= '$this->from_date'");  
			// date is database date column field
        }
		elseif(!empty($this->to_date) && empty($this->from_date))
        {
            $criteria->addCondition("t.date <= '$this->to_date'");
        }
		elseif(!empty($this->to_date) && !empty($this->from_date))
        {
            $criteria->addCondition("t.date  >= '$this->from_date' and t.date <= '$this->to_date'");
        }
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

		$sort           = new CSort;
		$criteria=new CDbCriteria;
                $criteria->with = array("exp","exp.currency","exp.client","exp.department");

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('exp_id',$this->exp_id);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('dateinserted',$this->dateinserted,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('currency.name', $this->curname, true);
		$criteria->compare('client.name', $this->cliname, true);
		$criteria->compare('department.name', $this->depname, true);
		$criteria->compare('exp.name', $this->expname, true);
		$criteria->compare('exp.date', $this->expdate, true);
                $criteria->compare('exp.pub',1);
		$this->daterange($criteria);
		$sort->defaultOrder= array(
            'date'=>CSort::SORT_ASC,
        );
		return new CActiveDataProvider($this,array(
//            'pagination'=>array('pageSize'=>50),
           'pagination'=>false,
            'criteria'=>$criteria,
            'sort'=>$sort,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Inv the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
