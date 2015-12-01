<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $ckey
 * @property string $tnam
 * @property integer $cgr
 * @property integer $it
 *
 * The followings are the available model relations:
 * @property ExpD[] $expDs
 * @property InvD[] $invDs
 * @property Item $it0
 * @property ProductGroup $cgr0
 * @property ProductId[] $products
 */
class Product extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cgr, it', 'numerical', 'integerOnly'=>true),
			array('tnam', 'length', 'max'=>102),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ckey, tnam, cgr, it', 'safe', 'on'=>'search'),
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
			'expDs' => array(self::HAS_MANY, 'ExpD', 'product'),
			'invDs' => array(self::HAS_MANY, 'InvD', 'product'),
			'it0' => array(self::BELONGS_TO, 'Item', 'it'),
			'cgr0' => array(self::BELONGS_TO, 'ProductGroup', 'cgr'),
			'products' => array(self::HAS_MANY, 'ProductId', 'id'),
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
			'it' => 'It',
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

		$criteria->compare('ckey',$this->ckey);
		$criteria->compare('tnam',$this->tnam,true);
		$criteria->compare('cgr',$this->cgr);
		$criteria->compare('it',$this->it);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
