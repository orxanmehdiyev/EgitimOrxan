<?php 
try{
$db=new PDO("mysql:host=localhost;dbname=orxan;charset=utf8",'root','13041987');
//echo "baglant; basarili";
}
catch(PDOExpception $e){
	echo $e->getMessage();
 }
 ?>
