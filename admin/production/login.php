<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
     

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <br>
            <br>
            <form action="../nedmin/admin_islem.php" method="POST">
              <h1>Admin Giriş</h1>
              <div>
                <input type="text" name="admin_giris_ad" class="form-control" placeholder="İstifadəci adı və ya E-mail" required="" />
              </div>
              <div>
                <input type="password" name="admin_password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
               <button name="amdin_giris" class="btn btn-primary btn-block btn-sm">G İ R İ Ş</button>             
              </div>

              <div class="clearfix"></div>

              <div class="separator">
          <?php 
         if($_GET['durum']=='no'){?>
            <b style="color: red"> <i class="fa fa-times"> </i> Giriş Uğursuz!<br> Şifrəniz və ya istifadəci adınız səfdir</b>
          <?php }   ?>
          

      
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
