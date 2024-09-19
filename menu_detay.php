<?php 
require_once "header.php";
require_once "menu.php";
$menu_id=$_GET['menu_id'];
$menudetaysor=$db->prepare("SELECT * FROM menu where menu_id=:menu_id");
$menudetaysor->execute(array(
  'menu_id'=>$menu_id));
$menudetaycek=$menudetaysor->fetch(PDO::FETCH_ASSOC);
$menu_id=$menudetaycek['menu_id'];
?>




<section id="aa-blog-archive">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="aa-blog-archive-area" style=" padding-top: 17px;">
          <div class="row">
            <div class="col-md-12">
              <h2 style="text-align: center;"><?php echo $menudetaycek['menu_ad'] ?></h2>
              <hr style="margin-top: 0px; margin-bottom: 5px;border-top: 2px solid #2A3F54;">
            </div>

          </div>
          <div class="row">
           <div class="col-md-3">


            <?php 
            $altmenusor=$db->prepare("SELECT * FROM menu where menu_ust=:menu_id and menu_durum=:menu_durum order by menu_sira ASC");
            $altmenusor->execute(array(
              'menu_id'=>$menu_id,
              'menu_durum'=>1));
            $say=$altmenusor->rowCount();
            ?>




            <div class="row" style="margin: 0;">
              <h3>Category</h3>             
            </div>
            <br>
            <?php if($say>0){
             while($altmenucek=$altmenusor->fetch(PDO::FETCH_ASSOC)){
               ?>
               <b><a href="<?php  echo "menu".seo($altmenucek['menu_ad']."-".$altmenucek['menu_id']); ?>">-<i class="fa fa-angle-double-right"></i><?php echo $altmenucek['menu_ad'] ?> </a></b>
               <hr style="    margin-top: 5px;
               margin-bottom: 5px;border-top: 1px solid #2A3F54;">
             <?php }} ?>





           </div>
           <div class="col-md-9">
            <!-- Blog details -->
            <div class="aa-blog-content aa-blog-details">
              <article class="aa-blog-content-single">                        



                <p><?php echo $menudetaycek['menu_detay'] ?></p>                


              </article>

            </div>
          </div>

          <!-- blog sidebar -->

        </div>           
      </div>
    </div>
  </div>
</div>
</section>
<!-- / Blog Archive -->
<?php 
require_once "footer.php"
?>