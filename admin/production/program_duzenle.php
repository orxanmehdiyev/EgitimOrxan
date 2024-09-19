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
        <h3>Proqarm Düzəliş</h3>
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
            <h2> <small></small></h2>
          <?php  }  ?>

          <div class="clearfix">

          </div>
        </div>
        <div class="x_content">
          <br />
          <form method="POST" action="../nedmin/admin_islem.php"  enctype="multipart/form-data"  class="form-horizontal form-label-left">

           <?php  
           $proqram_id=$_GET['proqram_id'];
           $programsor=$db->prepare("SELECT * from proqramlar where proqram_id=:proqram_id ");
           $programsor->execute(array(
            'proqram_id'=>$proqram_id));
           $programcek=$programsor->fetch(PDO::FETCH_ASSOC);


           $proqramkataqorisor=$db->prepare("SELECT * FROM proqramkataqori ");
           $proqramkataqorisor->execute(); ?>


           <div  class="form-group" >
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Möcut şəkil </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div>
                <img style="width:550px;height:150px;" src="images/program/<?php echo $programcek['proqram_img'] ?>">
              </div>
              <input  name="kone_img" value="<?php echo $programcek['proqram_img'] ?>"  type="hidden">
            </div>
          </div>

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
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Yeni Proqram şəkili</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="">
          <label >
            <div class="onizleme" ></div>
            <input type="file" id="resim" name="proqram_img" />

          </label>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Proqram </label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="">
          <label >           
            <input type="file"  name="program_yol" />
          </label>
        </div>
      </div>
    </div>



    <input type="hidden" name="proqram_id" value="<?php echo $programcek['proqram_id'] ?>">





    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Proqramın Kataqoriyası <span class="required">*</span></label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <select required=""  class="select2_single form-control" tabindex="-1" name="proqram_kataqori" onchange="kataqori()">
          <option></option>
          <option value="0">Yeni Kataqoriya</option>
          <?php                  

          while ($proqramkataqoricek=$proqramkataqorisor->fetch(PDO::FETCH_ASSOC)) { ?>
           <option <?php if($proqramkataqoricek['proqramkataqori_id']==$programcek['proqramkataqori_id']){  ?>
            selected
          <?php   } ?>

          value="<?php echo $proqramkataqoricek['proqramkataqori_id'] ?>"><?php echo $proqramkataqoricek['proqramkataqori_ad'] ?>
        </option>
      <?php }?>
    </select>
  </div>
</div>


<div style="display: none" class="form-group" id="kataad">
  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Yeni Kataqoriya Adı <span class="required">*</span></label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input id="middle-name" class="form-control col-md-7 col-xs-12" placeholder="Yeni Kataqoriya Adı" name="proqram_kataqori_yeni" type="text">
  </div>
</div>
<script>  

</script>

<div class="form-group">
  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Proqramin Adı</label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input required="" class="form-control col-md-7 col-xs-12" value="<?php echo $programcek['proqram_ad'] ?>"  name="proqram_ad" type="text">
  </div>
</div>

<div class="form-group">
  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Download linki</label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input required="" class="form-control col-md-7 col-xs-12" value="<?php echo $programcek['proqram_download_link'] ?>" name="proqram_download_link" type="text">
  </div>
</div>


<div class="form-group">
  <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">Proqram haqqında</label>
  <div class="col-md-8 col-sm-8 col-xs-12">
   <textarea name="proqram_detay" class="ckeditor" id="editor1" rows="10" cols="80"><?php echo $programcek['proqram_detay'] ?>   </textarea>
 </div>
</div>





<div class="ln_solid"></div>
<div class="form-group">
  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
    <button type="submit" name="program_duzenle" class="btn btn-primary  col-md-12 col-xs-12">Y E N I L Ə</button>
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