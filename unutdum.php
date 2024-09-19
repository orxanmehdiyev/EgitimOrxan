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



<!-- Subscribe section -->

<!-- / Subscribe section -->
<?php 
require_once "footer.php"
?>