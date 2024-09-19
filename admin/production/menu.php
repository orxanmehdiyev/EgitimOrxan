      <!-- sidebar menu -->
      <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
          <h3>Səyfə tənzimləmələri</h3>
          <ul class="nav side-menu">
            <li><a href="index"><i class="fa fa-home"></i>Əsas Səyfə </a> </li>
            <?php 
            if( $admincek['admin_yetgi_hakkimizda']==1){  ?> 
             <li><a href="hakkimizda"><i class="fa fa-info"></i>Hakkimizda </a> </li> 
           <?php }else{ } ?> 

           
           <li><a><i class="fa fa-users"></i>İstfadəçilər <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
             <?php 
             if( $admincek['adminyetgi2']==1){  ?> 
              <li><a href="admin.php">Admin</a></li>
            <?php } ?> 
            <li><a href="user.php">User</a></li>

          </ul>
        </li> 
        <li><a><i class="fa fa-cogs"></i>Tənzimləmələr <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
           <li><a href="logo.php">Logo</a></li>
           <li><a href="ayar_bakim.php">Bakima alma</a></li>
           <li><a href="ayarlar.php">Ümumi ayarlar</a></li>
           <li><a href="social-ayarlar.php">Sosial ayarlar</a></li>
           <li><a href="elaqe-ayar.php">Əlaqə ayarları</a></li>
           <li><a href="ayar_map.php">Google map</a></li>
           <li><a href="ayar_smtpp.php">SMTP Ayarları</a></li>

           <li><a href="tema.php">Tema</a></li>
         </ul>
       </li> 
       <li><a href="menular"><i class="fa fa-bars"></i>Menu </a> </li> 
       <li><a href="slider"><i class="fa fa-picture-o"></i>Slider </a> </li> 
        <li><a href="program"><i class="fa fa-download"></i>Proqramlar </a> </li> 

         <li><a href="xeberelaveet"><i class="fa fa-download"></i>Yeni Məqalə </a> </li> 
      
       
 


   </ul>
 </div>




 <div class="menu_section">
  <h3>Admin Tənzimləmələri</h3>

</div>

</div>
            <!-- /sidebar menu -->