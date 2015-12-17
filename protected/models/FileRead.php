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
			array('n_str,n_fin,n_nom,n_art,n_quant,n_price', 'required'),
			array('n_str,n_fin,n_nom,n_art,n_quant,n_price', 'numerical', 'integerOnly'=>true),
			array('n_str,n_fin,n_nom,n_art,n_quant,n_price', 'safe'),
		);
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
            'n_quant'=>'Столбец количества',
            'n_price'=>'Столбец цены',
        );
    }
}