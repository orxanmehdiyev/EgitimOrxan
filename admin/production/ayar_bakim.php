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
        <h3>Səyfənizi təmir moduna keçirmə</h3>
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
            <b style="color: red"> <i class="fa fa-times"> </i> Yenilənmə Uğursi</b>
          <?php } else{?>
            <h2>səyfənizi təmir moduna <small>Aşağıdan keçrə bilərsiz</small></h2>
          <?php  }  ?>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form method="POST" action="../nedmin/islem.php"   class="form-horizontal form-label-left">

      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <div class="">
                            <label>
                              <input type="checkbox" name="bakimmod" class="js-switch" <?php if ( $ayarcek['ayar_bakim']==1) {
                              echo "checked";
                              }else{
                                echo "";
                              } ?>  /> 
                              
                            </label>

                          </div>
                     
                    
                        </div>
                      </div>

        

            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="bakim" class="btn btn-primary  btn-block">Y E N İ L Ə</button>
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