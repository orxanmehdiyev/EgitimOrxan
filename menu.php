
  <section id="menu">
    <div class="container">
      <div class="menu-area">
        <!-- Navbar -->
        <div class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>          
          </div>
          <div class="navbar-collapse collapse">
            <!-- Left nav -->
            <ul class="nav navbar-nav">
              <?php 
              $menusor=$db->prepare("SELECT * FROM menu where menu_ust=:menu_ust and menu_durum=:menu_durum order by menu_sira ASC");
              $menusor->execute(array(
                'menu_ust'=>0,
                'menu_durum'=>1));
              while($menucek=$menusor->fetch(PDO::FETCH_ASSOC)){
                $menu_id=$menucek['menu_id'];
                $altmenusor=$db->prepare("SELECT * FROM menu where menu_ust=:menu_id and menu_durum=:menu_durum order by menu_sira ASC");
                $altmenusor->execute(array(
                  'menu_id'=>$menu_id,
                  'menu_durum'=>1));
                $say=$altmenusor->rowCount();
                ?>

                <li><a href="<?php
                if(!empty($menucek['menu_url'])){
                 echo $menucek['menu_url'];                 
                 }else{
                 echo "menu".seo($menucek['menu_ad']."-".$menucek['menu_id']);
                 }
                 ?>" >
                 <?php echo $menucek['menu_ad'] ?> <?php if($say>0){ ?>
                   <span class="caret"></span>
                   <?php }?> </a>

                   <?php if($say>0){ ?>
                    <ul  class="dropdown-menu">  
                      <?php                
                      while($altmenucek=$altmenusor->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <li><a href="<?php
                        if(!empty($altmenucek['menu_url'])){
                          echo $altmenucek['menu_url'];                 
                         }    else{
                    echo "menu".seo($altmenucek['menu_ad']."-".$altmenucek['menu_id']); 
                         }
                         ?>"><?php echo $altmenucek['menu_ad'] ?> </a>
                       <?php } ?>
                     </li>
                   </ul>
                 <?php } ?>
                 
               </li> 
             <?php } ?>

           </ul>
         </div>
         <!--/.nav-collapse -->
       </div>
     </div>       
   </div>
 </section>