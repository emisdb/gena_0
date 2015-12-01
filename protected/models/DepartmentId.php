<?php

/**
 * This is the model class for table "department_id".
 *
 * The followings are the available columns in table 'department_id':
 * @property string $ckey
 * @property integer $db
 * @property integer $id
 *
 * The followings are the available model relations:
 * @property Department $id0
 */
class DepartmentId extends CActiveRecord
{
	private $_dep = null;
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
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'department_id';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ckey, db, id', 'required'),
			array('db, id', 'numerical', 'integerOnly'=>true),
			array('ckey', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ckey, db, id', 'safe', 'on'=>'search'),
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
			'department' => array(self::BELONGS_TO, 'Department', 'id'),
			'department1' => array(self::BELONGS_TO, 'Department', 'id','condition'=>'departmentid.db=1'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ckey' => 'Ckey',
			'db' => 'Db',
			'id' => 'ID',
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

		$criteria=new CDbCriteria;

		$criteria->compare('ckey',$this->ckey,true);
		$criteria->compare('db',$this->db);
		$criteria->compare('id',$this->id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DepartmentId the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
