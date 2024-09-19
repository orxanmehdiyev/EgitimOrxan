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
        <h3>Proqramlar</h3>
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
         if ($_GET['durum']=='psilok') {?>
           <b style="color: green"><i class="fa fa-chevron-down"> </i> Proqram Silindi</b>
         <?php } elseif($_GET['durum']=='psilno'){?>
          <b style="color: red"> <i class="fa fa-times"> </i> Proqram Silinmədi</b>
        <?php }elseif($_GET['durum']=='peok'){?>
          <b style="color: green"><i class="fa fa-chevron-down"> </i> Proqram əlavə edildi</b>
        <?php } elseif($_GET['durum']=='peno'){?>
          <b style="color: red"><i class="fa fa-times"> </i> Proqram əlavə edilmədi</b>
        <?php }elseif($_GET['durum']=='pduzok'){?>
          <b style="color: green"><i class="fa fa-chevron-down"> </i> Yenilənmə uğurlu</b>
        <?php }elseif($_GET['durum']=='katsilok'){?>
          <b style="color: green"><i class="fa fa-chevron-down"> </i> Proqram kataqorisi və həmin  kataqoridəki proqramlar silindi</b>
        <?php }elseif($_GET['durum']=='katsilno'){?>
          <b style="color: red"> <i class="fa fa-times"> </i> Silmə uğursuz</b>
        <?php } else{?>
          <h2><small> </small></h2>
        <?php  }  ?>

        <div class="clearfix"></div>
      </div>

      <div class="x_content">

        <div style="text-align: center;"> 
          <a href="program_elave_et">
            <button  class="btn btn-primary btn-block btn-sm">Y E N İ &nbsp &nbsp P R O Q R A M &nbsp &nbsp Ə L A V Ə &nbsp &nbsp E T</button>
          </a>



        </div>
        <div class="x_content">
          <table class="table table-bordered" style="border: 0;">
           <?php 

$sayfada = 1; // sayfada gösterilecek içerik miktarını belirtiyoruz.
$sorgu=$db->prepare("SELECT * FROM proqramkataqori ");
$sorgu->execute();
$toplam_icerik=$sorgu->rowCount();
$toplam_sayfa = ceil($toplam_icerik / $sayfada);
                                     // eğer sayfa girilmemişse 1 varsayalım.
$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
                                    // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
if($sayfa < 1) $sayfa = 1; 
                                   // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
$limit = ($sayfa - 1) * $sayfada;



$proqramkataqorisor=$db->prepare("SELECT * FROM proqramkataqori  order by  proqramkataqori_ad ASC limit $limit,$sayfada ");
$proqramkataqorisor->execute();
$say=0;

