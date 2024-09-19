<?php 
require_once "header.php";
require_once "menu.php";
$hakkimizdasor=$db->prepare("SELECT * FROM hakkimizda where hakkimizda_id=:hakkimizda_id");
$hakkimizdasor->execute(array(
  'hakkimizda_id'=>0));
$hakkimzdacek=$hakkimizdasor->fetch(PDO::FETCH_ASSOC);


?>




<section id="aa-blog-archive">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="aa-blog-archive-area">
          <div class="row">
              <div class="col-md-5">
              <aside class="aa-blog-sidebar">
                <div class="aa-sidebar-widget" style="width: 460px">
                  <h3>Tanıtım videosu</h3>
                  
                  <iframe  class="col-md-12" height="315" src="https://www.youtube.com/embed/<?php echo $hakkimzdacek['hakkimizda_video'] ?>?start=4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                </div>
                <div class="aa-sidebar-widget">
                  <h3>Məksədimiz</h3>

                  <p><?php echo $hakkimzdacek['hakkimizd_misyon'] ?></p>

                </div>
                
              </aside>
            </div>
            <div class="col-md-7">
              <!-- Blog details -->
              <div class="aa-blog-content aa-blog-details">
                <article class="aa-blog-content-single">                        
                  <h2><a href="#"><?php echo $hakkimzdacek['hakkimizda_baslik'] ?></a></h2>


                  <p><?php echo $hakkimzdacek['hakkimizda_icerik'] ?></p>                


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