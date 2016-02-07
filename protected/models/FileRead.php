<?php
class FileRead extends CFormModel
{
    public $image;
    public $n_str;
    public $n_fin;
    public $n_nom;
    public $n_art;
    public $n_quant;
    public $n_price;
    public $department;
    public $client;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Country the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('image', 'file', 'types'=>'csv','maxSize'=>10*1024*1024),
			array('n_str,n_fin,n_nom,n_art,n_quant,n_price,department,client', 'required'),
			array('n_str,n_fin,n_nom,n_art,n_quant,n_price,department,client', 'numerical', 'integerOnly'=>true),
			array('n_str,n_fin,n_nom,n_art,n_quant,n_price,department,client', 'safe'),
		);
	}
 public function init()
  {
     $this->n_str = Constants::model()->getCvalue('nstr_'.Yii::app()->user->uid);
     $this->n_fin = Constants::model()->getCvalue('nfin_'.Yii::app()->user->uid);
     $this->n_nom = Constants::model()->getCvalue('nnom_'.Yii::app()->user->uid);
     $this->n_art = Constants::model()->getCvalue('nart_'.Yii::app()->user->uid);
     $this->n_quant = Constants::model()->getCvalue('nquant_'.Yii::app()->user->uid);
     $this->n_price = Constants::model()->getCvalue('nprice_'.Yii::app()->user->uid);
     $this->department = Constants::model()->getCvalue('dep_'.Yii::app()->user->uid);
     $this->client = Constants::model()->getCvalue('cli_'.Yii::app()->user->uid);
  }
  
	/**
	 * @return array relational rules.
	 */
    public function attributeLabels()
    {
        return array(
            'image'=>'Файл загрузки (csv)',
            'n_str'=>'Начальная строка',
            'n_fin'=>'Конечная строка',
            'n_nom'=>'Столбец номенклатуры',
            'n_art'=>'Столбец артикула',
            'n_quant'=>'Столбец суммы',
            'n_price'=>'Столбец цены',
           'department'=>'Наши организации',
           'client'=>'Контрагенты',
        );
    }
}