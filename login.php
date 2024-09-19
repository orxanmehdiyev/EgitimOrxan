<?php 
ob_start();
session_start();
require_once "admin/nedmin/baglan.php";
require_once 'admin/production/fonksiyon.php';





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




<header id="aa-header">
  <div id="ownMenu">

</div>



<div class="aa-header-bottom">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="aa-header-bottom-area">
          <!-- logo  -->
          <div class="aa-logo">
            <a href="index.php">
              <span class="fa fa-shopping-cart"></span>
              <p>daily<strong>Shop</strong> <span>Your Shopping Partner</span></p>
            </a>
          </div>

     

        </div>
      </div>
    </div>
  </div>
</div>
</header>
 


<section id="aa-myaccount">
 <div class="container">
   <div class="row">

     <div class="col-md-12">
      <div class="aa-myaccount-area" style="padding-top: 30px;">         
        <div class="row">
        
          
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">

                <?php 
                if ($_GET['durum']=='ok') {?>
                  <b style="color: green"><i class="fa fa-chevron-down"> </i> Qeydiyyat üçün müraciyətiniz qeydə alındı</b>
               <?php } elseif($_GET['durum']=='no'){?>
                <b style="color: red"> <i class="fa fa-times"> </i> Qeydiyyat uğursuz</b>
              <?php } ?>
                
             

              <div class="clearfix">

              </div>
            </div>
            <div class="x_content">
              <br />
              <form method="POST" action="admin/nedmin/islem.php"   class="form-horizontal form-label-left">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="last-name">İstifadəci adı və ya e-mail <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" onchange="user_nick()" name="kullanici_ad"  placeholder="İstifadəci adı və ya e-mail"  required="required" class="form-control col-md-7 col-xs-12"> <span id="user_nick" class="required"></span>
                  </div>
                </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" name="kullanici_kayit" class="btn btn-primary  col-md-12 col-xs-12"> G Ö N D Ə R</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>          
</div>
</div>
</div>
</div>
</section>



 
<!-- footer -->  
<div style="padding-top: 44%;">
  <header id="aa-header">
  <div id="ownMenu">
</div>


</div>
<!-- / footer -->



</body>
</html>