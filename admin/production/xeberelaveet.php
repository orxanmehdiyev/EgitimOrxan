<?php 

require_once "header.php";
require_once "menu.php";
require_once "menu_tenzimleme.php";

?>


</div>
</div>

<?php require_once "nav-menu.php" ?>


<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Yeni Proqram Əlavə Edirsiz</h3>
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
             <b style="color: green"><i class="fa fa-chevron-down"> </i> Menu əlavə edildi</b>
           <?php } elseif($_GET['durum']=='no'){?>
            <b style="color: red"> <i class="fa fa-times"> </i> Menu əlavə edilmədi</b>
          <?php } else{?>
            <h2><small></small></h2>
          <?php  }  ?>

          <div class="clearfix">

          </div>
        </div>
        <div class="x_content">
          <br />
          <form method="POST" action="../nedmin/admin_islem.php"  enctype="multipart/form-data"  class="form-horizontal form-label-left">

            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Məqalənin yerləşəcəyi üst menu <span class="required">*</span></label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <select required=""  class="select2_single form-control"  id="menu_ust" onchange="menusor()" >
                  <option></option>
                  <?php 
                  $menusor=$db->prepare("SELECT *FROM menu where menu_ust=:menu_ust and menu_durum=:menu_durum order by menu_sira ASC");
                  $menusor->execute(array(
                    'menu_ust'=>0,
                    'menu_durum'=>1));
                    while ($menucek=$menusor->fetch(PDO::FETCH_ASSOC)) { ?>
                     <option  value="<?php echo $menucek['menu_id'] ?>"><?php echo $menucek['menu_ad'] ?></option>
                   <?php }?>
                 </select>
               </div> 
             </div>


             <div id="sec" class="form-group" style="display: none;">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Məqalənin yerləşəcəyi alt menu <span class="required">*</span></label>
              <div id="selek" class="col-md-4 col-sm-4 col-xs-12">
                <select required=""  class="select2_single form-control" tabindex="-1" id="menu_ust" name="proqram_kataqori"  >
                  <option></option>
                  <option value="0">Yeni Kataqoriya</option>
                  <?php 
                  $menu_ust=$_POST['altmenu_id'];
                  $menusor=$db->prepare("SELECT *FROM menu where menu_ust=:menu_ust and menu_durum=:menu_durum order by menu_sira ASC");
                  $menusor->execute(array(
                    'menu_ust'=> $menu_ust,
                    'menu_durum'=>1));
                    while ($menucek=$menusor->fetch(PDO::FETCH_ASSOC)) { ?>
                     <option  value="<?php echo $menucek['menu_id'] ?>"><?php echo $menucek['menu_ad'] ?></option>
                   <?php }?>
                 </select>
               </div> 
             </div>





















             <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12">
               <textarea name="proqram_detay" class="ckeditor"  rows="10" cols="80">   </textarea>
             </div>
           </div>





           <div class="ln_solid"></div>
           <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" name="program_elave_et" class="btn btn-primary  col-md-12 col-xs-12">Ə L A V Ə &nbsp &nbsp E T</button>
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