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
        <h3>Şəkil əlavə edilməsi</h3>
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
          <?php  $admin_id=$_GET['admin_id'];
          $adminsor=$db->prepare("SELECT * FROM admin where admin_id=:admin_id");
          $adminsor->execute(array(
            'admin_id'=>$admin_id));
          $admincek=$adminsor->fetch(PDO::FETCH_ASSOC)
          ?>


          <form method="POST" action="../nedmin/admin_islem.php"  enctype="multipart/form-data"  class="form-horizontal form-label-left">



            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Mövcut şəkil</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="">
                  <label >                   
                    <div>
                      <img style="width: 128px; height: 128px;" src="images/adminprofil/<?php
                  if(strlen($admincek['admin_profil_img'])>0){
                     echo $admincek['admin_profil_img'];
                    }else{
                      echo'img.png';
                    }
 ?>" alt="..." class="img-circle profile_img">

                     </div>

                  </label>
                </div>
              </div>
            </div>
            <hr>
            <head>

              <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>

            </head>
            <script type="text/javascript">
              $(function(){

        $("#resim").change(function(){//eğer file değişirse
          var resim=document.getElementById ("resim");//resime eriş
          
          if (resim.files && resim.files[0]){//eğer dosya var ise
            var veri=new FileReader();//veri okuma apisi başlatıyoruz.
            veri.onload=function() {//altta readAsDataURL verileri okuyoruz.O okuma tamamladığın da
              var adres=veri.result;//veriyi al
              $('.onizleme').html('<img style="width:150px;height:150px;" src="'+adres+'"/>');//resim olarak çizdir.
            }
            
            veri.readAsDataURL(resim.files[0]);//veri okuma
          }
        });
        
      })
    </script>
    <div class="form-group">
      <label class="control-label col-md-2 col-sm-2 col-xs-12">Yeni şəkil secin</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="">
          <label >
            <div class="onizleme" ></div>
            <input type="file" id="resim" name="admin_profil_img" />


          </label>
        </div>
      </div>
    </div>
    <input type="hidden"  name="eski_yol" value="<?php echo $admincek['admin_profil_img'] ?>" />
    <input type="hidden" name="admin_id" value="<?php echo $admincek['admin_id'] ?>">
    <div class="ln_solid"></div>
    <div class="form-group">
      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        <button type="submit" name="adminsekilduzenle" class="btn btn-primary  col-md-12 col-xs-12"> Ə L A V Ə &nbsp &nbsp E T</button>
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