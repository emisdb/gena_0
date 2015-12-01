<?php

/**
 * This is the model class for table "exp".
 *
 * The followings are the available columns in table 'exp':
 * @property integer $id
 * @property string $name
 * @property integer 
 * @property integer $department_id
 * @property integer $users_id
 
 * @property integer $currency_id
 * @property double $amount
 * @property string $dateinserted
 * @property string $date
 * @property integer $pay
 * @property integer $pub
 * @property integer $account_id
 * @property integer $transport
 * @property string $link

 *
 * The followings are the available model relations:
 * @property City $city
 * @property Client $client
 * @property Department $department
 * @property Users $users
 * @property Concert $concert
 * @property Expence $expence
 * @property Currency $currency
 * @property Pay[] $pays
 */
class Exp extends CActiveRecord
{
	public $from_date;
	public $to_date;
	public $state_pay;
	public $state_cur=false;
	public $arr_cur=array();
	private $null_dg;
	
	private $_cur = null;
	private $_cli = null;
	private $_dep = null;
	private $_use = null;
	private $_cou = null;
	private $mutex =false;
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
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Exp the static model class
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
		return 'exp';
	}
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('client_id, department_id,  currency_id,  date', 'required'),
			array('client_id, department_id, users_id, currency_id, pay', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('name', 'length', 'max'=>64),
			array('link', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, curname,country, cliname, depname,username, name, client_id, account_id, department_id, users_id, currency_id, amount, dateinserted, date, pay, state_pay, link, from_date, paySum,invSum, to_date, pub, transport', 'safe', 'on'=>'search'),
		);
	}
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'rtransport' => array(self::BELONGS_TO, 'Client', 'transport'),
			'client' => array(self::BELONGS_TO, 'Client', 'client_id'),
			'account' => array(self::BELONGS_TO, 'Account', 'account_id'),
			'expd' => array(self::HAS_MANY, 'Expd', 'exp'),
			'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
			'users' => array(self::BELONGS_TO, 'Users', 'users_id'),
			'currency' => array(self::BELONGS_TO, 'Currency', 'currency_id'),
			'pays' => array(self::HAS_MANY, 'Pay', 'exp_id'),
			'paySum'=>array(self::STAT, 'Pay', 'exp_id', 'select'=> 'SUM(amount)'),
			'paySumg'=>array(self::STAT, 'Pay', 'exp_id', 'select'=> 'SUM(amount)','condition'=>'date_g IS NOT NULL'),
			'payCount'=>array(self::STAT, 'Pay', 'exp_id'),
			'payCountg'=>array(self::STAT, 'Pay', 'exp_id','condition'=>'date_g IS NOT NULL'),
			'invs' => array(self::HAS_MANY, 'Inv', 'exp_id'),
			'invDate' => array(self::HAS_ONE, 'Inv', 'exp_id', 'select'=>'invDate.date','order'=>'invDate.date DESC'),
			'invSum'=>array(self::STAT, 'Inv', 'exp_id', 'select'=> 'SUM(amount)'),
			'expSum'=>array(self::STAT, 'Expd', 'exp', 'select'=> 'SUM(amount*price)'),
			'expTot'=>array(self::STAT, 'Expd', 'exp', 'select'=> 'SUM(total)'),
			'invCount'=>array(self::STAT, 'Inv', 'exp_id'),

	);
	}
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Номер',
			'client_id' => 'Контрагент',
			'department_id' => 'Фирма',
			'depname' => 'Фирма',
                        'users_id' => 'Пользователь',
			'cliname' => 'Контрагент',

			'username' => 'User',
			'curname' => 'Валюта',
			'country' => 'Страна',
			'currency_id' => 'Валюта',
			'amount' => 'Сумма',
			'dateinserted' => 'Введен',
			'date' => 'Дата',
			'pay' => 'Опл.',
			'link' => 'Документ',
			'state_pay' => 'Состояние оплат',
			'state_cur' => 'По всем валютам',
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
	protected function afterSave()
	{
		parent::afterSave();
		if($this->mutex) return;
	    if(!$this->isNewRecord) $this->doPay();
	}

