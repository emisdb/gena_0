<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class FileForm extends CFormModel
{
    public $image;
 
    /**
     * Declares the validation rules.
     */
    public function rules()
    {
		return array(
			array('image', 'file', 'types'=>'xml','maxSize'=>10*1024*1024),
		);
    }

    public function attributeLabels()
    {
        return array(
            'image'=>'Файл загрузки (xml)',
        );
    }

}