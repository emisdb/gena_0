<?php

/**
 * This is the model class for table "constants".
 *
 * The followings are the available columns in table 'constants':
 * @property string $_key
 * @property string $_value
 */
class Constants extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Constants the static model class
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
		return 'constants';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
//			array('_key, _value', 'required'),
			array('_key', 'required'),
			array('_key', 'length', 'max'=>8),
			array('_value', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('_key, _value', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'_key' => 'Key',
			'_value' => 'Value',
		);
	}
	public function getCvalue($key)
	{
		$this->_key=$key;
		$model=$this->find("_key='".$key."'");
		if($model===null)	return "";
		else return $model->_value;

	}
	public function delCvalue($key)
	{
		$this->_key=$key;
		$model=$this->find("_key='".$key."'");
		if($model!==null) $model->delete();
	}
	public function setCvalue($key,$value)
	{
		$this->_key=$key;
		$model=$this->find("_key='".$key."'");
		if($model===null)
		{
			$model= new Constants;
			$model->setAttribute('_key',$key);
			$model->setAttribute('_value',$value);
			$model->save();
		}
		else 
		{
			$model->setAttribute('_value',$value);
			$model->save();
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

		$criteria=new CDbCriteria;

		$criteria->compare('_key',$this->_key,true);
		$criteria->compare('_value',$this->_value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}