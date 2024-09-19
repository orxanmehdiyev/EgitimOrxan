<?php 
require_once "header.php";
require_once "menu.php";

$proqramkataqorisor=$db->prepare("SELECT * FROM proqramkataqori where proqramkataqori_durum=:proqramkataqori_durum  order by  proqramkataqori_ad ASC");
$proqramkataqorisor->execute(array(
	'proqramkataqori_durum'=>1));

if (isset($_GET['proqramkataqori_id'])) {

  $sayfada = 6; // sayfada gösterilecek içerik miktarını belirtiyoruz.
  $sorgu=$db->prepare("SELECT proqramlar.*,proqramkataqori.* FROM proqramlar INNER JOIN proqramkataqori ON proqramlar.proqramkataqori_id=proqramkataqori.proqramkataqori_id  WHERE proqram_durum=:proqram_durum and proqramkataqori_durum=:proqramkataqori_durum and proqramkataqori.proqramkataqori_id=:proqramkataqori_id");
  $sorgu->execute(array(
  	'proqram_durum' => 1,
  	'proqramkataqori_durum' => 1,
  	'proqramkataqori_id'=>$_GET['proqramkataqori_id']
  ));
  $toplam_icerik=$sorgu->rowCount();
  $toplam_sayfa = ceil($toplam_icerik / $sayfada);
                                     // eğer sayfa girilmemişse 1 varsayalım.
  $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
                                    // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
  if($sayfa < 1) $sayfa = 1; 
                                   // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
  if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
  $limit = ($sayfa - 1) * $sayfada;


  $proqramkataqoriurunsor=$db->prepare("SELECT * FROM proqramkataqori where proqramkataqori_id=:proqramkataqori_id and proqramkataqori_durum=:proqramkataqori_durum  ");
  $proqramkataqoriurunsor->execute(array(
  	'proqramkataqori_id'=>$_GET['proqramkataqori_id'],
  	'proqramkataqori_durum'=>1));
  $proqramkataqoriuruncek=$proqramkataqoriurunsor->fetch(PDO::FETCH_ASSOC);
  $proqramkataqori_id=$proqramkataqoriuruncek['proqramkataqori_id'];
  $programsor=$db->prepare("SELECT * from proqramlar where proqramkataqori_id=:proqramkataqori_id and proqram_durum=:proqram_durum  order by  proqram_id DESC ");
  $programsor->execute(array(
  	'proqramkataqori_id'=>$proqramkataqori_id,
  	'proqram_durum'=>1));


}elseif (isset($_GET['proqram_id'])) {
	$programdetaysor=$db->prepare("SELECT * FROM proqramlar where proqram_id=:proqram_id");
	$programdetaysor->execute(array(
		'proqram_id'=>$_GET['proqram_id']));
	$programdetaycek=$programdetaysor->fetch(PDO::FETCH_ASSOC);
	$proqram_id=$programdetaycek['proqram_id'];
	$programsor=$db->prepare("SELECT * from proqramlar where proqram_id=:proqram_id and proqram_durum=:proqram_durum  order by  proqram_id DESC  ");
	$programsor->execute(array(
		'proqram_id'=>$proqram_id,
		'proqram_durum'=>1));
}