while ($proqramkataqoricek=$proqramkataqorisor->fetch(PDO::FETCH_ASSOC)) {

  $proqramkataqori_id=$proqramkataqoricek['proqramkataqori_id'];

$sayfada = 6; // sayfada gösterilecek içerik miktarını belirtiyoruz.
$sorgu=$db->prepare("SELECT * FROM proqramlar ");
$sorgu->execute();
$toplam_icerik=$sorgu->rowCount();
$toplam_sayfa = ceil($toplam_icerik / $sayfada);
                                     // eğer sayfa girilmemişse 1 varsayalım.
$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
                                    // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
if($sayfa < 1) $sayfa = 1; 
                                   // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
$limit = ($sayfa - 1) * $sayfada;





$programsor=$db->prepare("SELECT * from proqramlar where proqramkataqori_id=:proqramkataqori_id order by  proqram_ad DESC limit $limit,$sayfada ");
$programsor->execute(array(
  'proqramkataqori_id'=>$proqramkataqori_id));

  ?>
  <thead >
    <tr  >


      <td style="border: 0;" colspan="7" ></td>




    </tr>
  </thead>
  <thead>
    <tr style="background: #EDEDED;">


      <td colspan="6" style="text-align: center; font-size: 20px; padding: 3px "><a style="color: #2A3F54;" href=""><?php echo UcWords($proqramkataqoricek['proqramkataqori_ad']) ?></a></td>

      <th style="padding: 3px">
        <input id="<?php echo $proqramkataqoricek['proqramkataqori_id']; ?>"
        type="checkbox"  class="js-switch" onchange="proqramkatkontrol()" <?php 
        if($proqramkataqoricek['proqramkataqori_durum']==1){
          echo "checked";
        }else{
          echo "";
        }  ?> /> </th>

        <td style="padding: 3px" >
          <a href="../nedmin/admin_islem.php?proqramkataqori_id=<?php echo $proqramkataqoricek['proqramkataqori_id'] ?>&proqramkataqoricek_sil=ok">
            <button  class="btn btn-danger btn-xs" style="margin-bottom: -8px;"><i class="fa fa-trash " ></i> Sil</button>
          </a>
        </td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th>№</th>
        <th>İMG</th>
        <th>Adı</th>
        <th>Haqqında</th>
        <th>Dowload linki</th>
        <th>Durum</th>
        <th style="width: 10px;" >Düzəliş</th>
        <th style="width: 10px;">Sil</th>
      </tr>
    </tbody>
    <?php 
    while ($programcek=$programsor->fetch(PDO::FETCH_ASSOC)) {
$say++
      ?>
      <tbody>
        <tr>
          <th scope="row"><?php echo $say; ?></th>
          <td style="width: 50px; height: 50px;">
            <a href="">
              <img style="width: 50px; height: 50px;" src="images/program/<?php
              if(strlen($programcek['proqram_img'])>0){
               echo $programcek['proqram_img'];
               }else{
                echo'img.png';
              }
              ?>">
            </a>
          </td>
          <th ><?php echo UcWords($programcek['proqram_ad']) ?></th>
          <th ><?php echo substr($programcek['proqram_detay'],0,250) ?></th>
          <th ><?php echo $programcek['proqram_download_link'] ?></th>
          <th>
            <input id="<?php echo $programcek['proqram_id']; ?>"
            type="checkbox"  class="js-switch" onchange="programdurum()" <?php 
            if($programcek['proqram_durum']==1){
              echo "checked";
            }else{
              echo "";
            }?> /> 
          </th>


          <td>
            <a href="program_duzenle?proqram_id=<?php echo $programcek['proqram_id'] ?>">
              <button class="btn btn-primary btn-xs" > <i class="fa fa-pencil"></i> Düzəliş</button>
            </a>
          </td>
          <td>
            <a href="../nedmin/admin_islem.php?proqram_id=<?php echo $programcek['proqram_id'] ?>&program_sil=ok&proqram_img=<?php echo $programcek['proqram_img'] ?>"><button  class="btn btn-danger btn-xs"><i class="fa fa-trash "></i> Sil</button>
            </a>
          </td>
        </tr>
      </tbody>

      <script type="text/javascript">

      </script>
    <?php } 
  }  ?>

</table>
</div>


<div class="aa-blog-archive-pagination">
  <nav>
    <ul class="pagination"  >

      <li onclick='back()'>
        <a id="back" href="#" aria-label="Previous">
          <span aria-hidden="true">«</span>
        </a>
      </li>

      <?php
      for ($i=1; $i<=$toplam_sayfa; $i++) {
        if ($i==$sayfa) {
          if($i==$toplam_sayfa){
            $nexti=$i;
          }else{
           $nexti=$i+1;
         }
         if($i==1){
          $backi=$i;
        }else{
         $backi=$i-1;
       }     
       ?>
       <li onclick='back()'><a style="background-color: #C84C3C; color:white;" href="program?sayfa=<?php echo $i; ?>"><?php echo $i; ?></a></li>
     <?php } else {?>
      <li onclick='back()'><a href="program?sayfa=<?php echo $i; ?>"><?php echo $i; ?></a></li>
    <?php   }
  }; 
  ?>
  <script type="text/javascript">
    function back() {  
      document.getElementById('back').href="program?sayfa=<?php echo $backi; ?>";
    }
  </script>

  <li >
    <?php 
    $i=$i-1; ?><a  href="program?sayfa=<?php echo $nexti; ?> " aria-label="Next">
      <span aria-hidden="true">»</span>
    </a>
  </li>
</ul>
</nav>
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