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
        <h3>Admin Profil bölümü</h3>
      </div>

      <?php 
      require_once "search.php"
      ?>
    </div>

    <div class="clearfix"></div>
    <div class="row">
      <?php 
      $profil_id=$_GET['admin_id'];
      $profilsor=$db->prepare("SELECT * FROM admin where admin_id=:admin_id");
      $profilsor->execute(array(
        'admin_id'=>$profil_id));
      $profilcek=$profilsor->fetch(PDO::FETCH_ASSOC);
      ?>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2> <small></small></h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
              <div class="profile_img">
                <div id="crop-avatar">
                  <!-- Current avatar -->
                  <img class="img-responsive avatar-view" src="images/adminprofil/<?php
                  if(strlen($admincek['admin_profil_img'])>0){
                     echo $admincek['admin_profil_img'];
                    }else{
                      echo'img.png';
                    }
 ?>" alt="Avatar" title="Change the avatar">
                </div>
              </div>
              <h3><?php echo $profilcek['admin_ad_soyad'] ?></h3>

              <ul class="list-unstyled user_data">
                <li><i class="fa fa-map-marker user-profile-icon"></i>  
                  <?php  
                  $profil_dovlet=$profilcek['admin_dovlet'];
                  $dovletsor=$db->prepare("SELECT * FROM dovlet where dovlet_id=:dovlet_id ");
                  $dovletsor->execute(array(
                    'dovlet_id'=> $profil_dovlet));
                  $dovletcek=$dovletsor->fetch(PDO::FETCH_ASSOC);
                  echo $dovletcek['dovlet_ad']               
                  ?>,<?php echo $profilcek['admin_seher'] ?>, <?php echo $profilcek['admin_unvan'] ?>
                </li>

                <li>
                  <i class="fa fa-briefcase user-profile-icon"></i> <?php echo $profilcek['admin_tehsil'] ?>
                </li>
                <li>
                  <i class="fa fa-at user-profile-icon"></i> <?php echo $profilcek['admin_mail'] ?>
                </li>
                <li>
                  <i class="fa fa-phone user-profile-icon"></i> <?php echo $profilcek['admin_gsm'] ?>
                </li>
            
                   <li>
                  <i class="fa fa-certificate user-profile-icon"></i> <?php echo $profilcek['admin_is'] ?>
                </li>



                <li class="m-top-xs">
                  <i class="fa fa-external-link user-profile-icon"></i>
                  <a href="http://www.kimlabs.com/profile/" target="_blank">www.kimlabs.com</a>
                </li>
              </ul>

              <a <a href="admin_duzenle?admin_id=<?php echo $profilcek['admin_id'] ?>" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
              <br />


            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">



              <div class="" role="tabpanel" data-example-id="togglable-tabs">

                <div id="myTabContent" class="tab-content">
                  <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                    <!-- start recent activity -->
                    <ul class="messages">
                      <li>
                        
                        <div class="message_date">

                        </div>
                        <div class="message_wrapper">
                          <h4 class="heading">Admin Haqqında Qısa Məlumat</h4>
                          <blockquote class="message"><?php echo $profilcek['admin_haqqinda'] ?></blockquote>
                          <br />
                          <p class="url">
                            <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>

                          </p>
                        </div>
                      </li>
                      



                    </ul>
                    <!-- end recent activity -->

                  </div>


                </div>
              </div>
            </div>
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