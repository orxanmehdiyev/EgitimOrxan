<?php 
ob_start();
session_start();
require_once "../nedmin/baglan.php";
require_once 'fonksiyon.php';

$ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id=:id");
$ayarsor->execute(array(
  'id'=> 0
));
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);

$admin_giris=$_SESSION['admin_giris'];
$adminsor=$db->prepare("SELECT * FROM admin where admin_istifateci_ad=:admin_istifateci_ad or admin_mail=:admin_mail");
$adminsor->execute(array(
  'admin_istifateci_ad'=>$admin_giris,
  'admin_mail'=>$admin_giris
));
$adminsay=$adminsor->rowCount();
$admincek=$adminsor->fetch(PDO::FETCH_ASSOC);
if ($adminsay==0) {
  header("Location:login.php?durum=izinsiz");
  exit;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="<?php echo $ayarcek['ayar_description'] ?>">
  <meta name="keywords" content="<?php echo $ayarcek['ayar_keywords'] ?>">
  <meta name="author" content="<?php echo $ayarcek['ayar_author'] ?>">


  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">


  <title><?php echo $ayarcek['ayar_title'] ?></title>
  <script src="ckeditor/ckeditor.js"></script><!--ckeditor dosyaları  bu  dosya ile aynı  dizinde-->
  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
   <!-- Datatables -->
  <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.css" rel="stylesheet">
  <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap-wysiwyg -->
  <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
  <!-- Select2 -->
  <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
  <!-- Switchery -->
  <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
  <!-- starrr -->
  <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
  <!-- bootstrap-daterangepicker -->
  <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
 <link href="../vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="../build/css/custom.css" rel="stylesheet">
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.php" class="site_title"> <span style="font-family: Edwardian Script ITC;
            font-size: 40px;"><?php  echo $ayarcek['ayar_logo_soz']; ?></span></a>
          </div>
       

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="images/adminprofil/<?php
                  if(strlen($admincek['admin_profil_img'])>0){
                     echo $admincek['admin_profil_img'];
                    }else{
                      echo'img.png';
                    }
 ?>" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Xoş gəldin,</span>
              <h2><?php echo $admincek['admin_ad_soyad'] ?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />