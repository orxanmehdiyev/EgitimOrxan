<?php 
session_start();

unset($_SESSION['admin_giris']);
header("Location:login.php?durum=exit");




 ?>