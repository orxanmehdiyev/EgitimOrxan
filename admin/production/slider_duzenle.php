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
              <b style="color: green"><i class="fa fa-chevron-down"> </i> Slider Yeniləndi</b>
            <?php } elseif($_GET['durum']=='no'){?>
              <b style="color: red"> <i class="fa fa-times"> </i> Slider Yenilənmədi</b>
            <?php } else{?>
              <h2></h2>
            <?php  }  ?>

            <div class="clearfix">

            </div>
          </div>
          <div class="x_content">
            <br />

            <?php 
            $slider_id=$_GET['slider_id'];
            $slidersor=$db->prepare("SELECT * FROM slider where slider_id=:slider_id");
            $slidersor->execute(array(
              'slider_id'=>$slider_id));


            $slidercek=$slidersor->fetch(PDO::FETCH_ASSOC) ;          

            ?>


            <form method="POST" action="../nedmin/admin_islem.php"  enctype="multipart/form-data"  class="form-horizontal form-label-left">





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
              $('.onizleme').html('<img style="width:550px;height:150px;" src="'+adres+'"/>');//resim olarak çizdir.
            }
            
            veri.readAsDataURL(resim.files[0]);//veri okuma
          }
        });
        
      })
    </script>


    <div class="form-group">
      <label class="control-label col-md-2 col-sm-2 col-xs-12">Mövcut şəkil</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="">
          <label >                   
            <div><img style="width:550px;height:150px;" src="images/slider/<?php echo $slidercek['slider_img'] ?>"></div>

          </label>
        </div>
      </div>
    </div>
    <hr>

<input type="hidden"  name="eski_yol" value="<?php echo $slidercek['slider_img'] ?>" />
<input type="hidden"  name="slider_id" value="<?php echo $slidercek['slider_id'] ?>" />
    <div class="form-group">
      <label class="control-label col-md-2 col-sm-2 col-xs-12">Yeni şəkil secin</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="">
          <label >
            <div class="onizleme" ></div>
            <input type="file" id="resim" name="slider_img" />

          </label>
        </div>
      </div>
    </div>


    <div class="form-group">
      <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">Adı <span class="required">*</span></label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input id="middle-name" class="form-control col-md-7 col-xs-12" value="<?php echo $slidercek['slider_ad'] ?>" name="slider_ad" type="text">
      </div>
    </div>


    <div class="form-group">
      <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">TEKS <span class="required">*</span></label>
      <div class="col-md-8 col-sm-8 col-xs-12">
       <textarea name="slider_teks" class="ckeditor" id="editor1" rows="10" cols="80"><?php echo $slidercek['slider_teks'] ?>   </textarea>
     </div>
   </div>

   <div class="ln_solid"></div>
   <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button type="submit" name="sliderduzenle" class="btn btn-primary  col-md-12 col-xs-12"> Ə L A V Ə &nbsp &nbsp E T</button>
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