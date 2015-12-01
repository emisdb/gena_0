<?php

/**
 * This is the model class for table "tmp_docd".
 *
 * The followings are the available columns in table 'tmp_docd':
 * @property integer $id
 * @property integer $ckey
 * @property string $cnom
 * @property integer $state
 * @property string $bsum
 * @property string $bqua
 * @property string $bvat
 * @property string $bpri
 *
 * The followings are the available model relations:
 * @property TmpDoc $id0
 */
class TmpDocd extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tmp_docd';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ckey, user', 'required'),
			array('id, ckey, state', 'numerical', 'integerOnly'=>true),
			array('cnom', 'length', 'max'=>15),
			array('bsum, bqua, bvat, bpri', 'length', 'max'=>12),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ckey, cnom, state, bsum, bqua, bvat, bpri', 'safe', 'on'=>'search'),
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
			'id0' => array(self::BELONGS_TO, 'TmpDoc', 'id'),
			'nom' => array(self::HAS_ONE, 'TmpXml', array('ckey'=>'cnom')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ckey' => 'Ckey',
			'cnom' => 'Cnom',
			'state' => 'State',
			'bsum' => 'Bsum',
			'bqua' => 'Bqua',
			'bvat' => 'Bvat',
			'bpri' => 'Bpri',
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
		$criteria->with=array('nom');		

		$criteria->compare('id',$this->id);
//		$criteria->compare('t.user',Yii::app()->user->uid);
		$criteria->compare('ckey',$this->ckey);
		$criteria->compare('cnom',$this->cnom,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('bsum',$this->bsum,true);
		$criteria->compare('bqua',$this->bqua,true);
		$criteria->compare('bvat',$this->bvat,true);
		$criteria->compare('bpri',$this->bpri,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TmpDocd the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
