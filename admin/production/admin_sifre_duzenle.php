<?php 
require_once "header.php";
require_once "menu.php";
require_once "menu_tenzimleme.php";
$admin_id=$_GET['admin_id'];
$adminsor=$db->prepare("SELECT * FROM admin where admin_id=:admin_id");
$adminsor->execute(array(
  'admin_id'=>$admin_id));
$admincek=$adminsor->fetch(PDO::FETCH_ASSOC)

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
        <h3>Şifrə yeniləmə</h3>
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
          <?php } 
          elseif($_GET['durum']=='sifreok'){?>
            <b style="color: green"> <i class="fa fa-chevron-down"> </i> Yenilənmə uğursuz</b>
          <?php }
          elseif($_GET['durum']=='sifreno'){?>
            <b style="color: red"> <i class="fa fa-times"> </i> Yeni şifrə eyni deyil</b>
          <?php } 

          elseif($_GET['durum']=='eskisifreno'){?>
            <b style="color: red"> <i class="fa fa-times"> </i> Köhnə şifrə yanlış</b>
          <?php } 
          else{?>
            <h2></h2>
          <?php  }  ?>

          <div class="clearfix">

          </div>
        </div>
        <div class="x_content">
          <br />
          <form method="POST" action="../nedmin/admin_islem.php"   class="form-horizontal form-label-left">
            <div    <?php 
            if($_GET['durum']=='eskisifreno'){?>

             style=" color:red;"
           <?php } ?>  class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="last-name">Şifrəniz <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="password"  name="passwordkohne" placeholder="Şifrəniz"  required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div
            <?php 
            if($_GET['durum']=='sifreno'){?>

             style=" color:red;"
           <?php } ?>

           >
           <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="last-name">Yeni şifrə<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="password"  name="password1" placeholder="Yeni şifrə"  required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <input type="hidden" name="admin_id" value="<?php echo $admincek['admin_id'] ?>">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="last-name">Təkrar Yeni Şifrə <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="password"  name="password2" placeholder="Təkrar Yeni Şifrə"  required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <button type="submit" name="admin_sifre_duzenle" class="btn btn-primary  col-md-12 col-xs-12"> Y E N İ L Ə</button>
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