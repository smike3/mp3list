<?php

class AlbumController extends Zend_Controller_Action
{

    public function init()
    {
       // $this->view->alb="ddddddddd";
    }

    public function preDispatch()
    {
	$url=$this->getRequest()->getRequestUri();
	echo $url;
    }

    public function indexAction()
    {
        $this->view->title = "Просмотр альбомов";
		//$this->view->alb="ddddddddd";
        $data=new Application_Model_AlbumModel();
		$r=$data->fetchAll();
	/*	foreach($r as $val)
			{
			foreach($val as $vall)
				{
		//		echo $vall;
		//		echo " ";
				}
		//	echo "<br>\n";
			}*/
		$this->view->alb=$r;
    }

    public function addAction()
    {
       
    }


}



