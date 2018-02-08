<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
protected function _initLocale()
	{
	try{
		$locale=new Zend_Locale('browser');
		}
	catch(Zend_Locale_Exception $e)
		{
		$locale=new Zend_Locale('ru_RU');
		}
	$registry=Zend_Registry::getInstance();
	$registry->set('Zend_Locale',$locale);
	echo $locale->getLanguage();
	$translateValidators = array(
                       Zend_Validate_Alnum::INVALID=>'Недопустимое имя',
			Zend_Validate_Alnum::NOT_ALNUM=>'Недопустимые символы',
			Zend_Validate_Alnum::STRING_EMPTY=>'Пууустая строка',
			Zend_Validate_NotEmpty::IS_EMPTY => 'Пустая строка'
                    );
    $translator = new Zend_Translate('array', $translateValidators);
    Zend_Validate_Abstract::setDefaultTranslator($translator);
	}

}

