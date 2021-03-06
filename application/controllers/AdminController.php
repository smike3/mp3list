<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function preDispatch()
    {
	$url=$this->getRequest()->getRequestUri();
	$url=str_replace("/","",$url);
	echo $url;
	if($url!="adminlogin")
		if(!Zend_Auth::getInstance()->hasIdentity())
			{
			Zend_Auth::getInstance()->clearIdentity();
			Zend_Session::destroy();
			$this->_redirect('/admin/login/');
			}
    }

    public function indexAction()
    {
	//if(!Zend_Auth::getInstance()->hasIdentity()) $this->_redirect('/admin/login/');

    }

    public function loginAction()
    {
    $form=new My_Form_Login();
	$this->view->form=$form;
	if($this->getRequest()->isPost())
		{
		if($form->isValid($this->getRequest()->getPost()))
			{
			$values=$form->getValues();
			$adapter=new My_Auth_Adapter($values['username'],$values['password']);
			$auth=Zend_Auth::getInstance();
			if($auth->authenticate($adapter)->isValid())
				{
				echo "1";
				$session=new Zend_Session_Namespace('my_mp3');
				$session->user=$values['username'];
				//echo $session->requestURL;
				$this->_helper->getHelper('FlashMessenger')
					->addMessage('Удачный вход');
				$this->_redirect('/admin/login/success');
				}
			else $this->view->message="Ошибка авторизации";
			}
		}  
    }

    public function successAction()
    {
    if($this->_helper->getHelper('FlashMessenger')->getMessages()) $this->view->messages=$this->_helper->getHelper('FlashMessenger')->getMessages();
	else $this->_redirect('/');
    }

    public function logoutAction()
    {
    Zend_Auth::getInstance()->clearIdentity();
	Zend_Session::destroy();
	$this->_redirect('/admin/login');
    }

    public function mkbdAction()
    {
	$form=new My_Form_Mkbd();
	$this->view->form=$form;
	if($this->getRequest()->isPost())
		if($form->isValid($this->getRequest()->getPost()))
			{
		//	$crmp=new My_Mp3_Createbd();
			//$c=0;
		//	$ldir=array();
		//	$ldir=$crmp->fill_array_dir($c,"/home/smike/mp3s/",$ldir);
		//	$lmp=$crmp->fill_array_mp3($ldir);
			//$crmp->fill_bd_mp3($lmp);
	exec("php /home/smike/WWW/mp3list/library/My/Mp3/long_pr.php > /dev/null &");
		//	$crmp->fill_bd("/home/smike/2cd/",0);
		//	print_r($lmp);
			$this->_helper->getHelper('FlashMessenger')
					->addMessage('Генерация бд началась');
				$this->_redirect('/admin/mkbd/mkbdsuccess');
				}
			else $this->view->message="Ошибка старта генерации бд";
			
    }

    public function mkbdsuccessAction()
    {
      if($this->_helper->getHelper('FlashMessenger')->getMessages()) $this->view->messages=$this->_helper->getHelper('FlashMessenger')->getMessages();
	else $this->_redirect('/');
    }


}











