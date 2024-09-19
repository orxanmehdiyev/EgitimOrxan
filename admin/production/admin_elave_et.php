<?php 
require_once "header.php";
require_once "menu.php";
require_once "menu_tenzimleme.php";

?>




</div>
</div>

<!-- top navigation -->
<?php require_once "nav-menu.php" ?>

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Yeni Admin Əlavə Edilməsi</h3>
      </div>
      <?php 
      require_once "search.php"
      ?>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">

            <?php 
            if ($_GET['durum']=='ok') {?>
             <b style="color: green"><i class="fa fa-chevron-down"> </i> Yenilənmə uğurlu</b>
           <?php } elseif($_GET['durum']=='no'){?>
            <b style="color: red"> <i class="fa fa-times"> </i> Yenilənmə uğursuz</b>
          <?php } else{?>
            <h2></h2>
          <?php  }  ?>

          <div class="clearfix">

          </div>
        </div>
        <div class="x_content">
          <br />
          <form method="POST" action="../nedmin/admin_islem.php"   class="form-horizontal form-label-left">

     


    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="last-name">İstifadəci adı <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" onchange="admin_nick()" name="admin_istifateci_ad"  placeholder="İstifadəci adını yazın"  required="required" class="form-control col-md-7 col-xs-12"> <span id="admin_nick" class="required"></span>
      </div>
    </div>

    <div class="form-group">
      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">E-mail <span class="required">*</span></label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="email"  onchange="admin_email()" name="admin_mail" class="form-control col-md-7 col-xs-12"   placeholder="E-Mail" required="required"  >
        <span id="admin_email" class="required"></span>
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
        <input type="number" onchange="adminGsm()"  name="admin_gsm" placeholder="Telefon nömrənizi yazın"  required="required" class="form-control col-md-7 col-xs-12">
        <span id="admin_gsm" class="required"> </span>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="last-name">Adı və Soyadı <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text"  name="admin_ad_soyad" placeholder="Ad və Soyadını yazın" required="required" class="form-control col-md-7 col-xs-12">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Dövlət <span class="required">*</span></label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <select class="select2_single form-control" tabindex="-1" name="admin_dovlet">
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
              <input  class="form-control col-md-7 col-xs-12" placeholder="Şəhər" " name="admin_seher" type="text" name="middle-name">
            </div>
          </div>

          <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Adress <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input  class="form-control col-md-7 col-xs-12" placeholder="Ünvan" " name="admin_unvan" type="text" name="middle-name">
            </div>
          </div>


          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Təhsil <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="select2_single form-control" tabindex="-1" name="admin_tehsil">
                <option></option>  
                <option  value="Natamam">Natamam</option> 
                <option  value="Orta">Orta</option>
                <option  value="Ali">Ali</option>

              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">İşlədiyi yer <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input  class="form-control col-md-7 col-xs-12" placeholder="İşlədiyi yer" " name="admin_is" type="text" name="middle-name">
            </div>
          </div>

          <div class="form-group">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">Haqqında  <span class="required">*</span></label>
            <div class="col-md-8 col-sm-8 col-xs-12">
             <textarea name="admin_haqqinda" class="ckeditor" id="editor1" rows="10" cols="80">  </textarea>
           </div>
         </div>




         <div class="ln_solid"></div>
         <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <button type="submit" name="admin_elave_et" class="btn btn-primary  col-md-12 col-xs-12"> Ə L A V Ə &nbsp &nbsp E T</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

</div>
</div>
<!-- /page content -->

<?php 
require_once "footer.php"
?>