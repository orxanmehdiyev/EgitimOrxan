<?php 
require_once "header.php";
require_once "menu.php";
?>

<?php
$kullanici_id=$kullanicicek['kullanici_id'];

$kullanicisor=$db->prepare("SELECT  kullanici.*,dovlet.* FROM kullanici INNER JOIN dovlet on kullanici.kullanici_dovlet=dovlet.dovlet_id where kullanici_id=:kullanici_id");
$kullanicisor->execute(array(
  'kullanici_id'=>$kullanici_id));
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

 
?>
<section id="aa-myaccount">
 <div class="container">
   <div class="row">

     <div class="col-md-12">
      <div class="aa-myaccount-area" style="padding-top: 30px;">         
        <div class="row">
          <h4>Profilim</h4>
          
      <div class="col-md-2 col-sm-2 col-xs-12" style="margin: 0;padding: 0;">
            <div class="row" style="margin: 0;">
              <img src="img/profil/img.jpg" alt="..." class="img-thumbnail ">                  
            </div>
           <br>
            
           <b> <a   href="kullanici_img_duzenle">Profil Şəklini Yenilə -<i class="fa fa-angle-double-right"></i> </a></b>
       <hr style="    margin-top: 5px;
    margin-bottom: 5px;">
            <a   href="kullanici_duzenle">Məlumatlarını Yenilə -<i class="fa fa-angle-double-right"></i> </a>
          <hr style="    margin-top: 5px;
    margin-bottom: 5px;">
            <a   href="kullanici_sifre_duzenle">Giriş Kodunu Yenilə-<i class="fa fa-angle-double-right"></i> </a>
             <hr style="    margin-top: 5px;
    margin-bottom: 5px;">


          </div>
          <div class="col-md-10 col-sm-10 col-xs-12">

            <div class="x_panel">

              <div class="x_content">
                <br />
                <div   class="form-horizontal form-label-left">

                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">İstifadəci adı: 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" disabled=""   value="<?php echo $kullanicicek['kullanici_ad'] ?>" class="form-control"> 
                    </div>
                  </div>

                    <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Qeydiyayt tarixi: 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" disabled=""   value="<?php echo $kullanicicek['kullanici_zaman'] ?>" class="form-control"> 
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">E-Mail: 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" disabled=""   value="<?php echo $kullanicicek['kullanici_mail'] ?>" class="form-control"> 
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Telefon: 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" disabled=""   value="<?php echo $kullanicicek['kullanici_gsm'] ?>" class="form-control"> 
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Ad,soyad: 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" disabled=""   value="<?php echo $kullanicicek['kullanici_adsoyad'] ?>" class="form-control"> 
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Dövlət : 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" disabled=""   value="<?php echo $kullanicicek['dovlet_ad'] ?>" class="form-control"> 
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Şəhər : 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" disabled=""   value="<?php echo $kullanicicek['kullanici_seher'] ?>" class="form-control"> 
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Ünvan : 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" disabled=""   value="<?php echo $kullanicicek['kullanici_unvan'] ?>" class="form-control"> 
                    </div>
                  </div>





                </div>
              </div>
            </div>







          </div>
        </div>
      </div>




    </div>          
  </div>
</div>





</div>
</div>
</section>



<!-- Subscribe section -->

<!-- / Subscribe section -->
<?php 
require_once "footer.php"
?>