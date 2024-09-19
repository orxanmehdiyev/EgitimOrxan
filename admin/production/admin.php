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

        <div style="text-align: center;"> 
          <a href="admin_elave_et.php">
            <button  name="umumi_ayarguncelle" class="btn btn-primary btn-block btn-sm">Y E N İ &nbsp &nbsp A D M İ N &nbsp &nbsp Ə L A V Ə &nbsp &nbsp E T</button>
          </a>



        </div>
        <div class="x_content">
         <table id="datatable-responsive" class="table table-striped jambo_table bulk_action table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>№</th>
              <th>IMG</th>
              <th>Adı,Soyadı</th>
              <th>Qeydiyyat tarixi</th>
              <th>E-Mail</th>
              <th>Telefon</th>
              <th>Dövlət</th>
              <th>Şəhər</th>
              <th>Ünvan</th>
              <th>Durum</th>
              <th>Yetgi</th>
              <th>Profil</th>
              <th style="width: 10px;" >Düzəliş</th>
              <th style="width: 10px;">Sil</th>
            </tr>
          </thead>

  <tbody>

          <?php 
          $adminsor=$db->prepare("SELECT * FROM admin");
          $adminsor->execute();
          $say=0;
          while ($admincek=$adminsor->fetch(PDO::FETCH_ASSOC)) {
            $say++;

            ?>
          
              <tr >
                <td scope="row"><?php echo  $say ?></td>
                <td><a href=""><img style="width: 128px; height: 128px;" src="images/adminprofil/<?php
                if(strlen($admincek['admin_profil_img'])>0){
                 echo $admincek['admin_profil_img'];
                 }else{
                  echo'img.png';
                }
                ?>"></a></td>
                <td ><a href="" ><?php echo $admincek['admin_ad_soyad'] ?></a></td>

                <td><a href=""><?php echo $admincek['admin_zaman'] ?></a></td>

                <td><a href=""><?php echo $admincek['admin_mail'] ?></a></td>
                <td><a href=""><?php echo $admincek['admin_gsm'] ?></a></td>
                <td><a href="">
                  <?php  
                  $admin_dovlet=$admincek['admin_dovlet'];
                  $dovletsor=$db->prepare("SELECT * FROM dovlet where dovlet_id=:dovlet_id ");
                  $dovletsor->execute(array(
                    'dovlet_id'=> $admin_dovlet));
                  $dovletcek=$dovletsor->fetch(PDO::FETCH_ASSOC);
                  echo $dovletcek['dovlet_ad']               
                  ?></a>


                </td>
                <td><a href=""><?php echo $admincek['admin_seher'] ?></a></td>
                <td><a href=""><?php echo $admincek['admin_unvan'] ?></a></td>


                <td>

                 <label class="checkbox">
                  <input id="<?php echo $admincek['admin_id']; ?>"
                  <?php if($admincek['admin_durum']==1){
                    echo "checked";
                  }else{
                    echo "";
                  }?>  type="checkbox" onchange="admindurum()"  > 
                  <span class="checkbox"> 
                    <span></span>
                  </span>
                </label>


                
              </td>
              <td><a href="admin_status.php?admin_id=<?php echo $admincek['admin_id'] ?>"><button class="btn btn-primary btn-xs" ><i class="fa fa-pencil"></i> Status</button></a></td>
              <td><a href="profile?admin_id=<?php echo $admincek['admin_id'] ?>" class="btn btn-success btn-xs"><i class="fa fa-edit m-right-xs"></i>Profile</a></td>

              <td><a href="admin_duzenle?admin_id=<?php echo $admincek['admin_id'] ?>"><button class="btn btn-primary btn-xs" ><i class="fa fa-pencil"></i> Düzəliş</button></a></td>

              <td><a href="../nedmin/admin_islem.php?admin_id=<?php echo $admincek['admin_id'] ?>&admin_sil=ok"><button
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