<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class FileForm extends CFormModel
{
    public $image;
    public $n_str;
    public $n_fin;
    public $n_nom;
    public $n_art;
    public $n_quant;
    public $n_price;
    


    /**
     * Declares the validation rules.
     */
    public function rules()
    {
		return array(
			array('image', 'file', 'types'=>'xml','maxSize'=>10*1024*1024),
			array('n_str,n_fin,n_nom,n_art,n_quant,n_price', 'numerical', 'integerOnly'=>true),
			array('n_str,n_fin,n_nom,n_art,n_quant,n_price', 'safe'),
		);
    }

    public function attributeLabels()
    {
        return array(
            'image'=>'Файл загрузки (xml)',
        );
    }

}