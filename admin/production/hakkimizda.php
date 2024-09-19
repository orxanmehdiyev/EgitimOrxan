<?php 
require_once "header.php";
require_once "menu.php";
require_once "menu_tenzimleme.php";

?>

<?php 
if( $admincek['admin_yetgi_hakkimizda']==1){  ?> 
 <li><a href="hakkimizda"><i class="fa fa-info"></i>Hakkimizda </a> </li> 
<?php }else{
  header("Location:index.php");
  exit; } ?> 


</div>
</div>

<!-- top navigation -->
<?php require_once "nav-menu.php";
$hakkimizdasor=$db->prepare("SELECT * FROM hakkimizda where hakkimizda_id=:hakkimizda_id");
$hakkimizdasor->execute(array(
  'hakkimizda_id'=>0));
$hakkimzdacek=$hakkimizdasor->fetch(PDO::FETCH_ASSOC);

?>



<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Səyfəniz və ya özünüz haqqında məlumatları aşağıdan yeniləyə bilərsiz</h3>
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
             <b style="color: green"><i class="fa fa-chevron-down"> </i> Yenilənmə Uğurlu</b>
           <?php } elseif($_GET['durum']=='no'){?>
            <b style="color: red"> <i class="fa fa-times"> </i> Yenilənmə Uğursuz</b>
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
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">Başlıq <span class="required">*</span></label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <input id="middle-name" class="form-control col-md-7 col-xs-12" value="<?php echo $hakkimzdacek['hakkimizda_baslik'] ?>" name="hakkimizda_baslik" type="text">
            </div>
          </div>

          <div class="form-group">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">Məksədimiz <span class="required">*</span></label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <input id="middle-name" class="form-control col-md-7 col-xs-12" value="<?php echo $hakkimzdacek['hakkimizd_misyon'] ?>" name="hakkimizd_misyon" type="text">
            </div>
          </div>
          <div class="form-group">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">Video <span class="required">*</span></label>
            <div class="col-md-8 col-sm-8 col-xs-12">
              <input id="middle-name" class="form-control col-md-7 col-xs-12" value="<?php echo $hakkimzdacek['hakkimizda_video'] ?>" name="hakkimizda_video" type="text">
            </div>
          </div>

          <div class="form-group">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">İçerik <span class="required">*</span></label>
            <div class="col-md-8 col-sm-8 col-xs-12">
             <textarea name="hakkimizda_icerik" class="ckeditor" id="editor1" rows="10" cols="80"> <?php echo $hakkimzdacek['hakkimizda_icerik'] ?>  </textarea>
           </div>
         </div>

         <div class="ln_solid"></div>
         <div class="form-group">
          <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-2">
            <button type="submit" name="hakkimizd_yenile" class="btn btn-primary  col-md-12 col-xs-12">Y E N İ L Ə</button>
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