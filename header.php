<?php 
ob_start();
session_start();
require_once "admin/nedmin/baglan.php";
require_once "admin/production/fonksiyon.php";





$ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id=:id");
$ayarsor->execute(array(
  'id'=> 0
));
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);


$kullanici_giris=$_SESSION['kullanici_giris'];
$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_ad=:kullanici_ad or kullanici_mail=:kullanici_mail");
$kullanicisor->execute(array(
  'kullanici_ad'=>$kullanici_giris,
  'kullanici_mail'=>$kullanici_giris
));
$kullanicisay=$kullanicisor->rowCount();

$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);


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

  <!-- Font awesome -->
  <link href="css/font-awesome.css" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="css/bootstrap.css" rel="stylesheet">   
  <!-- SmartMenus jQuery Bootstrap Addon CSS -->
  <link href="css/jquery.smartmenus.bootstrap.css" rel="stylesheet">
  <!-- Product view slider -->
  <link rel="stylesheet" type="text/css" href="css/jquery.simpleLens.css">    
  <!-- slick slider -->
  <link rel="stylesheet" type="text/css" href="css/slick.css">
  <!-- price picker slider -->
  <link rel="stylesheet" type="text/css" href="css/nouislider.css">
  <!-- Theme color -->



  <link id="switcher" href="css/theme-color/<?php echo $ayarcek['theme']  ?>.css" rel="stylesheet">
  <!-- <link id="switcher" href="css/theme-color/bridge-theme.css" rel="stylesheet"> -->
  <!-- Top Slider CSS -->



  <link href="css/sequence-theme.modern-slide-in.css" rel="stylesheet" media="all">

  <!-- Main style sheet -->
  <link href="css/style.css" rel="stylesheet">    

  <!-- Google Font -->
  <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>





</head>
<body> 
  <!-- Aciliş yükləməsi buradan gəlir 
  <div id="wpf-loader-two">          
    <div class="wpf-loader-two-inner">
      <span>Yüklənir</span>
    </div>
  </div> 
-->






<a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>

<!-- Start header section -->
<header id="aa-header">
  <div id="ownMenu">
    <ul>
      <?php 
      $headermenusor=$db->prepare("SELECT * FROM menu where menu_header_durum=:menu_header_durum order by menu_sira ASC limit 6  ");
      $headermenusor->execute(array(
        'menu_header_durum'=>1  ));
      while($headermenucek=$headermenusor->fetch(PDO::FETCH_ASSOC)){
       ?>
       <li><a href="
        <?php
        if(empty($headermenucek['menu_detay'])){
         echo $headermenucek['menu_url'];                 
         }else{
           echo "menu-".seo($headermenucek['menu_ad']);
         }
         ?>"
         ><?php echo $headermenucek['menu_ad'] ?></a></li>

       <?php } ?>



       <li>
        <?php if (isset($_SESSION['kullanici_giris'])) { ?>

         <div class="dropdown">
          <a class="btn btn-secondary dropdown-toggle" href="#"  id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $kullanicicek['kullanici_adsoyad'] ?>&nbsp &nbsp <i class="fa fa-angle-down"></i>
          </a>

          <div style="background:#2A3F54;" class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="profil">Profil</a>
            <?php if($kullanicicek['kullanici_admin']==1){ ?>

              <a class="dropdown-item" href="admin/index">Admin Giriş</a>
            <?php } ?>

            <a class="dropdown-item" href="logout">Çıxış &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <i class="fa fa-sign-out"></i></a>

          </div>
        </div>



        <?php }else{ ?>  <a href="" data-toggle="modal" data-target="#login-modal">Giriş və Qeydiyyat</a>
      <?php } ?>       
    </li>


  </li>
</ul>
</div>



<div class="aa-header-bottom">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="aa-header-bottom-area">
          <!-- logo  -->
          <div class="aa-logo">
            <a href="index.php">

              <p> <a href="index.php" class="site_title"> <span style="font-family: Edwardian Script ITC;
              font-size: 50px;"><b><?php  echo $ayarcek['ayar_logo_soz']; ?></b> </span></a> </p>
            </a>
          </div>

          <div class="aa-search-box">
            <form action="">
              <input type="text" name="" id="" placeholder="Axtarı üçün...">
              <button type="submit"><span class="fa fa-search"></span></button>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
</header>