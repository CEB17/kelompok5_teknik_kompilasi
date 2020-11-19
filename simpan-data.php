<?php
//include 'config.php';
class led{
	 public $link='';
	 function __construct($kecerahan, $potensio){
	  $this->connect();
	  $this->updateDB($kecerahan, $potensio);
	  //$this->storeInDB($kecerahan, $potensio);
	 }
	 
	 function connect(){
	  $this->link = mysqli_connect('localhost','root','') or die('Cannot connect to the DB');
	  mysqli_select_db($this->link,'iot') or die('Cannot select the DB');
	 }
	 
	 /*
	 function storeInDB($kecerahan, $potensio){
	  $query = "insert into led set kecerahan='".$kecerahan."', potensio='".$potensio."'";
	  $result = mysqli_query($this->link,$query) or die('Errant query:  '.$query);
	 }*/
	 

	function updateDB($kecerahan, $potensio){
	//$id = $suhu["id"];
	$query = "UPDATE led set kecerahan='".$kecerahan."', potensio='".$potensio."' WHERE id = 1";
	//$query = "UPDATE led set kecerahan='".$kecerahan."', potensio='".$potensio."'"; //id diubah sesuai id yang sudah ada di database
	$result = mysqli_query($this->link,$query) or die('Errant query:  '.$query);
	}
	 
	}
	if($_GET['kecerahan'] != '' and $_GET['potensio'] != ''){
	$led=new led($_GET['kecerahan'],$_GET['potensio']);
	}
?>