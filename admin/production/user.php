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
        <h3>Adminlər</h3>
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
           <b style="color: green"><i class="fa fa-chevron-down"> </i> Admin Silindi</b>
         <?php } elseif($_GET['durum']=='silno'){?>
          <b style="color: red"> <i class="fa fa-times"> </i> Admin Silinmədi</b>
        <?php } else{?>
          <h2></h2>
        <?php  }  ?>

        <div class="clearfix"></div>
      </div>

      <div class="x_content">


        <div class="x_content">
          <table id="datatable-responsive" class="table table-striped jambo_table bulk_action table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>№</th>
                <th>IMG</th>
                <th>Adı,Soyadı</th>
                <th>İstifadəçi Adı</th> 
                <th>E-Mail</th>  
                <th>Telefon</th> 
                <th>Durum</th> 
                <th>Dövlət</th>          
                <th>Qeydiyyat tarixi</th>                
                <th>Şəhər</th>
                <th>Ünvan</th>
                <th>Yetgi</th>
                <th>Profil</th>
                <th style="width: 10px;" >Düzəliş</th>
                <th style="width: 10px;">Sil</th>
              </tr>
            </thead>
            <tbody>


              <?php 
              $kullanicisor=$db->prepare("SELECT * FROM kullanici");
              $kullanicisor->execute();
              $say=0;
              while ($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)) {
                $say++;

                ?>

                <tr >
                  <th scope="row"><?php echo  $say ?></th>
                  <td><a href=""><img style="width: 128px; height: 128px;" src="images/adminprofil/<?php
                  if(strlen($kullanicicek['kullanici_resim'])>0){
                   echo $kullanicicek['kullanici_resim'];
                   }else{
                    echo'img.png';
                  }
                  ?>"></a></td>
                  <td><a href=""><?php echo $kullanicicek['kullanici_adsoyad'] ?></a></td>
                  <td><a href=""><?php echo $kullanicicek['kullanici_ad'] ?></a></td>
                  <td><a href=""><?php echo $kullanicicek['kullanici_mail'] ?></a></td>
                  <td><a href=""><?php echo $kullanicicek['kullanici_gsm'] ?></a></td>
                  <td>
                    <label class="checkbox">
                      <input id="<?php echo $kullanicicek['kullanici_id']; ?>"
                      <?php if($kullanicicek['kullanici_durum']==1){
                        echo "checked";
                      }else{
                        echo "";
                      }?>  type="checkbox" onchange="admindurum()"  > 
                      <span class="checkbox"> 
                        <span></span>
                      </span>
                    </label>
                  </td>
                  <td><a href="">
                    <?php  
                    $kullanici_dovlet=$kullanicicek['kullanici_dovlet'];
                    $dovletsor=$db->prepare("SELECT * FROM dovlet where dovlet_id=:dovlet_id ");
                    $dovletsor->execute(array(
                      'dovlet_id'=> $kullanici_dovlet));
                    $dovletcek=$dovletsor->fetch(PDO::FETCH_ASSOC);
                    echo $dovletcek['dovlet_ad']               
                    ?></a>


                  </td>
                  

                  <td><a href=""><?php echo $kullanicicek['kullanici_zaman'] ?></a></td>

                  


                  <td><a href=""><?php echo $kullanicicek['kullanici_seher'] ?></a></td>
                  <td><a href=""><?php echo $kullanicicek['kullanici_unvan'] ?></a></td>



                  <td><a href="admin_status.php?kullanici_id=<?php echo $kullanicicek['kullanici_id'] ?>"><button class="btn btn-primary btn-xs" ><i class="fa fa-pencil"></i> Status</button></a></td>
                  <td><a href="profile?kullanici_id=<?php echo $kullanicicek['kullanici_id'] ?>" class="btn btn-success btn-xs"><i class="fa fa-edit m-right-xs"></i>Profile</a></td>

                  <td><a href="admin_duzenle?kullanici_id=<?php echo $kullanicicek['kullanici_id'] ?>"><button class="btn btn-primary btn-xs" ><i class="fa fa-pencil"></i> Düzəliş</button></a></td>

                  <td><a href="../nedmin/admin_islem.php?kullanici_id=<?php echo $kullanicicek['kullanici_id'] ?>&admin_sil=ok"><button
                    <?php if($say2>0){ ?>
                     onclick="alert('Admini silmƏk istədiyinizdən əminsiz')"
                     <?php } ?> class="btn btn-danger btn-xs"><i class="fa fa-trash "></i> Sil</button></a></td>
                   </tr> 
                 <?php   }   ?>
               </tbody>

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