else{  
  $sayfada = 6; // sayfada gösterilecek içerik miktarını belirtiyoruz.
  $sorgu=$db->prepare("SELECT proqramlar.*,proqramkataqori.* FROM proqramlar INNER JOIN proqramkataqori ON proqramlar.proqramkataqori_id=proqramkataqori.proqramkataqori_id  WHERE proqram_durum=:proqram_durum and proqramkataqori_durum=:proqramkataqori_durum");
  $sorgu->execute(array(
  	'proqram_durum' => 1,
  	'proqramkataqori_durum' => 1
  ));
  $toplam_icerik=$sorgu->rowCount();
  $toplam_sayfa = ceil($toplam_icerik / $sayfada);
                                     // eğer sayfa girilmemişse 1 varsayalım.
  $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
                                    // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
  if($sayfa < 1) $sayfa = 1; 
                                   // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
  if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
  $limit = ($sayfa - 1) * $sayfada;
  $programsor=$db->prepare("SELECT proqramlar.*,proqramkataqori.* FROM proqramlar INNER JOIN proqramkataqori ON proqramlar.proqramkataqori_id=proqramkataqori.proqramkataqori_id  WHERE proqram_durum=:proqram_durum and proqramkataqori_durum=:proqramkataqori_durum order by  proqram_id DESC limit $limit,$sayfada");
  $programsor->execute(array(
  	'proqram_durum' => 1,
  	'proqramkataqori_durum' => 1
  ));
}?>
<section id="aa-blog-archive">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="aa-blog-archive-area" style=" padding-top: 17px;">
					<div class="row">
						<div class="col-md-12">
							<h2 style="text-align: center;">
								<?php
								if (isset($_GET['proqram_seourl'])) {
									echo UcWords($programdetaycek['proqram_ad']);
								}else{ ?>
									Proqramla <?php } ?>  
								</h2>
								<hr style="margin-top: 0px; margin-bottom: 5px;border-top: 2px solid #2A3F54;">
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="row" style="margin: 0;">
									<h3>Kateqoriya</h3>             
								</div>
								<?php  
								while ($proqramkataqoricek=$proqramkataqorisor->fetch(PDO::FETCH_ASSOC)) { ?>
									<b><a href="<?php echo 'proqramlar-'.seo($proqramkataqoricek['proqramkataqori_ad'])."-".$proqramkataqoricek['proqramkataqori_id'] ?>">- <i class="fa fa-angle-double-right"> </i> <?php echo UcWords($proqramkataqoricek['proqramkataqori_ad']) ?>  </a></b>
									<hr style=" margin-top: 5px;margin-bottom: 5px;border-top: 1px solid #2A3F54;">
								<?php } ?>
							</div>
							<div class="col-md-9">
								<div class="aa-blog-content aa-blog-details">
									<div class="aa-blog-comment-threat">
										<div class="comments" style="border: 0;">
											<ul class="commentlist"  >
												<?php  
												while ($programcek=$programsor->fetch(PDO::FETCH_ASSOC)) { 
													?>
													<li>
														<?php if (isset($_GET['proqram_id'])) {?>
															<span class="comments-date"></span>
															<p ><img  class="media-object news-img" style="float: left;width: 470px; height: 400px;" src="admin/production/images/program/<?php
															if(strlen($programcek['proqram_img'])>0){
																echo $programcek['proqram_img'];
																}else{
																	echo'img.png';
																}
																?>" alt="img"> <?php 
																echo $programcek['proqram_detay'] ?> 
																<br>
																<a class="reply-btn" target="_blank"  href="<?php
																if(strlen($programcek['program_yol'])>0){?>
																	admin/production/programlar/<?php echo $programcek['program_yol']; ?>
																	<?php }else{
																		echo $programcek['proqram_download_link'];
																	}?>"> Download</a>
																</p> 
															<?php  }else{ ?>
																<h4 class="author-name"><a href="<?php echo 'programdeday-'.seo($programcek['proqram_seourl'])."-".$programcek['proqram_id'] ?>"><?php echo UcWords($programcek['proqram_ad']) ?></a></h4>
																<hr style="margin-top: 0px; margin-bottom: 5px;border-top: 1px solid #2A3F54;">
																<span class="comments-date"><?php 
																$bazatarix= $programcek['proqram_zaman'];
																$zaman = explode(' ', $bazatarix);
																$tarix=$zaman[0];
																$tarix=explode('-',$tarix);
																$tarix=$tarix[2].".".$tarix[1].".".$tarix[0];
																echo $tarix;
																echo "&nbsp &nbsp";
																echo $vatx=$zaman[1];
																?></span>
																<p ><img style="float: left;" class="media-object news-img" src="admin/production/images/program/<?php
																if(strlen($programcek['proqram_img'])>0){
																	echo $programcek['proqram_img'];
																	}else{
																		echo'img.png';
																	}
																	?>" alt="img"> <?php 
																	echo substr($programcek['proqram_detay'],0,550) ?> <br>
																	<a style="color:red; " href="<?php echo 'programdeday-'.seo($programcek['proqram_seourl'])."-".$programcek['proqram_id'] ?>"> davami....</a>
																</p> 
															<?php } ?>
														</li>
													<?php } ?>
												</ul>
											</div>

											<?php if (isset($_GET['proqram_id'])) {

											}else{
												?>
												<div class="aa-blog-archive-pagination">
													<nav>
														<ul class="pagination"  >

															<li onclick='back()'>
																<a id="back" href="#" aria-label="Previous">
																	<span aria-hidden="true">«</span>
																</a>
															</li>

															<?php
															for ($i=1; $i<=$toplam_sayfa; $i++) {
																if ($i==$sayfa) {
																	if($i==$toplam_sayfa){
																		$nexti=$i;
																	}else{
																		$nexti=$i+1;
																	}
																	if($i==1){
																		$backi=$i;
																	}else{
																		$backi=$i-1;
																	}     
																	?>
																	<li onclick='back()'><a style="background-color: #C84C3C; color:white;" href="proqramlar?sayfa=<?php echo $i; ?>"><?php echo $i; ?></a></li>
																<?php } else {?>
																	<li onclick='back()'><a href="proqramlar?sayfa=<?php echo $i; ?>"><?php echo $i; ?></a></li>
																<?php   }
															}; 
															?>
															<script type="text/javascript">
																function back() {  
																	document.getElementById('back').href="proqramlar?sayfa=<?php echo $backi; ?>";
																}
															</script>

															<li >
																<?php 
																$i=$i-1; ?><a  href="proqramlar?sayfa=<?php echo $nexti; ?> " aria-label="Next">
																	<span aria-hidden="true">»</span>
																</a>
															</li>
														</ul>
													</nav>
												</div>


											<?php } ?>

										</div>
									</div>
								</div>
							</div>           
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php 
		require_once "footer.php"
		?>