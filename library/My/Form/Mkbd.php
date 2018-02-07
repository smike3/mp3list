<?php
class My_Form_Mkbd extends Zend_Form
{
public function init()
	{
	$this->setAction('/admin/mkbd')
		->setMethod('post');
	$submit=new Zend_Form_Element_Submit('submit_bd');
	$submit->setLabel('Сгенерировать бд')
		->setOptions(array('class'=>'submit_bd'));
	$this->addElement($submit);
	}
}