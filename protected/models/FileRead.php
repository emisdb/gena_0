<?php

/**
 * This is the model class for table "country".
 *
 * The followings are the available columns in table 'country':
 * @property integer $id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Client[] $clients
 */
class FileRead extends CActiveRecord
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
			array('image', 'file', 'types'=>'xml','maxSize'=>10*1024*1024),
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
            'image'=>'Файл загрузки (xml)',
            'n_str,n_fin,n_nom,n_art,n_quant,n_price'=>'Начальная строка',
            'n_str'=>'Начальная строка',
            'n_fin'=>'Конечная строка',
            'n_nom'=>'Столбец номенклатуры',
            'n_art'=>'Столбец артиккула',
            'n_quant'=>'Столбец количества',
            'n_price'=>'Столбец цены',
        );
    }
}