<?php

/**
 * This is the model class for table "inc".
 *
 * The followings are the available columns in table 'inc':
 * @property integer $id
 * @property string $name
 * @property integer $client_id
 * @property integer $department_id
 * @property integer $users_id
 * @property integer $concert_id
 * @property integer $expence_id
 * @property integer $currency_id
 * @property double $amount
 * @property string $dateinserted
 * @property string $date
 * @property string $link
 * @property integer $city_id
 * @property integer $account_id
 *
 * The followings are the available model relations:
 * @property Account $account
 * @property Client $client
 * @property Department $department
 * @property Users $users
 * @property Concert $concert
 * @property Expence $expence
 * @property Currency $currency
 * @property City $city
 */
class Inc extends CActiveRecord
{
	public $from_date;
	public $to_date;

	private $_cur = null;
	private $_city = null;
	private $_cli = null;
	private $_con = null;
	private $_dep = null;
	private $_use = null;
	private $_exp = null;
	private $_acc = null;	
	private $_cou = null;

	public function getAccname(){
		if ($this->_acc === null && $this->account !== null)
		{
			$this->_acc = $this->account->name;
		}
		return $this->_acc;
	}
	public function setAccname($value){
		$this->_acc = $value;
	}
	public function getDepname(){
		if ($this->_dep === null && $this->department !== null)
		{
			$this->_dep = $this->department->name;
		}
		return $this->_dep;
	}
	public function setDepname($value){
		$this->_dep = $value;
	}
	public function getExpname(){
		if ($this->_exp === null && $this->expence !== null)
		{
			$this->_exp = $this->expence->name;
		}
		return $this->_exp;
	}
	public function setExpname($value){
		$this->_exp = $value;
	}
	public function getUsername(){
		if ($this->_use === null && $this->users !== null)
		{
			$this->_use = $this->users->title;
		}
		return $this->_use;
	}
	public function setUsername($value){
		$this->_use = $value;
	}
	public function getConcertname(){
		if ($this->_con === null && $this->concert !== null)
		{
			$this->_con = $this->concert->name;
		}
		return $this->_con;
	}
	public function setConcertname($value){
		$this->_con = $value;
	}
	public function getCliname(){
		if ($this->_cli === null && $this->client !== null)
		{
			$this->_cli = $this->client->name;
		}
		return $this->_cli;
	}
	public function setCliname($value){
		$this->_cli = $value;
	}
	public function getCurname(){
		if ($this->_cur === null && $this->currency !== null)
		{
			$this->_cur = $this->currency->name;
		}
		return $this->_cur;
	}
	public function setCurname($value){
		$this->_cur = $value;
	}	
	public function getCityname(){
		if ($this->_city === null && $this->city !== null)
		{
			$this->_city = $this->city->name;
		}
		return $this->_city;
	}
	public function setCityname($value){
		$this->_city = $value;
	}
	public function getCountry(){
		if ($this->_cou === null && $this->client->country !== null)
		{
			$this->_cou = $this->client->country->name;
		}
		return $this->_cou;
	}
	public function setCountry($value){
		$this->_cou = $value;
	}
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Inc the static model class
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
		return 'inc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('client_id, department_id, expence_id, currency_id, date, account_id', 'required'),
			array('client_id, department_id, users_id, concert_id, expence_id, currency_id, city_id, account_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('name', 'length', 'max'=>64),
			array('link', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name,  curname, cliname, cityname,depname,expname,username,  accname, client_id, department_id, users_id, concert_id, expence_id, currency_id, amount, dateinserted, date, link, city_id, account_id', 'safe', 'on'=>'search'),
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
			'account' => array(self::BELONGS_TO, 'Account', 'account_id'),
			'client' => array(self::BELONGS_TO, 'Client', 'client_id'),
			'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
			'users' => array(self::BELONGS_TO, 'Users', 'users_id'),
			'concert' => array(self::BELONGS_TO, 'Concert', 'concert_id'),
			'expence' => array(self::BELONGS_TO, 'Expence', 'expence_id'),
			'currency' => array(self::BELONGS_TO, 'Currency', 'currency_id'),
			'city' => array(self::BELONGS_TO, 'City', 'city_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Инфо.',
			'client_id' => 'Контрагент',
			'department_id' => 'Отдел',
			'users_id' => 'Users',
			'expence_id' => 'Статья',
			'currency_id' => 'Валюта',
			'amount' => 'Сумма',
			'dateinserted' => 'Dateinserted',
			'date' => 'Дата',
			'link' => 'Документ',
			'city_id' => 'Город',
			'account_id' => 'Расчетный счет',
			'cliname' => 'Контрагент',
			'depname' => 'Отдел',
			'username' => 'User',
			'concert_id' => 'Концерт',
			'concertname' => 'Концерт',
			'expname' => 'Статья',
			'curname' => 'Валюта',
			'cityname' => 'Город',
			'accname' => 'Расчетный_счет',
			'country' => 'Страна',
		);
	}
	protected function beforeSave()
{
    if(parent::beforeSave())
    {
        if($this->isNewRecord)
              $this->users_id=Yii::app()->user->uid;
			 return true;
    }
    else
        return false;
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
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$sort           = new CSort;
		$criteria=new CDbCriteria;
        $criteria->with = array('currency','account','city','client','client.country','expence','department','concert','users');

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('client_id',$this->client_id);
		$criteria->compare('department_id',$this->department_id);
		$criteria->compare('users_id',$this->users_id);
		$criteria->compare('concert_id',$this->concert_id);
		$criteria->compare('expence_id',$this->expence_id);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('dateinserted',$this->dateinserted,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('currency.name', $this->curname, true);
		$criteria->compare('city.name', $this->cityname, true);
		$criteria->compare('client.name', $this->cliname, true);
		$criteria->compare('concert.name', $this->concertname, true);
		$criteria->compare('expence.name', $this->expname, true);
		$criteria->compare('department.name', $this->depname, true);
		$criteria->compare('users.title', $this->username, true);
		$criteria->compare('account.name', $this->accname, true);
		$criteria->compare('country.name', $this->country, true);
		$this->daterange($criteria);
		 $sort->defaultOrder= array(
            'date'=>CSort::SORT_ASC,
        );
		return new CActiveDataProvider($this,array(
            'pagination'=>array('pageSize'=>50),
            'criteria'=>$criteria,
            'sort'=>$sort,
		));
	}
}