<?php

/**
 * This is the model class for table "inv_d".
 *
 * The followings are the available columns in table 'inv_d':
 * @property integer $inv
 * @property integer $id
 * @property integer $product
 * @property string $amount
 * @property string $price
 * @property string $vat
 * @property string $total
 *
 * The followings are the available model relations:
 * @property Inv $inv0
 * @property Product $product0
 */
class Invd extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'inv_d';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('inv, id, product', 'numerical', 'integerOnly'=>true),
			array('amount, price, vat, total', 'length', 'max'=>12),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('inv, id, product, amount, price, vat, total', 'safe', 'on'=>'search'),
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
			'inv0' => array(self::BELONGS_TO, 'Inv', 'inv'),
			'product0' => array(self::BELONGS_TO, 'Product', 'product'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'inv' => 'Inv',
			'id' => 'ID',
			'product' => 'Product',
			'amount' => 'Amount',
			'price' => 'Price',
			'vat' => 'Vat',
			'total' => 'Total',
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

		$criteria->compare('inv',$this->inv);
		$criteria->compare('id',$this->id);
		$criteria->compare('product',$this->product);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('vat',$this->vat,true);
		$criteria->compare('total',$this->total,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Invd the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
