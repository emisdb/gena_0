<?php

/**
 * This is the model class for table "tmp_doc".
 *
 * The followings are the available columns in table 'tmp_doc':
 * @property integer $id
 * @property string $ckey
 * @property integer $ctype
 * @property string $tnum
 * @property string $cfir
 * @property integer $state
 * @property string $ddat
 * @property string $ccli
 * @property string $bsum
 * @property string $tonum
 * @property string $dodat
 * @property integer $docid
 * @property string $docinfo
 * @property string $cliname
 * @property string $firname
 * @property integer $expid
 * @property string $expinfo
 *
 * The followings are the available model relations:
 * @property TmpDocd $tmpDocd
 */
class TmpDoc extends CActiveRecord
{
	private $_cou = null;
	public function getEdited(){
		return $this->_cou;
	}
	public function setEdited($value){
		$this->_cou = $value;
	}	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tmp_doc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id, ctype, state, docid, expid', 'numerical', 'integerOnly'=>true),
			array('ckey, tnum, cfir, ccli, tonum', 'length', 'max'=>15),
			array('bsum', 'length', 'max'=>12),
			array('docinfo, cliname, firname, expinfo', 'length', 'max'=>255),
			array('ddat, dodat', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ckey, ctype, tnum, cfir, state, ddat, ccli, bsum, tonum, dodat, docid, docinfo, cliname, firname, expid, expinfo', 'safe', 'on'=>'search'),
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
			'tmpDocd' => array(self::HAS_ONE, 'TmpDocd', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ckey' => 'Номер',
			'ctype' => 'Ctype',
			'tnum' => 'Номер',
			'cfir' => 'Фирма',
			'state' => 'State',
			'ddat' => 'Дата',
			'ccli' => 'Клиент',
			'bsum' => 'Сумма',
			'tonum' => 'Счет',
			'dodat' => 'Дата',
			'docid' => '№',
			'docinfo' => 'Накл.',
			'cliname' => 'Клиент',
			'firname' => 'Фирма',
			'expid' => '№',
			'expinfo' => 'Счет',
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
		$criteria->compare('ckey',$this->ckey,true);
		$criteria->compare('ctype',$ctype);
		$criteria->compare('tnum',$this->tnum,true);
		$criteria->compare('cfir',$this->cfir,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('ddat',$this->ddat,true);
		$criteria->compare('ccli',$this->ccli,true);
		$criteria->compare('bsum',$this->bsum,true);
		$criteria->compare('tonum',$this->tonum,true);
		$criteria->compare('dodat',$this->dodat,true);
		$criteria->compare('docid',$this->docid);
		$criteria->compare('docinfo',$this->docinfo,true);
		$criteria->compare('cliname',$this->cliname,true);
		$criteria->compare('firname',$this->firname,true);
		$criteria->compare('expid',$this->expid);
		$criteria->compare('expinfo',$this->expinfo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                       'pagination'=>false,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TmpDoc the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