public function doPay()
{
	$pSum=$this->paySum;
	$aSum=$this->amount;

	if($this->pay==3)
	{
		if(!($pSum<$aSum)) $this->pay=1;//covered by payment
		else if($pSum>0) $this->pay=2;
	}
	else
	{
		if($pSum==0) $this->pay=0;//not paid
		else if ($pSum<$aSum) $this->pay=2;//partially
		else $this->pay=1;//paid
	}
	$this->mutex=true;
	$this->save(false);
}

 private function GetRate($curid)
{
		if($this->state_cur)
		{
			foreach($this->arr_cur as $row) 
			{ if($curid==$row['id'])
				return (float)$row['rate'];
			};
			return 0;
		}
		else
			return 1;
	
}
 public function invsum($data, $row)
{
     if($data->invCount>0)
    {
//         $str=  print_r($data->invDate,true);
//         return $str;
//      	$str="<div id='payid".$data->id."' class='pay".$data->pay."'>".$data->invSum."</div>";
      	$str="<div id='payid".$data->id."'><span class='invc'>".$data->invCount."</span>";
     	$str.="<span class='invd'>".Yii::app()->dateFormatter->formatDateTime($data->invDate->date, 'short', null)."</span>";
        $str.="</div>";
        $link=CHtml::ajaxLink(
             $str,
             $url=array('ajaxInv'),
             $ajaxOptions= array(
            'data'=>array('val_id'=>'js:$(this).attr("href")'),
              'type'=>'POST',
             'update'=>'#pay_table',
             'complete' => 'function() {$("#accountsdialog").dialog("open");}',	  
         //						'complete' => 'function() {doshowpay(this);}'	  
             'beforeSend' => 'doshowpay(this)'	        ),
             $htmlOptions=array('href'=>'js:_id='.$data->id.';_pay=500;')
     );
           return "<div>".Yii::app()->numberFormatter->formatCurrency($data->invSum, '')."</div>".$link;
    }
      else
          return "";
}
 public function paysum($data, $row)
{
 //     if (($data->pay==0)||($data->pay==3))
//         $link='';
     if( Yii::app()->Controller->permit>2)
     {
     $linkgo=CHtml::ajaxLink(
             "<span class='pay1'>___</span>",
             $url=array('pay/CreateID'),
             $ajaxOptions= array(
            'data'=>array('val_id'=>'js:$(this).attr("href")'),
             'type'=>'POST',
             'update'=>'#paytable',
             'complete' => 'function() {$("#mydialog").dialog("open");}',	  
         //						'complete' => 'function() {doshowpay(this);}'	  
             'beforeSend' => 'doshowpay(this)'	        ),
             $htmlOptions=array('href'=>'js:_id='.$data->id.';_pay=200;',
//                 'onclick'=>'dochangepay('.$data->id.','.$data->pay.')',
                 )
     );
     }
     else $linkgo='';
     if($data->payCount>0)
    {
//      	$str="<div id='payid".$data->id."' class='pay".$data->pay."'>".$data->invCount."</div>";
      	$str="<span class='payc'>".$data->payCount."</span>";
      	$str.="<span class='payg'>".$data->payCountg."</span>";
        $link=CHtml::ajaxLink(
             $str,
             $url=array('ajaxReq'),
             $ajaxOptions= array(
            'data'=>array('val_id'=>'js:$(this).attr("href")'),
              'type'=>'POST',
             'update'=>'#pay_table',
             'complete' => 'function() {$("#accountsdialog").dialog("open");}',	  
         //						'complete' => 'function() {doshowpay(this);}'	  
             'beforeSend' => 'doshowpay(this)'	        ),
             $htmlOptions=array('href'=>'js:_id='.$data->id.';_pay='.$data->pay.';')
     );
           return "<div>".Yii::app()->numberFormatter->formatCurrency($data->paySum, '')."</div>"
                   ."<div id='payid".$data->id."'>".$link.$linkgo."</div>";
    }
      else
          return $linkgo;
}
 public function nameic($data, $row)
{
        $link=CHtml::ajaxLink(
             $data->name,
             $url=array('ajaxExpd'),
             $ajaxOptions= array(
            'data'=>array('val_id'=>'js:$(this).attr("href")'),
              'type'=>'POST',
             'update'=>'#pay_table',
             'complete' => 'function() {$("#accountsdialog").dialog("open");}',	  
         //						'complete' => 'function() {doshowpay(this);}'	  
             'beforeSend' => 'doshowpay(this)'	        ),
             $htmlOptions=array('href'=>'js:_id='.$data->id.';_pay=100;')
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
                                                     FROM `exp` where id in (".$ids.")");
                }
               else if($what==1)
                {
                $command=$connection->createCommand("SELECT SUM(`pay`.amount)
                                                     FROM `exp` INNER JOIN `pay` ON `pay`.exp_id=`exp`.id
                                                     where `exp`.id in (".$ids.")");
                }
               else if($what==2)
                {
                $command=$connection->createCommand("SELECT SUM(`inv`.amount)
                                                     FROM `exp` INNER JOIN `inv` ON `inv`.exp_id=`exp`.id
                                                     where `exp`.id in (".$ids.")");
                
                }
                return Yii::app()->numberFormatter->formatCurrency($command->queryScalar(),'');
        }

public function picpay($data, $row)
{
	return "<div id='payid".$data->id.
			"' class='pay".$data->pay.
			"' onclick='dochangepay(".$data->id.",".$data->pay.")'></div>";
}
 public function paycount($data, $row)
{
	return $data->payCount;
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
private function paystate($criteria)
{	
                    if($this->state_pay==1)
                  {
                     $payment_table   = Pay::model()->tableName();
                   $paid_status_sql = "(select CASE WHEN (select sum(amount) from $payment_table where $payment_table.exp_id = t.id) >0 THEN 1 ELSE 0 END)";
                  }
                   else if($this->state_pay==2)
                  {
                    $payment_table   = Pay::model()->tableName();
                      $paid_status_sql = "(select CASE WHEN ((t.amount>(select sum(amount) from $payment_table where $payment_table.exp_id = t.id))OR((select sum(amount) from $payment_table where $payment_table.exp_id = t.id)IS NULL)) THEN 2 ELSE 0 END)";
                  }
                  else if($this->state_pay==3)
                  {
                     $payment_table   = Inv::model()->tableName();
                     $paid_status_sql = "(select CASE WHEN (select sum(amount) from $payment_table where $payment_table.exp_id = t.id) >0 THEN 3 ELSE 0 END)";
                  }
                   else if($this->state_pay==4)
                  {
                    $payment_table   = Inv::model()->tableName();
                       $paid_status_sql = "(select CASE WHEN ((t.amount>(select sum(amount) from $payment_table where $payment_table.exp_id = t.id))OR((select sum(amount) from $payment_table where $payment_table.exp_id = t.id)IS NULL)) THEN 4 ELSE 0 END)";
                  }
 
                   $criteria->select = array(
                        '*',
                        $paid_status_sql." as state_pay",
                    );
//                        $criteria->addCondition(" (".$paid_status_sql.") =".$this->state_pay);
                      $criteria->compare($paid_status_sql, $this->state_pay); 
}
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function Makewhere($tab)
	{
        	$ret="";
		if(!empty($this->from_date) && empty($this->to_date))
                {
                    $ret="($tab.date >= '$this->from_date')";  
                                // date is database date column field
                }
                        elseif(!empty($this->to_date) && empty($this->from_date))
                {
                    $ret="($tab.date <= '$this->to_date')";
                }
                        elseif(!empty($this->to_date) && !empty($this->from_date))
                {
                    $ret="($tab.date  >= '$this->from_date' and $tab.date <= '$this->to_date')";
                }
		
		if(strlen($ret)>0) return $ret;
	}
	public function report()
	{
	$qry="SELECT client_id, cliname, SUM(exppay.expsum) AS expsum, SUM(exppay.paysum) AS paysum, SUM(exppay.invsum) AS invsum FROM ".
        " (SELECT client_id, client.name  AS cliname, SUM(exp.amount) AS expsum, 0 AS paysum, 0 AS invsum ".
        " FROM exp INNER JOIN client ON exp.client_id=client.id".
        " WHERE (".$this->Makewhere('exp').") GROUP BY client_id, client.name".
	"  UNION ALL SELECT client_id, client.name  AS cliname, 0 AS expsum, SUM(pay.amount) AS paysum, 0 AS invsum ".
        " FROM pay INNER JOIN (exp INNER JOIN client ON exp.client_id=client.id) ON pay.exp_id=exp.id WHERE (".$this->Makewhere('pay').")".
	"  GROUP BY client_id, client.name  UNION ALL SELECT client_id, client.name  AS cliname, 0 AS expsum, 0 AS paysum, SUM(inv.amount) AS invsum ".
        " FROM inv INNER JOIN (exp INNER JOIN client ON exp.client_id=client.id) ON inv.exp_id=exp.id WHERE (".$this->Makewhere('inv').")"
        . " GROUP BY client_id, client.name) AS exppay GROUP BY client_id, cliname ORDER BY cliname";
	$dataReader=Yii::app()->db->createCommand($qry)->query();
	$cols=array(); $num=0;$pos=array();
	return $dataReader;

	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$sort           = new CSort;
		$criteria=new CDbCriteria;
                 
                // where
                $criteria->with = array('currency','client','client.country','department','users','invDate');

		$criteria->compare('id',$this->id);
//		$criteria->compare('pub',$this->pub);
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('client_id',$this->client_id);
		$criteria->compare('department_id',$this->department_id);
//		$criteria->compare('users_id',$this->users_id);
//		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('amount',$this->amount);
//		$criteria->compare('dateinserted',$this->dateinserted,true);
		$criteria->compare('pay',$this->pay);
//		$criteria->compare('link',$this->link,true);
//		$criteria->compare('date',$this->date,true);
//		$criteria->compare('currency.name', $this->curname, true);
		$criteria->compare('client.name', $this->cliname, true);
		$criteria->compare('department.name', $this->depname, true);
//		$criteria->compare('users.title', $this->username, true);
//		$criteria->compare('country.name', $this->country, true);
		$this->daterange($criteria);
                if($this->state_pay>0)
                {
                   if($this->state_pay<5)
                   {
                        $criteria->compare('pub',1);
        		$this->paystate($criteria);
                   }
                 }
                else
                {
              		$criteria->compare('pub',1);
                }
//		$this->paystate($criteria);
/**/		
		 $sort->defaultOrder= array(
            'date'=>CSort::SORT_ASC,
        );
		return new CActiveDataProvider($this,array(
//            'pagination'=>array('pageSize'=>100),
            'pagination'=>false,
            'criteria'=>$criteria,
            'sort'=>$sort,
		));
	}

}