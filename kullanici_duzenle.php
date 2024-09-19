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
          
   <div class="col-md-2 col-sm-2 col-xs-12" style="margin: 0;padding: 0;">
            <div class="row" style="margin: 0;">
              <img src="img/profil/img.jpg" alt="..." class="img-thumbnail ">                  
            </div>
           <br>
            
            <a   href="kullanici_img_duzenle.php">Profil Şəklini Yenilə -<i class="fa fa-angle-double-right"></i> </a>
       <hr style="    margin-top: 5px;
    margin-bottom: 5px;">
           
            <a   href="kullanici_sifre_duzenle.php">Giriş Kodunu Yenilə-<i class="fa fa-angle-double-right"></i> </a>
             <hr style="    margin-top: 5px;
    margin-bottom: 5px;">


          </div>
          <div class="col-md-10 col-sm-10 col-xs-12">

            <div class="x_panel">

              <div class="x_content">
                <br />
                <form method="POST" action="admin/nedmin/islem.php"   class="form-horizontal form-label-left">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="last-name">İstifadəci adı <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text"  name="kullanici_add"  value="<?php echo $kullanicicek['kullanici_ad'] ?>"  required="required" class="form-control col-md-7 col-xs-12"> <span id="user_nick" class="required">
                       <?php 
                       if ($_GET['durum']=='advar') {
                         echo "Bu istifad istifadəçi adı mövcutdur";
                       }?>
                     </span>
                   </div>
                 </div>

                 <div class="form-group">
                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">E-mail <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="email"   name="kullanici_maill" class="form-control col-md-7 col-xs-12"  value="<?php echo $kullanicicek['kullanici_mail'] ?>" required="required"  > <span id="kullanici_mail" class="required">    <?php 
                    if ($_GET['durum']=='mailvar') {
                     echo "Bu  e-mail başqa bir istifadəçi tərəfindən alınıb!";
                   }?></span>
                 </div>
               </div>


               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="last-name">Telefon <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="number"   name="kullanici_gsmm" value="<?php echo $kullanicicek['kullanici_gsm'] ?>"  required="required" class="form-control col-md-7 col-xs-12">
                  <span id="kullanici_gsm" class="required">
                    <?php 
                    if ($_GET['durum']=='telvar') {
                      echo "Bu  telefon başqa bir istifadəçi tərəfindən alınıb!";
                   }?>
                 </span>
               </div>
             </div>

             <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="last-name">Adı və Soyadı <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text"  name="kullanici_adsoyad" value="<?php echo $kullanicicek['kullanici_adsoyad'] ?>"  required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>" ">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Dövlət <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="select2_single form-control" tabindex="-1" name="kullanici_dovlet">
                  <option></option>
                  <?php 

                 /* $ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id=:id");
                  $ayarsor->execute(array(
                    'id'=> 0
                  ));
                  $ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);*/
                  $dovletsor=$db->prepare("SELECT * FROM dovlet ");
                  $dovletsor->execute();
                  while ( $dovletcek=$dovletsor->fetch(PDO::FETCH_ASSOC)) { ?>
                   <option 
                   <?php if($kullanicicek['kullanici_dovlet']==$dovletcek['dovlet_id']){
                    echo "selected";
                  } ?>
                  value="<?php echo $dovletcek['dovlet_id'] ?>"><?php echo $dovletcek['dovlet_ad'] ?></option>
                <?php }?>
              </select>
            </div>
          </div>


          <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Şəhər <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input  class="form-control col-md-7 col-xs-12" value="<?php echo $kullanicicek['kullanici_seher'] ?>" name="kullanici_seher" type="text" >
            </div>
          </div>

          <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Adress <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input  class="form-control col-md-7 col-xs-12" value="<?php echo $kullanicicek['kullanici_unvan'] ?>" name="kullanici_unvan" type="text" name="middle-name">
            </div>
          </div>


          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="last-name">Qeydiyyat üçüm şifrəniz <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="password"  name="password" placeholder="Şifrə"  required="required" class="form-control col-md-7 col-xs-12">
                 <span id="kullanici_gsm" class="required">
                    <?php 
                    if ($_GET['durum']=='kodsef') {
                      echo "Girdiyiniz şifrə yanlışdır!";
                   }?>
                 </span>
            </div>
          </div>


          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" name="kullanici_duzenle" class="btn btn-primary  col-md-12 col-xs-12"> Y E N İ L Ə</button>
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