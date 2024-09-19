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
        <h3>Admininlərin yetgilərini buradan tənzimləyə bilərsiz</h3>
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
            $admin_id=$_GET['admin_id'];
            $adminyetgisor=$db->prepare("SELECT * FROM admin where admin_id=:admin_id");
            $adminyetgisor->execute(array(
              'admin_id'=>$admin_id
            ));
            $adminyetgicek=$adminyetgisor->fetch(PDO::FETCH_ASSOC)

            ?>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form method="POST" action="../nedmin/islem.php"   class="form-horizontal form-label-left">


              <div class="form-group">
                <label style="padding-top: 1px;" class="control-label col-md-2 col-sm-2 col-xs-12"   for="last-name">Hakkimizda <span class="required">*</span>
                </label>
                <div class="col-md-1 col-sm-1 col-xs-12">
                 <input onchange="headerYetgi()" type="checkbox" name="<?php echo $_GET['admin_id'] ?>" class="js-switch" <?php if ( $adminyetgicek['admin_yetgi_hakkimizda']==1) {
                  echo "checked";
                }else{
                  echo "";
                } ?>  /> 
              </div>

              <label style="padding-top: 1px;" class="control-label col-md-2 col-sm-2 col-xs-12"   for="last-name">Admin   <span class="required">*</span>
              </label>
              <div class="col-md-1 col-sm-1 col-xs-12">
               <input onchange="adminyetgi_iki()" type="checkbox" name="<?php echo $_GET['admin_id'] ?>" class="js-switch" <?php if ( $adminyetgicek['adminyetgi2']==1) {
                echo "checked";
              }else{
                echo "";
              } ?>  /> 
            </div>
            <label style="padding-top: 1px;" class="control-label col-md-2 col-sm-2 col-xs-12"  for="last-name">İstifadəci  <span class="required">*</span>
            </label>
            <div class="col-md-1 col-sm-1 col-xs-12">
             <input type="checkbox" name="bakimmod" class="js-switch" <?php if ( $ayarcek['ayar_bakim']==1) {
              echo "checked";
            }else{
              echo "";
            } ?>  /> 
          </div>
        </div>




        <div class="ln_solid"></div>


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