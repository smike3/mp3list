<?php
require_once('/usr/share/php/getid3/getid3.php');

class My_Mp3_Createbd
{
	
	private $c=0;
	private $ldir;
	private $lmp;
	

	public function fill_array_dir($c,$path_mp3,$list_dir)
	{
	$dir=array_diff(scandir($path_mp3),array('..','.'));
	foreach($dir as $cur)
		{
		$path_c=$path_mp3."/".$cur;
		if(is_dir($path_c)) 
			{
			$list_dir[$c++]=$path_c;
			$list_dir=$this->fill_array_dir($c,$path_c,$list_dir);
			}
		}	
	return $list_dir;
	}
	
	public function fill_array_mp3($list_dir)
	{
	$list_mp3=array();
	foreach($list_dir as $cur)
		{
		$list_mp3=array_merge(glob($cur."/*.mp3"),$list_mp3);
		}
	return $list_mp3;
	}
	public function clear_bd()
	{
	$sql=array("truncate table artist","truncate table title","truncate table album");
	$mys= new mysqli("localhost","smike","asdfg","php_test");
	if($mys->connect_errno)	die("<p>Ошибка подключения к БД:".$mys->connect_error."</p>");
	for($i=0;$i<3;$i++) $res=$mys->real_query($sql[$i]);
	$mys->close();
	}
	public function fill_bd_mp3($list_mp3,$album_flag)
	{
	
	$mys= new mysqli("localhost","smike","asdfg","php_test");
	if($mys->connect_errno)	die("<p>Ошибка подключения к БД:".$mys->connect_error."</p>");
	$id3 = new getID3;
	foreach($list_mp3 as $val)
		{
		$tag = $id3->analyze($val);
		if(array_key_exists('artist',$tag['tags']['id3v2'])
			and array_key_exists('title',$tag['tags']['id3v2'])
			and array_key_exists('album',$tag['tags']['id3v2'])
			and array_key_exists('year',$tag['tags']['id3v2'])
			and array_key_exists('track_number',$tag['tags']['id3v2'])
			)
			{
			/*echo $tag['tags']['id3v2']['title'][0]."<br>\n";
			echo $tag['tags']['id3v2']['album'][0]."<br>\n";
			echo $tag['tags']['id3v2']['year'][0]."<br>\n";
			echo $tag['tags']['id3v2']['artist'][0]."<br>\n";
			echo $tag['tags']['id3v2']['track_number'][0]."<br>\n";*/
			$track=explode("/",$tag['tags']['id3v2']['track_number'][0]);
			//echo $track[0];
		//	echo "select name,year from album where flag=".$album_flag." year=".$tag['tags']['id3v2']['year'][0]." and name=\"".$tag['tags']['id3v2']['album'][0]."\"<br>";
			//echo "insert into album (year,name,flag) values (".$tag['tags']['id3v2']['year'][0].",'".$tag['tags']['id3v2']['album'][0]."', ".$album_flag.")<br>";
			if($res=$mys->query("select name from artist where name=\"".$tag['tags']['id3v2']['artist'][0]."\""))
				if($res->num_rows==0) $res=$mys->real_query("insert into artist (name) values ('".$tag['tags']['id3v2']['artist'][0]."')");
			if($res=$mys->query("select name,year from album where flag=".$album_flag." and year=".$tag['tags']['id3v2']['year'][0]." and name=\"".$tag['tags']['id3v2']['album'][0]."\""))
				if($res->num_rows==0) $res=$mys->real_query("insert into album (year,name,flag) values (".$tag['tags']['id3v2']['year'][0].",'".$tag['tags']['id3v2']['album'][0]."', ".$album_flag.")");
			if($res=$mys->query("select artist.id,album.id from artist,album where artist.name=\"".$tag['tags']['id3v2']['artist'][0]."\" and album.name=\"".$tag['tags']['id3v2']['album'][0]."\""))
				if($res->num_rows==1)
					{
					$id=$res->fetch_row();
					if($res=$mys->query("select * from title where id_art=".$id[0]." and id_alb=".$id[1]." and title=\"".$tag['tags']['id3v2']['title'][0]."\" and track=".$track[0]))
						if($res->num_rows==0)
							{
						//	echo "!!!!!!!!!!!insert into title (id_art,id_alb,title,track) values ($id[0],$id[1],\"".$tag['tags']['id3v2']['title'][0]."\",".$track[0].")!!!!!!!<br>\n";
							$sql="insert into title (id_art,id_alb,title,track) values ($id[0],$id[1],\"".$tag['tags']['id3v2']['title'][0]."\",".$track[0].")";
							$res=$mys->real_query($sql);
							}
						//else echo "select * from title where id_art=".$id[0]." and id_alb=".$id[1]." and title=\"".$tag['tags']['id3v2']['title'][0]."\" and track=".$track[0]."<br>\n";
					}
			}
		}
	$mys->close();
	}
	public function fill_bd($path,$album_flag)
	{
	$this->ldir=$this->fill_array_dir($this->c,$path,$this->ldir);
	$this->lmp=$this->fill_array_mp3($this->ldir);
	$this->fill_bd_mp3($this->lmp,$album_flag);
	}
	public function clear()
	{
	$this->c=0;
	$this->ldir=array();
	$this->lmp=array();
	}
}