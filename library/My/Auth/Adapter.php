<?php
class My_Auth_Adapter implements Zend_Auth_Adapter_Interface
{
public function __construct($username,$password)
	{
	$this->username=$username;
	$this->password=$password;
	}
public function authenticate()
	{
	if($this->username=="smike" and $this->password=="123")	return new Zend_Auth_Result(Zend_Auth_Result::SUCCESS,$this->username,array());
	else return new Zend_Auth_Result(Zend_Auth_Result::FAILURE,null,array('Не успешная авторизация'));
	}
}