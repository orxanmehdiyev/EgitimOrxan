 
<!-- footer -->  
<footer id="aa-footer">
  <!-- footer bottom -->
  <div class="aa-footer-top">
   <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="aa-footer-top-area">
          <div class="row">
            <div class="col-md-3 col-sm-6">
              <div class="aa-footer-widget">
                <h3>Main Menu</h3>
                <ul class="aa-footer-nav">
                  <li><a href="#">Home</a></li>
                  <li><a href="#">Our Services</a></li>
                  <li><a href="#">Our Products</a></li>
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="aa-footer-widget">
                <div class="aa-footer-widget">
                  <h3>Knowledge Base</h3>
                  <ul class="aa-footer-nav">
                    <li><a href="#">Delivery</a></li>
                    <li><a href="#">Returns</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Discount</a></li>
                    <li><a href="#">Special Offer</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="aa-footer-widget">
                <div class="aa-footer-widget">
                  <h3>Useful Links</h3>
                  <ul class="aa-footer-nav">
                    <li><a href="#">Site Map</a></li>
                    <li><a href="#">Search</a></li>
                    <li><a href="#">Advanced Search</a></li>
                    <li><a href="#">Suppliers</a></li>
                    <li><a href="#">FAQ</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="aa-footer-widget">
                <div class="aa-footer-widget">
                  <h3><?php echo $ayarcek['ayar_elaqe_basliq'] ?></h3>
                  <address>
                    <p><?php echo $ayarcek['ayar_dovlet'] ?> <?php echo $ayarcek['ayar_seher'] ?> <?php echo $ayarcek['ayar_adres'] ?> </p>
                    <p><span class="fa fa-phone"></span><?php echo $ayarcek['ayar_tel'] ?></p>
                    <p><span class="fa fa-envelope"></span><?php echo $ayarcek['ayar_mail'] ?></p>
                  </address>
                  <div class="aa-footer-social">
                    <a href="<?php echo $ayarcek['ayar_facebook'] ?>" target="_blank"><span class="fa fa-facebook"></span></a>
                    <a href="<?php echo $ayarcek['ayar_twitter'] ?>" target="_blank"><span class="fa fa-twitter"></span></a>
                    <a href="<?php echo $ayarcek['ayar_google'] ?>" target="_blank"><span class="fa fa-google-plus"></span></a>
                    <a href="<?php echo $ayarcek['ayar_youtube'] ?>" target="_blank"><span class="fa fa-youtube"></span></a>
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
<!-- footer-bottom -->
<div class="aa-footer-bottom">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="aa-footer-bottom-area">
          <p>Designed by <a href="">MarkUps.io</a></p>
          <div class="aa-footer-payment">
            <span class="fa fa-cc-mastercard"></span>
            <span class="fa fa-cc-visa"></span>
            <span class="fa fa-paypal"></span>
            <span class="fa fa-cc-discover"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</footer>
<!-- / footer -->

<!-- Login Modal -->  
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">                      
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4>Giriş və ya Qeydiyyat</h4>
        <form class="aa-login-form" action="admin/nedmin/islem.php" method="POST">
          <label for="">İstfadəçi adı və ya Email<span>*</span></label>
          <input type="text" name="kullanici_ad" placeholder="Istifadci adı və ya email">
          <label for="">Şifrə<span>*</span></label>
          <input type="password" name="kullanici_password" placeholder="Password">
          <button class="aa-browse-btn" name="kullanici_giris" type="submit">Giriş</button>
          <label for="rememberme" class="rememberme"><input type="checkbox" id="rememberme"> Məni xatırla </label>
          <p class="aa-lost-password"><a href="unutdum.php">Şifrəni unudunuzmu?</a></p>
          <div class="aa-register-now">
           Hesbaınız yoxmu?<a href="registr.php">Qeydiyat!</a>
          </div>
        </form>
      </div>                        
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>    

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.js"></script>  
<!-- SmartMenus jQuery plugin -->
<script type="text/javascript" src="js/jquery.smartmenus.js"></script>
<!-- SmartMenus jQuery Bootstrap Addon -->
<script type="text/javascript" src="js/jquery.smartmenus.bootstrap.js"></script>  
<!-- To Slider JS -->
<script src="js/sequence.js"></script>
<script src="js/sequence-theme.modern-slide-in.js"></script>  
<!-- Product view slider -->
<script type="text/javascript" src="js/jquery.simpleGallery.js"></script>
<script type="text/javascript" src="js/jquery.simpleLens.js"></script>
<!-- slick slider -->
<script type="text/javascript" src="js/slick.js"></script>
<!-- Price picker slider -->
<script type="text/javascript" src="js/nouislider.js"></script>
<!-- Custom js -->
<script src="js/custom.js"></script> 
<script src="js/oz_javascriptim_on.js"></script>
</body>
</html>