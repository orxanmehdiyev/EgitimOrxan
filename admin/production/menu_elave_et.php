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
             <b style="color: green"><i class="fa fa-chevron-down"> </i> Menu əlavə edildi</b>
           <?php } elseif($_GET['durum']=='no'){?>
            <b style="color: red"> <i class="fa fa-times"> </i> Menu əlavə edilmədi</b>
          <?php } else{?>
            <h2>Əlaqə Tənzimləmələri <small>Aşağıdan yeniləyə bilərsiz</small></h2>
          <?php  }  ?>

          <div class="clearfix">

          </div>
        </div>
        <div class="x_content">
          <br />
          <form method="POST" action="../nedmin/admin_islem.php"   class="form-horizontal form-label-left">
            <?php     
            $menusor=$db->prepare("SELECT * FROM menu where menu_ust=:menu_ust ");
            $menusor->execute(array(
              "menu_ust"=>0
            ));  ?>


            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Menu yeri <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="select2_single form-control" tabindex="-1" name="menu_ust">
                  <option></option>
                  <option value="0">Üst menu</option>
                  <?php                  

                  while ($menucek=$menusor->fetch(PDO::FETCH_ASSOC)) { ?>
                   <option  value="<?php echo $menucek['menu_id'] ?>"><?php echo $menucek['menu_ad'] ?></option>
                 <?php }?>
               </select>
             </div>
           </div>


           <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Menu adı <span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="middle-name" class="form-control col-md-7 col-xs-12" placeholder="Menu adını yazın" name="menu_ad" type="text">
            </div>
          </div>


          <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">URL</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="middle-name" class="form-control col-md-7 col-xs-12" placeholder="Menu Linki" name="menu_url" type="text">
            </div>
          </div>


          <div class="form-group">
            <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">Menu İçerik></label>
            <div class="col-md-8 col-sm-8 col-xs-12">
             <textarea name="menu_detay" class="ckeditor" id="editor1" rows="10" cols="80">   </textarea>
           </div>
         </div>





         <div class="ln_solid"></div>
         <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <button type="submit" name="menu_elave_et" class="btn btn-primary  col-md-12 col-xs-12">Ə L A V Ə &nbsp &nbsp E T</button>
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