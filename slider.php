<section id="aa-slider">
  <div class="aa-slider-area">
    <div id="sequence" class="seq">
      <div class="seq-screen">
        <ul class="seq-canvas">
        
            <?php 
            $slidersor=$db->prepare("SELECT * FROM slider where slider_durum=:slider_durum");
            $slidersor->execute(array(
              'slider_durum'=>1));       
      while($slidercek=$slidersor->fetch(PDO::FETCH_ASSOC) ){       

              ?>
          <li>
            <div class="seq-model">
              <img data-seq src="admin/production/images/slider/<?php echo $slidercek['slider_img'] ?>          " alt="Men slide img" />
            </div>
            <div class="seq-title">              
             <h2 data-seq><?php echo $slidercek['slider_ad'] ?></h2>                
             <p data-seq><?php echo $slidercek['slider_teks'] ?></p>            
           </div>
         </li>
      <?php } ?>



    
        <!-- single slide item -->
   
    
                     
      </ul>
    </div>
    <!-- slider navigation btn -->
    <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
      <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
      <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
    </fieldset>
  </div>
</div>
</section>