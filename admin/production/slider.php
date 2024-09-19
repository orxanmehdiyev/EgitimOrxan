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
        <h3>Slider</h3>
      </div>
      <?php 
      require_once "search.php"
      ?>
    </div>
    <div class="clearfix"></div>




    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
         <?php 
         if ($_GET['durum']=='silok') {?>
           <b style="color: green"><i class="fa fa-chevron-down"> </i> Slider Silindi</b>
         <?php } elseif($_GET['durum']=='silno'){?>
          <b style="color: red"> <i class="fa fa-times"> </i> Slider Silinmədi</b>
        <?php } else{?>
          <h2></h2>
        <?php  }  ?>

        <div class="clearfix"></div>
      </div>

      <div class="x_content">

        <div style="text-align: center;"> 
          <a href="sliderelaveet">
            <button  name="umumi_ayarguncelle" class="btn btn-primary btn-block btn-sm">Y E N İ &nbsp &nbsp S L İ D E R &nbsp &nbsp Ə L A V Ə &nbsp &nbsp E T</button>
          </a>



        </div>
        <div class="x_content">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>№</th>
                <th>IMG</th>
                <th>Adı</th>
                <th>Text</th>
                <th>Seo URL</th>
                <th>Durum</th>
                <th style="width: 10px;" >Düzəliş</th>
                <th style="width: 10px;">Sil</th>
              </tr>
            </thead>



            <?php 
            $slidersor=$db->prepare("SELECT * FROM slider");
            $slidersor->execute();
            $say=0;
            while ($slidercek=$slidersor->fetch(PDO::FETCH_ASSOC)) {
              $say++;

              ?>
              <tbody>
                <tr >
                  <th scope="row"><?php echo  $say ?></th>
                  <td style="width: 300px; height: 200px;"><a href=""><img style="width: 300px; height: 200px;" src="images/slider/<?php
                  if(strlen($slidercek['slider_img'])>0){
                   echo $slidercek['slider_img'];
                   }else{
                    echo'img.png';
                  }
                  ?>"></a></td>
                  <td ><a href="" ><?php echo $slidercek['slider_ad'] ?></a></td>

                  <td><a href=""><?php echo $slidercek['slider_teks'] ?></a></td>

                  <td><a href=""><?php echo $slidercek['slider_seourl'] ?></a></td>


                  <td><input id="<?php echo $slidercek['slider_id']; ?>" type="checkbox" onchange="sliderdurum()" class="js-switch"  <?php if($slidercek['slider_durum']==1){
                    echo "checked";
                  }else{
                    echo "";
                  } ?>  /></td>


                  <td><a href="slider_duzenle?slider_id=<?php echo $slidercek['slider_id'] ?>"><button class="btn btn-primary btn-xs" ><i class="fa fa-pencil"></i> Düzəliş</button></a></td>

                  <td><a href="../nedmin/admin_islem.php?slider_id=<?php echo $slidercek['slider_id'] ?>&slider_sil=ok&slider_img=<?php echo $slidercek['slider_img'] ?>"><button class="btn btn-danger btn-xs"><i class="fa fa-trash "></i> Sil</button></a></td>
                   </tr>
                 </tbody>



               <?php   }   ?>

             </table>
           </div>
           <div id="sonuc"></div>
         </div>
       </div>
     </div>


   </div>
 </div>

 <!-- /page content -->


 <?php 
 require_once "footer.php"
 ?>