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
        <h3>Səyfənizdə var olan menular</h3>
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
           <b style="color: green"><i class="fa fa-chevron-down"> </i> Menu Silindi</b>
         <?php } elseif($_GET['durum']=='silno'){?>
          <b style="color: red"> <i class="fa fa-times"> </i> Menu Silinmədi</b>
        <?php }elseif($_GET['durum']=='menuok'){?>
          <b style="color: green"><i class="fa fa-chevron-down"> </i> Yeni Menu Əlavə Edildi! Menu durumunu və sırasını aşağıdan seçin</b>
        <?php } else{?>
          <h2>Menuları aşağıdan görə, <small> Əlavə edə bilərsiz</small></h2>
        <?php  }  ?>

        <div class="clearfix"></div>
      </div>

      <div class="x_content">

        <div style="text-align: center;"> 
          <a href="menu_elave_et">
            <button  name="umumi_ayarguncelle" class="btn btn-primary btn-block btn-sm">Y E N İ &nbsp &nbsp M E N U &nbsp &nbsp Ə L A V Ə &nbsp &nbsp E T</button>
          </a>



        </div>
        <div class="x_content">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>№</th>
                <th>Menu adı</th>

                <th>URL</th>
                <th>Seo Link</th>
                <th>Headerdə göstər</th>
                <th>Footerdə göstər</th>
                <th>Durum</th>
                <th style="width: 10px;" >Sıra</th>
                <th style="width: 10px;" >Düzəliş</th>
                <th style="width: 10px;">Sil</th>
              </tr>
            </thead>



            <?php 
            $menusor=$db->prepare("SELECT * FROM menu where menu_ust=:menu_ust order by menu_sira ASC");
            $menusor->execute(array(
              'menu_ust'=>0));
            $say=0;
            while ($menucek=$menusor->fetch(PDO::FETCH_ASSOC)) {
             $menu_id=$menucek['menu_id'];
             $say++;
             $altmenusor=$db->prepare("SELECT * from menu where menu_ust=:menu_id order by menu_sira ASC");
             $altmenusor->execute(array(
              'menu_id'=>$menu_id));
             $say2=$altmenusor->rowCount();
             ?>
             <tbody>
              <tr>
                <th scope="row"><?php echo  $say ?></th>
                <td><a href=""><?php echo $menucek['menu_ad'] ?></a></td>
                <td><a href=""><?php echo $menucek['menu_url'] ?></a></td>
                <td><a href=""><?php echo $menucek['menu_seourl'] ?></a></td>




                <td><input id="<?php echo $menucek['menu_id']; ?>" onchange="kontrol()" type="checkbox" class="js-switch" <?php if($menucek['menu_header_durum']==1){
                  echo "checked";
                }else{
                  echo "";
                }?> /></td>






                <td>
                  <input id="<?php echo $menucek['menu_id']; ?>"  type="checkbox" class="js-switch" onchange="kontrol3()" <?php if($menucek['menu_footer_durum']==1){
                    echo "checked";
                  }else{
                    echo "";
                  }                ?>  />
                </td>
                <td><input id="<?php echo $menucek['menu_id']; ?>" type="checkbox" class="js-switch" onchange="kontrol2()" <?php if($menucek['menu_durum']==1){
                  echo "checked";
                }else{
                  echo "";
                }                ?>  /></td>
                <td>


                  <input style="width: 50px; text-align: center;" id="<?php echo $menucek['menu_id']; ?>" value="<?php echo $menucek['menu_sira']; ?>" onchange="menusira()"  name="" type="number" >








                </td>
                <td><a href="menu_duzenle?menu_id=<?php echo $menucek['menu_id'] ?>"><button class="btn btn-primary btn-xs" ><i class="fa fa-pencil"></i> Düzəliş</button></a></td>
                <td><a href="../nedmin/admin_islem.php?menu_id=<?php echo $menucek['menu_id'] ?>&menu_sil=ok"><button
                  <?php if($say2>0){ ?>
                   onclick="alert('Bu ust menu bunu silerseniz alt menularda siliner')"
                   <?php } ?> class="btn btn-danger btn-xs"><i class="fa fa-trash "></i> Sil</button></a></td>
                 </tr>
               </tbody>



               <?php  



               while ($altmenucek=$altmenusor->fetch(PDO::FETCH_ASSOC)) {
                 $say++
                 ?>
                 <tbody>
                  <tr>
                    <th scope="row"><?php echo  $say ?></th>
                    <th> <i style="color:red;" class="fa fa-chevron-down">****</i><?php echo $altmenucek['menu_ad'] ?></th>

                    <th><?php echo $altmenucek['menu_url'] ?></th>
                    <th><?php echo $altmenucek['menu_seourl'] ?></th>
                    <th>
                      <input id="<?php echo $altmenucek['menu_id']; ?>"
                      type="checkbox"  class="js-switch" onchange="kontrol()" <?php 
                      if($altmenucek['menu_header_durum']==1){
                        echo "checked";
                      }else{
                        echo "";
                      }                ?> /> </th>

                      <th>
                        <input id="<?php echo $altmenucek['menu_id']; ?>" type="checkbox" class="js-switch" onchange="kontrol3()" <?php if($altmenucek['menu_footer_durum']==1){
                          echo "checked";
                        }else{
                          echo "";
                        }                ?>  />
                      </th>


                      <script type="text/javascript">




                      </script>
                      <td><input id="<?php echo $altmenucek['menu_id']; ?>" type="checkbox" class="js-switch" onchange="kontrol2()" <?php if($altmenucek['menu_durum']==1){
                        echo "checked";
                      }else{
                        echo "";
                      }                ?>  /></td>
                      <td> 
                       <input style="width: 50px; text-align: center;" id="<?php echo $altmenucek['menu_id']; ?>" value="<?php echo $altmenucek['menu_sira']; ?>" onchange="menusira()"  name="" type="number" >
                     </td>
                     <td><a href="menu_duzenle?menu_id=<?php echo $altmenucek['menu_id'] ?>"><button class="btn btn-primary btn-xs" > <i class="fa fa-pencil"></i> Düzəliş</button></a></td>
                     <td><a href="../nedmin/admin_islem.php?menu_id=<?php echo $altmenucek['menu_id'] ?>&menu_sil=ok"><button  class="btn btn-danger btn-xs"><i class="fa fa-trash "></i> Sil</button></a></td>
                   </tr>
                 </tbody>

                 <script type="text/javascript">

                 </script>
               <?php } }   ?>

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