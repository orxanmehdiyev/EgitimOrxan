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
        <h3>Əlaqə Tənzimləmələri</h3>
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
            <h2>Əlaqə Tənzimləmələri <small>Aşağıdan yeniləyə bilərsiz</small></h2>
          <?php  }  ?>

          <div class="clearfix">

          </div>
        </div>
        <div class="x_content">
          <br />
          <form method="POST" action="../nedmin/islem.php"   class="form-horizontal form-label-left">
              <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="last-name">Başlıq <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="last-name" name="ayar_elaqe_basliq" value="<?php echo $ayarcek['ayar_elaqe_basliq'] ?>"  required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Telefon <span class="required">*</span>
              </label>
              <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="number" id="first-name" required="required" value="<?php echo $ayarcek['ayar_tel'] ?>" name="ayar_tel" class="form-control col-md-7 col-xs-12">
              </div>
              <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="number" id="first-name"  value="<?php echo $ayarcek['ayar_gsm'] ?>" name="ayar_gsm" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="last-name">FAKS <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="last-name" name="ayar_faks" value="<?php echo $ayarcek['ayar_faks'] ?>"  required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group">
              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">E-mail <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="middle-name" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarcek['ayar_mail'] ?>" name="ayar_mail" type="text" name="middle-name">
              </div>
            </div>

         




            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Dövlət <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="select2_single form-control" tabindex="-1" name="ayar_dovlet">
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

                   <option   <?php if($dovletcek['dovlet_id']==$ayarcek['ayar_dovlet']){?>
                    selected <?php } ?> value="<?php echo $dovletcek['dovlet_id'] ?>"><?php echo $dovletcek['dovlet_ad'] ?></option>
                 <?php }?>
                </select>
              </div>
            </div>


            <div class="form-group">
              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Şəhər <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="middle-name" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarcek['ayar_seher'] ?>" name="ayar_seher" type="text" name="middle-name">
              </div>
            </div>

            <div class="form-group">
              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Adress <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="middle-name" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarcek['ayar_adres'] ?>" name="ayar_adres" type="text" name="middle-name">
              </div>
            </div>





            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="elaqe_ayarguncelle" class="btn btn-primary  col-md-12 col-xs-12">Y E N İ L Ə</button>
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