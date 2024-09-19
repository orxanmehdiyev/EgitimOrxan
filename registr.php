<?php 
require_once "header.php";
require_once "menu.php";
?>


<section id="aa-myaccount">
 <div class="container">
   <div class="row">

     <div class="col-md-12">
      <div class="aa-myaccount-area" style="padding-top: 30px;">         
        <div class="row">
          <h4>Qeydiyyat</h4>
          
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
                  <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="last-name">İstifadəci adı <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" onchange="user_nick()" name="kullanici_ad"  placeholder="İstifadəci adını yazın"  required="required" class="form-control col-md-7 col-xs-12"> <span id="user_nick" class="required"></span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">E-mail <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="email"  onchange="useremail()" name="kullanici_mail" class="form-control col-md-7 col-xs-12"   placeholder="E-Mail" required="required"  > <span id="kullanici_mail" class="required"></span>
                  
                  </div>
                </div>



                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="last-name">Şifrə <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="password"  name="password1" placeholder="Şifrə"  required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="last-name">Təkrar Şifrə <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="password"  name="password2" placeholder="Təkrar Şifrə"  required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="last-name">Telefon <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="number" onchange="usergsm()"  name="kullanici_gsm" placeholder="Telefon nömrənizi yazın"  required="required" class="form-control col-md-7 col-xs-12">
                    <span id="kullanici_gsm" class="required"> </span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="last-name">Adı və Soyadı <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text"  name="kullanici_adsoyad" placeholder="Ad və Soyadını yazın" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

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

                   <option  value="<?php echo $dovletcek['dovlet_id'] ?>"><?php echo $dovletcek['dovlet_ad'] ?></option>
                 <?php }?>
               </select>
             </div>
           </div>


           <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Şəhər <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input  class="form-control col-md-7 col-xs-12" placeholder="Şəhər" " name="kullanici_seher" type="text" name="middle-name">
            </div>
          </div>

          <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Adress <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input  class="form-control col-md-7 col-xs-12" placeholder="Ünvan" " name="kullanici_unvan" type="text" name="middle-name">
            </div>
          </div>


          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" name="kullanici_kayit" class="btn btn-primary  col-md-12 col-xs-12"> Q E Y D I Y Y A T</button>
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



<!-- Subscribe section -->

<!-- / Subscribe section -->
<?php 
require_once "footer.php"
?>