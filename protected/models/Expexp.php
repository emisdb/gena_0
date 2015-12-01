<?php

/**
 * This is the model class for table "expexp".
 *
 * The followings are the available columns in table 'expexp':
 * @property integer $exp_id
 * @property integer $exp_expid
 *
 * The followings are the available model relations:
 * @property Exp $exp
 * @property Exp $expExp
 */
class Expexp extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Expexp the static model class
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
		return 'expexp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('exp_id, exp_expid', 'required'),
			array('exp_id, exp_expid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('exp_id, exp_expid', 'safe', 'on'=>'search'),
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
			'expExp' => array(self::BELONGS_TO, 'Exp', 'exp_expid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'exp_id' => 'Exp',
			'exp_expid' => 'Exp Expid',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('exp_id',$this->exp_id);
		$criteria->compare('exp_expid',$this->exp_expid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}