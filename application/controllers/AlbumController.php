<?php

class AlbumController extends Zend_Controller_Action
{

    public function init()
    {
       // $this->view->alb="ddddddddd";
    }

    public function preDispatch()
    {
	//$url=$this->getRequest()->getRequestUri();
	//echo $url;
    }

    public function indexAction()
    {
        $this->view->title = "Просмотр альбомов";
	$this->view->year="/album/year/";
	$this->view->artist="/album/artist/";
		//$this->view->alb="ddddddddd";
    //    $data=new Application_Model_AlbumModel();
	//	$r=$data->fetchAll();
	/*	foreach($r as $val)
			{
			foreach($val as $vall)
				{
		//		echo $vall;
		//		echo " ";
				}
		//	echo "<br>\n";
			}*/
	//	$this->view->alb=$r;
    }

    public function addAction()
    {
       
    }

    public function yearAction()
    {
	$page=$this->getRequest()->getParam('page');
	$data=new Application_Model_AlbumModel();
	if($page==0)
		{
		$r=$data->fetch_years();
		
		}
	else 
		{
		$r=$data->fetch_year($page);
		
		
		}
	$this->view->page=$page;
	$this->view->a_year=$r;
    }

    public function artistAction()
    {
	$page=$this->getRequest()->getParam('page');
    $data=new Application_Model_AlbumModel();
	if($page==0) $r=$data->fetch_artists();
	else
		{
		$r=$data->fetch_artist($page);
		
		}
	$this->view->page=$page;
	$this->view->a_artist=$r;
    }

    public function titleAction()
    {
        // action body
    }


}









