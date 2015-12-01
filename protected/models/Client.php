<?php

/**
 * This is the model class for table "client".
 *
 * The followings are the available columns in table 'client':
 * @property integer $id
 * @property string $name
 * @property integer $country_id
 *
 * The followings are the available model relations:
 * @property Country $country
 * @property ClientId[] $clients
 * @property ClientProp[] $clientProps
 * @property Exp[] $exps
 * @property Inc[] $incs
 */
class Client extends CActiveRecord
{
	private $_cou = null;
	public function getCountryname(){
		if ($this->_cou === null && $this->country !== null)
		{
			$this->_cou = $this->country->name;
		}
		return $this->_cou;
	}
	public function setCountryname($value){
		$this->_cou = $value;
	}	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'client';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, country_id', 'required'),
			array('country_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, country_id, countryname', 'safe', 'on'=>'search'),
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
			'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
			'clients' => array(self::HAS_MANY, 'ClientId', 'id'),
			'clientProps' => array(self::HAS_MANY, 'ClientProp', 'id'),
			'exps' => array(self::HAS_MANY, 'Exp', 'client_id'),
			'incs' => array(self::HAS_MANY, 'Inc', 'client_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '№',
			'name' => 'Название',
			'country_id' => 'Страна',
			'countryname' => 'Страна',
		);
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
       $criteria->with = 'country';
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('country.name', $this->countryname, true);
		 $sort->defaultOrder= array(
            'name'=>CSort::SORT_ASC,
        );


		return new CActiveDataProvider($this, array(
            'pagination'=>array('pageSize'=>50),
            'criteria'=>$criteria,
            'sort'=>$sort,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Client the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
