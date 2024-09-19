<?php 
session_start();

unset($_SESSION['kullanici_giris']);
header("Location:index?durum=exit");




 ?>