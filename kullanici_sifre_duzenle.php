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
          <h4>Profiliniz</h4>
          <?php 
                if ($_GET['sifre']=='ok') {?> 
                  <b style="color: green"><i class="fa fa-chevron-down"> </i> Giriş kodunuz uğurla yeniləndi</b>
              <?php   }?>    
        <div class="col-md-2 col-sm-2 col-xs-12" style="margin: 0;padding: 0;">
            <div class="row" style="margin: 0;">
              <img src="img/profil/img.jpg" alt="..." class="img-thumbnail ">                  
            </div>
           <br>
            
            <a   href="kullanici_img_duzenle">Profil Şəklini Yenilə -<i class="fa fa-angle-double-right"></i> </a>
       <hr style="    margin-top: 5px;
    margin-bottom: 5px;">
            <a   href="kullanici_duzenle">Məlumatlarını Yenilə -<i class="fa fa-angle-double-right"></i> </a>
          <hr style="    margin-top: 5px;
    margin-bottom: 5px;">
           

          </div>
          <div class="col-md-10 col-sm-10 col-xs-12">

            <div class="x_panel">

              <div class="x_content">
                <br />
                <form method="POST" action="admin/nedmin/islem.php"   class="form-horizontal form-label-left">
           
              <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>" ">
              <input type="hidden" name="kullanici_ad" value="<?php echo $kullanicicek['kullanici_ad'] ?>" ">
              <input type="hidden" name="kullanici_mail" value="<?php echo $kullanicicek['kullanici_mail'] ?>" ">


          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="last-name">Köhnə şifrəniz <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="password"  name="password" placeholder="Köhnə şifrəniz"  required="required" class="form-control col-md-7 col-xs-12">
              <span id="kullanici_gsm" class="required">
                <?php 
                if ($_GET['durum']=='kohnesef') {
                  echo "Girdiyiniz şifrə yanlışdır!";
                }?>
              </span>
            </div>
          </div>

            <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="last-name">Yeni şifrəniz <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="password"  name="password1" placeholder="Yeni şifrəniz"  required="required" class="form-control col-md-7 col-xs-12">
              <span id="kullanici_gsm" class="required">
                <?php 
                if ($_GET['durum']=='eynideyil') {
                  echo "Girdiyiniz şifrələr eyni deyil!";
                }?>
              </span>
            </div>
          </div>

            <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="last-name">Yeni şifrəniz təkrar <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="password"  name="password2" placeholder="Yeni şifrəniz təkrar"  required="required" class="form-control col-md-7 col-xs-12">
              <span id="kullanici_gsm" class="required">
                <?php 
                if ($_GET['durum']=='eynideyil') {
                  echo "Girdiyiniz şifrələr eyni deyil!";
                }?>
              </span>
            </div>
          </div>


          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" name="kullanici_sifreduzenle" class="btn btn-primary  col-md-12 col-xs-12"> Y E N İ L Ə</button>
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
</div>
</section>



<!-- Subscribe section -->

<!-- / Subscribe section -->
<?php 
require_once "footer.php"
?>