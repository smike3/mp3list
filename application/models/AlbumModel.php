<?php

class Application_Model_AlbumModel
{
protected $mys;
public function __construct()
	{
	$this->mys=new mysqli("localhost","smike","asdfg","php_test");
	//print_r($this->mys->connect_errno);
	//print_r($this->mys->connect_error);
//	if($this->mys->connect_errno)	die("<p>Ошибка подключения к БД:".$this->mys->connect_error."</p>");

	}
public function fetchAll()
	{
	$sql="select * from album";
	//if($res)
	if($res=$this->mys->query($sql))
		for($c=0;$c<$res->num_rows;$c++)
			{
			$res->data_seek($c);
			$add_tr=$res->fetch_row();
			for($cc=0;$cc<3;$cc++) $ret_arr[$c][$cc]=$add_tr[$cc];
		//	echo "<p>";
			}
	return $ret_arr;
	}
}

