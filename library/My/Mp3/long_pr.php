<?php
require_once('/home/smike/WWW/mp3list/library/My/Mp3/Createbd.php');
$crmp=new My_Mp3_Createbd();
$file_path=array("/home/smike/2cd/","/home/smike/mp3s/","/home/smike/tmp/");
$crmp->clear_bd();
for($i=0;$i<3;$i++)
	{
	$crmp->clear();
	$crmp->fill_bd($file_path[$i],$i);
	}