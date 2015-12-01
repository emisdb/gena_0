<?php

/**
 * This is the model class for table "tmp_xml".
 *
 * The followings are the available columns in table 'tmp_xml':
 * @property integer $id
 * @property string $ckey
 * @property integer $ctype
 * @property string $cname
 * @property integer $lid
 * @property string $lname
 * @property integer $state
 */
class TmpXml extends CActiveRecord
{
   private $filepath;
   /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tmp_xml';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
//			array('ckey, ctype, cname, lid, lname, state', 'required'),
			array('ctype, lid, state, user', 'numerical', 'integerOnly'=>true),
			array('ckey', 'length', 'max'=>15),
			array('cname, lname', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ckey, cgr, ctype, cname, lid, lname, state', 'safe', 'on'=>'search'),
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
			'productid' => array(self::BELONGS_TO, 'ProductId', 'ckey',
                            'on'=>'t.ctype=0',
                            'with'=>array('product1')),
			'clientid' => array(self::BELONGS_TO, 'ClientId', 'ckey',
                            'on'=>'t.ctype=1',
                            'with'=>array('client1')),
			'departmentid' => array(self::BELONGS_TO, 'DepartmentId', 'ckey',
                            'on'=>'t.ctype=2',
                            'with'=>array('department1')),
			'productgroupid' => array(self::BELONGS_TO, 'ProductgroupId', 'ckey',
                            'on'=>'t.ctype=3',
                            'with'=>array('productgroup1')),
			'countryid' => array(self::BELONGS_TO, 'CountryId', 'ckey',
                            'on'=>'t.ctype=4',
                            'with'=>array('country1')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '№',
			'ckey' => 'Код',
			'ctype' => 'Ctype',
			'cname' => 'Наименование',
			'lid' => 'ID',
			'lname' => 'Найден',
			'state' => 'State',
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
	public function search($ctype=0)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user',Yii::app()->user->uid);
		$criteria->compare('ckey',$this->ckey,true);
		$criteria->compare('ckey',$this->cgr,true);
		$criteria->compare('ctype',$ctype);
		$criteria->compare('cname',$this->cname,true);
		$criteria->compare('lid',$this->lid);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('state',$this->state);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>false,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TmpXml the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
