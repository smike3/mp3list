<?php
class My_Form_Login extends Zend_Form
{
public function init()
	{
	$this->setAction('/admin/login')
		->setMethod('post');
	$username=new Zend_Form_Element_Text('username');
	$username->setLabel('Имя пользователя:')
		->setOptions(array('size'=>'30'))
		->setRequired(true)
	/*	->setErrorMessages(array('isEmpty'=>'Пустая строка',
			'alnumInvalid'=>'Недопустимое имя',
			'notAlnum'=>'Недопустимые символы',
			'alnumStringEmpty'=>'Пууустая строка' ))*/
		/*->addValidator('Alnum',false,array('messages'=>array(Zend_Validate_Alnum::INVALID=>'Недопустимое имя',
			Zend_Validate_Alnum::NOT_ALNUM=>'Недопустимые символы',
			Zend_Validate_Alnum::STRING_EMPTY=>'Пууустая строка')))*/
		//	Zend_Validate_NotEmpty::IS_EMPTY => 'Пустая строка')))
		->addValidator('Alnum',false)
		->addFilter('HtmlEntities')
		->addFilter('StringTrim');
	$password=new Zend_Form_Element_Password('password');
	$password->setLabel('Пароль:')
		->setOptions(array('size'=>'30'))
		->setRequired(true)
		->setErrorMessages(array('isEmpty'=>'Пустая строка'))
		->addFilter('HtmlEntities')
		->addFilter('StringTrim');
	$submit=new Zend_Form_Element_Submit('submit');
	$submit->setLabel('Войти')
		->setOptions(array('class'=>'submit'));
	$this->addElement($username)
		->addElement($password)
		->addElement($submit);
	$this->addDisplayGroup(array('username','password','submit'),'login');
	$this->getDisplayGroup('login')
		->setOrder(10)
		->setLegend('Авторизация');
	}
}
