	<?php 
	ob_start();
	session_start();
	require_once 'baglan.php'; 
	require_once '../production/fonksiyon.php';

	if (isset($_POST['tema'])) {
		$ayarkaydet=$db->prepare("UPDATE ayar SET	
			theme=:theme
			WHERE ayar_id=0");
		$update=$ayarkaydet->execute(array(		
			'theme' =>$_POST['theme']
		));
		if ($update) {
			header("Location:../production/tema.php?durum=ok");
		} 
		else {
			header("Location:../production/tema.php?durum=no");
		}
	}

	/*===========================================Admin Giriş başlayır=============================================*/
	


	if (isset($_POST['amdin_giris'])) {
		$admin_giris_ad=$_POST['admin_giris_ad'];
		$admin_password=md5($_POST['admin_password']);

		$adminsor=$db->prepare("SELECT * FROM admin where admin_durum=:admin_durum and admin_password=:admin_password and admin_istifateci_ad=:admin_istifateci_ad or admin_mail=:admin_mail and admin_durum=:admin_durum and admin_password=:admin_password ");
		$adminsor->execute(array(
			'admin_durum'=>1,
			'admin_password'=>$admin_password,
			'admin_istifateci_ad'=>$admin_giris_ad,
			'admin_mail'=>$admin_giris_ad
		));
		$adminsay=$adminsor->rowCount();
		if ($adminsay==1) {
			$_SESSION['admin_giris']=$admin_giris_ad;
			header("Location:../production/index.php");
		}else{	header("Location:../production/login.php?durum=no");
	}
}


/*===========================================Admin Giriş bitir================================================*/







/*==========================================Logo əlave et başlayır==============================*/
if (isset($_POST['logoelaveet'])) {
	$uploads_dir = '../production/images/logo';
	@$tmp_name = $_FILES['ayar_logo']["tmp_name"];
	@$name = $_FILES['ayar_logo']["name"];

	$avtoad=uniqid();
	$refimgyol=substr($uploads_dir, 32).$avtoad.$name;
	if($_FILES['ayar_logo']["size"]>0){

		@move_uploaded_file($tmp_name, "$uploads_dir/$avtoad$name");	
		$duzenle=$db->prepare("UPDATE ayar SET
			ayar_logo=:ayar_logo
			WHERE ayar_id=0");
		$update=$duzenle->execute(array(
			'ayar_logo' => $refimgyol
		));

		if ($update) {
			$resimsilunlink=$_POST['eski_yol'];
			unlink("../production/images/logo/$resimsilunlink");
			Header("Location:../production/logo.php?durum=ok");
		} else {
			Header("Location:../production/logo.php?durum=no");
		}
	}else {
		Header("Location:../production/logo.php");
	}
}
/*==========================================Logo əlave et bitir==============================*/


/*=================================Menu Əlavə et başlayır====================================*/
if(isset($_POST['menu_elave_et'])){	
	$menu_seourl=seo($_POST['menu_ad']);
	$kaydet=$db->prepare("INSERT INTO menu SET 
		menu_ust=:menu_ust, 
		menu_ad=:menu_ad,
		menu_url=:menu_url,	
		menu_detay=:menu_detay,
		menu_seourl=:menu_seourl");
	$insert=$kaydet->execute(array(
		'menu_ust'=>$_POST['menu_ust'],
		'menu_ad'=>$_POST['menu_ad'],
		'menu_url'=>$_POST['menu_url'],	
		'menu_detay'=>$_POST['menu_detay'],						
		'menu_seourl'=>$menu_seourl
	));
	if($insert){
		header("Location:../production/menular?durum=menuok");
	}
	else{
		header("Location:../production/menu_elave_et?durum=no");
	}
}	

/*================================Menu Əlavə et bitir======================================*/



/*==================================Menu Duzenle baslayir==================================*/
if(isset($_POST['menu_duzenle'])){
	$menu_id=$_POST['menu_id'];
	$menu_detay=strlen($_POST['menu_detay']);
	$menu_seourl=seo($_POST['menu_ad']);
	$kaydet=$db->prepare("UPDATE menu SET 
		menu_ust=:menu_ust,
		menu_ad=:menu_ad,
		menu_url=:menu_url,	
		menu_detay=:menu_detay,
		menu_seourl=:menu_seourl
		WHERE menu_id=$menu_id");
	$update=$kaydet->execute(array(
		'menu_ust'=>$_POST['menu_ust'],
		'menu_ad'=>$_POST['menu_ad'],
		'menu_url'=>$_POST['menu_url'],	
		'menu_detay'=>$_POST['menu_detay'],
		'menu_seourl'=>$menu_seourl
	));
	if($update){
		header("Location:../production/menu_duzenle.php?durum=ok&menu_id=$menu_id");
	}
	else{
		header("Location:../production/menu_duzenle.php?durum=no&menu_id=$menu_id");
	}
}	
/*=================================Menu Duzenle bitir====================================*/



/*===================================Menu sil baslayir====================================*/
if ($_GET['menu_sil']=="ok") {
	$sil=$db->prepare("DELETE from menu WHERE menu_id=:menu_id");
	$kontrol=$sil->execute(array(
		'menu_id'=>$_GET['menu_id']));
	if($kontrol){
		header("Location:../production/menular.php?durum=silok");
	}else{
		header("Location:../production/menular.php?durum=silno");
	}
	if($kontrol){
		$sil=$db->prepare("DELETE from menu WHERE menu_ust=:menu_ust");
		$kontrol=$sil->execute(array(
			'menu_ust'=>$_GET['menu_id']));
		if($update){
			header("Location:../production/menular.php?durum=silok");
		}
	}else{
		header("Location:../production/menular.php?durum=silno");
	}
}
/*==================================Menu sil bitir=======================================*/



/*==============================Hederda goster baslayir=======================*/
if (isset($_POST['menu_header_durum'])) {
	$menu_id=$_POST['menu_header_durum'];
	$menusor=$db->prepare("SELECT * FROM menu where menu_id=:menu_id");
	$menusor->execute(array(
		'menu_id'=>$menu_id));
	$menucek=$menusor->fetch(PDO::FETCH_ASSOC); 
	if($menucek['menu_header_durum']==1){
		$menu_header_durum=0;
	}elseif($menucek['menu_header_durum']==0){
		$menu_header_durum=1;
	}
	$menukaydet=$db->prepare("UPDATE menu SET
		menu_header_durum=:menu_header_durum
		WHERE menu_id=$menu_id");
	$update=$menukaydet->execute(array(
		'menu_header_durum' => $menu_header_durum
	));
}
/*=============================Hederda goster bitir==================================*/



/*==============================Menu durum başlayır==================================*/
if(isset($_POST['menu_durum'])){
	$menu_id=$_POST['menu_durum'];
	$menusor=$db->prepare("SELECT * FROM menu where menu_id=:menu_id");
	$menusor->execute(array(
		'menu_id'=>$menu_id));
	$menucek=$menusor->fetch(PDO::FETCH_ASSOC);
	if($menucek['menu_durum']==1){
		$menu_durum=0;
	}elseif($menucek['menu_durum']==0){
		$menu_durum=1;
	}
	$menukaydet=$db->prepare("UPDATE menu SET
		menu_durum=:menu_durum
		WHERE menu_id=$menu_id
		");
	$update=$menukaydet->execute(array(
		'menu_durum'=>$menu_durum
	));
	if($update){
		header("Location:../production/menu_duzenle.php?durum=ok&menu_id=$menu_id");
	}
	else{
		header("Location:../production/menu_duzenle.php?durum=no&menu_id=$menu_id");
	}
}
/*====================================Menu durum Bitir==============================*/





/*===========================Menu footerda goster baslayir================================*/
if(isset($_POST['menusira_id'])){
	$menu_id=$_POST['menusira_id'];
	$menu_sira=$_POST['menusira_value'];
	$menukaydet=$db->prepare("UPDATE menu SET
		menu_sira=:menu_sira
		WHERE menu_id=$menu_id
		");
	$update=$menukaydet->execute(array(
		'menu_sira'=>$menu_sira
	));
}
/*=================================Menu footerda goster Bitir=================================*/



/*=================================Haqqimizda yenilə başlayır=====================================*/
if(isset($_POST['hakkimizd_yenile'])){
	$kaydet=$db->prepare("UPDATE hakkimizda SET 
		hakkimizda_baslik=:hakkimizda_baslik,
		hakkimizd_misyon=:hakkimizd_misyon,
		hakkimizda_icerik=:hakkimizda_icerik,
		hakkimizda_video=:hakkimizda_video
		WHERE hakkimizda_id=0");
	$update=$kaydet->execute(array(
		'hakkimizda_baslik'=>$_POST['hakkimizda_baslik'],
		'hakkimizd_misyon'=>$_POST['hakkimizd_misyon'],
		'hakkimizda_icerik'=>$_POST['hakkimizda_icerik'],
		'hakkimizda_video'=>$_POST['hakkimizda_video']
	));
	if($update){
		header("Location:../production/hakkimizda.php?durum=ok");
	}
	else{
		header("Location:../production/hakkimizda.php?durum=no");
	}
}	
/*=================================Haqqimizda yenilə Bitir=====================================*/


/*=================================Admin Əlavə et başlayır===============================*/
if(isset($_POST['admin_elave_et'])){
	$admin_istifateci_ad=$_POST['admin_istifateci_ad'];
	$admin_mail=$_POST['admin_mail'];
	$admin_gsm=$_POST['admin_gsm'];
	$password1=$_POST['password1'];
	$password2=$_POST['password2'];
	$admin_mail_testik_kod_hazirlama=uniqid();
	$admin_mail_testik_kod=substr($admin_mail_testik_kod_hazirlama,7);
	if ($password2==$password1) {
		$adminsor=$db->prepare("SELECT * FROM admin where admin_istifateci_ad=:admin_istifateci_ad or admin_mail=:admin_mail or admin_gsm=:admin_gsm ");
		$adminsor->execute(array(
			'admin_istifateci_ad'=>$admin_istifateci_ad,
			'admin_mail'=>$admin_mail,
			'admin_gsm'=>$admin_gsm
		));	
		$adminkaydisor=$adminsor->rowCount();
		if($adminkaydisor==0){
			$kaydet=$db->prepare("INSERT INTO admin SET 
				admin_istifateci_ad=:admin_istifateci_ad,
				admin_mail=:admin_mail,
				admin_password=:admin_password,
				admin_gsm=:admin_gsm,
				admin_ad_soyad=:admin_ad_soyad,
				admin_dovlet=:admin_dovlet,
				admin_seher=:admin_seher,
				admin_unvan=:admin_unvan,
				admin_tehsil=:admin_tehsil,
				admin_is=:admin_is,
				admin_haqqinda=:admin_haqqinda,
				admin_mail_testik_kod=:admin_mail_testik_kod
				");
			$insert=$kaydet->execute(array(
				'admin_istifateci_ad'=>$admin_istifateci_ad,
				'admin_mail'=>$admin_mail,
				'admin_password'=>md5($password1),
				'admin_gsm'=>$admin_gsm,
				'admin_ad_soyad'=>$_POST['admin_ad_soyad'],
				'admin_dovlet'=>$_POST['admin_dovlet'],
				'admin_seher'=>$_POST['admin_seher'],
				'admin_unvan'=>$_POST['admin_unvan'],
				'admin_tehsil'=>$_POST['admin_tehsil'],
				'admin_is'=>$_POST['admin_is'],
				'admin_haqqinda'=>$_POST['admin_haqqinda'],
				'admin_mail_testik_kod'=>$admin_mail_testik_kod

			));
			if($insert){
				header("Location:../production/admin_elave_et.php?durum=ok");
			}
			else{
				header("Location:../production/admin_elave_et.php?durum=no");
			}
		}else{
			echo "string";
		}
	}
}
/*===================================Admin Əlavə et bitir=========================================*/




/*=====================================Admin düzəliş et başlayır==========================================*/
if(isset($_POST['admin_duzenle'])){
	$admin_id=$_POST['admin_id'];
	$admin_istifateci_ad=$_POST['admin_istifateci_ad'];
	$admin_mail=$_POST['admin_mail'];
	$admin_gsm=$_POST['admin_gsm'];
	$adminsor=$db->prepare("SELECT * FROM admin where admin_istifateci_ad=:admin_istifateci_ad  ");
	$adminsor->execute(array(
		'admin_istifateci_ad'=>$admin_istifateci_ad
	));	
	$admincek=$adminsor->fetch(PDO::FETCH_ASSOC);
	$adminkaydisor=$adminsor->rowCount();
	if($adminkaydisor==1 && $admin_id==$admincek['admin_id'] ){
		$adminkaydisort=1;
	}
	elseif($adminkaydisor==0){
		$adminkaydisort=1;
	}else{
		header("Location:../production/admin_duzenle.php?durum=advar&admin_id=$admin_id");
	}
	if($adminkaydisort==1  ){
		$adminsor1=$db->prepare("SELECT * FROM admin where admin_mail=:admin_mail ");
		$adminsor1->execute(array(			
			'admin_mail'=>$admin_mail
		));	
		$admincek1=$adminsor1->fetch(PDO::FETCH_ASSOC);
		$adminkaydisor1=$adminsor1->rowCount();
		if($adminkaydisor1==1 && $admin_id==$admincek1['admin_id'] ){
			$adminkaydisort1=1;
		}
		elseif($adminkaydisor1==0){
			$adminkaydisort1=1;
		}else{
			header("Location:../production/admin_duzenle.php?durum=mailvar&admin_id=$admin_id");
		}
		if($adminkaydisort1==1){
			$adminsor2=$db->prepare("SELECT * FROM admin where admin_gsm=:admin_gsm ");
			$adminsor2->execute(array(			
				'admin_gsm'=>$admin_gsm
			));	
			$admincek2=$adminsor2->fetch(PDO::FETCH_ASSOC);
			$adminkaydisor2=$adminsor2->rowCount();
			if($adminkaydisor2==1 && $admin_id==$admincek2['admin_id'] ){
				$adminkaydisort2=1;
			}
			elseif($adminkaydisor2==0){
				$adminkaydisort2=1;
			}else{
				header("Location:../production/admin_duzenle.php?durum=telvar&admin_id=$admin_id");
			}
			if($adminkaydisort2==1){
				$kaydet=$db->prepare("UPDATE admin SET 
					admin_istifateci_ad=:admin_istifateci_ad,
					admin_mail=:admin_mail,
					admin_password=:admin_password,
					admin_gsm=:admin_gsm,
					admin_ad_soyad=:admin_ad_soyad,
					admin_dovlet=:admin_dovlet,
					admin_seher=:admin_seher,
					admin_unvan=:admin_unvan,
					admin_tehsil=:admin_tehsil,
					admin_is=:admin_is,
					admin_haqqinda=:admin_haqqinda
					WHERE admin_id=$admin_id
					");
				$insert=$kaydet->execute(array(
					'admin_istifateci_ad'=>$admin_istifateci_ad,
					'admin_mail'=>$admin_mail,
					'admin_password'=>md5($password1),
					'admin_gsm'=>$admin_gsm,
					'admin_ad_soyad'=>$_POST['admin_ad_soyad'],
					'admin_dovlet'=>$_POST['admin_dovlet'],
					'admin_seher'=>$_POST['admin_seher'],
					'admin_unvan'=>$_POST['admin_unvan'],
					'admin_tehsil'=>$_POST['admin_tehsil'],
					'admin_is'=>$_POST['admin_is'],
					'admin_haqqinda'=>$_POST['admin_haqqinda']
				));
				if($insert){
					header("Location:../production/admin_duzenle.php?durum=ok&admin_id=$admin_id");
				}
				else{
					header("Location:../production/admin_duzenle?durum=no&admin_id=$admin_id");
				}
			}
		}
	}
}
/*===============================Admin düzəliş et bitir==============================================*/



/*====================================Admin sil baslayir====================================*/
if ($_GET['admin_sil']=="ok") {
	$sil=$db->prepare("DELETE from admin WHERE admin_id=:admin_id");
	$kontrol=$sil->execute(array(
		'admin_id'=>$_GET['admin_id']));
	if($kontrol){
		header("Location:../production/admin.php?durum=silok");
	}else{
		header("Location:../production/admin.php?durum=silno");
	}
}
/*====================================Admin sil bitir==========================================*/



/*============================Admin Şifrə süzəmlə başlayır====================================*/
if(isset($_POST['admin_sifre_duzenle'])){
	$admin_id=$_POST['admin_id'];
	$passwordkohne=md5($_POST['passwordkohne']);
	$password1=$_POST['password1'];
	$password2=$_POST['password2'];
	if ($password2==$password1) {
		$adminsor=$db->prepare("SELECT * FROM admin where admin_id=:admin_id ");
		$adminsor->execute(array(
			'admin_id'=>$admin_id
		));	
		$admincek=$adminsor->fetch(PDO::FETCH_ASSOC);
		if($passwordkohne==$admincek['admin_password']){
			$kaydet=$db->prepare("UPDATE admin SET 				
				admin_password=:admin_password
				where admin_id=$admin_id
				");
			$insert=$kaydet->execute(array(				
				'admin_password'=>md5($password1)
			));	
		}else{
			header("Location:../production/admin_sifre_duzenle.php?durum=eskisifreno&admin_id=$admin_id");
		}if($insert){
			header("Location:../production/admin_sifre_duzenle.php?durum=sifreok&admin_id=$admin_id");
		}
	}else{
		header("Location:../production/admin_sifre_duzenle.php?durum=sifreno&admin_id=$admin_id");
	}
}
/*============================Admin Şifrə süzəmlə bitir====================================*/





/*==============================Admin istifadeci ad kontrol baslayir================================*/
if(isset($_POST['admin_istifateci_ad'])){
	$admin_istifateci_ad=$_POST['admin_istifateci_ad'];
	$adminsor=$db->prepare("SELECT * FROM admin where admin_istifateci_ad=:admin_istifateci_ad ");
	$adminsor->execute(array(
		'admin_istifateci_ad'=>$admin_istifateci_ad,
	));	
	$adminkayidsor=$adminsor->rowCount();	
	if($adminkayidsor==0){
	}else{
		echo " Bu istifadçi adı mövçüdur xaiş edirik başaq ad secin";
	}
}
/*==========================================Admin istifadeci ad kontrol bitir================================*/


/*==========================================Admin email kontrol baslayir================================*/
if(isset($_POST['admin_email'])){
	$admin_email=$_POST['admin_email'];
	$adminsor=$db->prepare("SELECT * FROM admin where admin_mail=:admin_mail ");
	$adminsor->execute(array(
		'admin_mail'=>$admin_email,
	));	
	$sor=$adminsor->rowCount();
	if($sor==0){
	}else{
		echo " Bu e-mail artıq alinib! Xaiş edirik başaq e-mail secin";
	}
}
/*==========================================Admin email kontrol bitir================================*/




/*==========================================Admin telefon kontrol baslayir================================*/
if(isset($_POST['admin_gsm'])){
	$admin_gsm=$_POST['admin_gsm'];
	$adminsor=$db->prepare("SELECT * FROM admin where admin_gsm=:admin_gsm ");
	$adminsor->execute(array(
		'admin_gsm'=>$admin_gsm,
	));	
	$sor=$adminsor->rowCount();
	if($sor==0){
	}else{
		echo "Bu telefon nömrəsi qeydiyyatdan keçib! Xaiş edirik başaq nömrə secəsiniz";
	}
}
/*==========================================Admin telefon kontrol bitir================================*/



/*==========================================Admin durum baslayir================================*/
if (isset($_POST['admin_durum'])) {
	$admin_id=$_POST['admin_durum'];
	$adminsor=$db->prepare("SELECT * FROM admin where admin_id=:admin_id");
	$adminsor->execute(array(
		'admin_id'=>$admin_id));
	$admincek=$adminsor->fetch(PDO::FETCH_ASSOC); 
	if($admincek['admin_durum']==1){
		$admin_durum=0;
	}elseif($admincek['admin_durum']==0){
		$admin_durum=1;
	}
	$kaydet=$db->prepare("UPDATE admin SET
		admin_durum=:admin_durum
		WHERE admin_id=$admin_id");
	$update=$kaydet->execute(array(
		'admin_durum' => $admin_durum
	));
}
/*==========================================Admin durum bitir================================*/


/*==========================================Admin header yetgi baslayir================================*/
if (isset($_POST['adminhakkimizdayetgi'])) {
	$admin_id=$_POST['adminhakkimizdayetgi'];
	$adminsor=$db->prepare("SELECT * FROM admin where admin_id=:admin_id");
	$adminsor->execute(array(
		'admin_id'=>$admin_id));
	$admincek=$adminsor->fetch(PDO::FETCH_ASSOC); 
	if($admincek['admin_yetgi_hakkimizda']==1){
		$admin_yetgi_hakkimizda=0;
	}elseif($admincek['admin_yetgi_hakkimizda']==0){
		$admin_yetgi_hakkimizda=1;
	}
	$kaydet=$db->prepare("UPDATE admin SET
		admin_yetgi_hakkimizda=:admin_yetgi_hakkimizda
		WHERE admin_id=$admin_id");
	$update=$kaydet->execute(array(
		'admin_yetgi_hakkimizda' => $admin_yetgi_hakkimizda
	));
}
/*==========================================Admin headeryetgi bitir================================*/



/*==========================================Admin headeryetgi baslayir================================*/
if (isset($_POST['adminyetgiiki_ad'])) {
	$admin_id=$_POST['adminyetgiiki_ad'];
	$adminsor=$db->prepare("SELECT * FROM admin where admin_id=:admin_id");
	$adminsor->execute(array(
		'admin_id'=>$admin_id));
	$admincek=$adminsor->fetch(PDO::FETCH_ASSOC); 
	if($admincek['adminyetgi2']==1){
		$adminyetgi2=0;
	}elseif($admincek['adminyetgi2']==0){
		$adminyetgi2=1;
	}
	$kaydet=$db->prepare("UPDATE admin SET
		adminyetgi2=:adminyetgi2
		WHERE admin_id=$admin_id");
	$update=$kaydet->execute(array(
		'adminyetgi2' => $adminyetgi2
	));
}
/*==========================================Admin headeryetgi bitir================================*/



/*==========================================Admin Şəkil əlave et başlayır==============================*/
if (isset($_POST['adminsekilduzenle'])) {
	$admin_id=$_POST['admin_id'];
	$uploads_dir = '../production/images/adminprofil';
	@$tmp_name = $_FILES['admin_profil_img']["tmp_name"];
	@$name = $_FILES['admin_profil_img']["name"];
	$avtoad=uniqid();
	$refimgyol=substr($uploads_dir, 32).$avtoad.$name;
	if($_FILES['admin_profil_img']["size"]>0){
		@move_uploaded_file($tmp_name, "$uploads_dir/$avtoad$name");	
		$duzenle=$db->prepare("UPDATE admin SET
			admin_profil_img=:admin_profil_img
			WHERE admin_id=$admin_id");
		$update=$duzenle->execute(array(
			'admin_profil_img' => $refimgyol
		));
		if ($update) {
			$resimsilunlink=$_POST['eski_yol'];
			unlink("../production/images/adminprofil/$resimsilunlink");
			Header("Location:../production/admin_sekil_elave_et.php?durum=ok&admin_id=$admin_id");
		} else {
			Header("Location:../production/admin_sekil_elave_et.php?durum=no");
		}
	}else {
		Header("Location:../production/admin_sekil_elave_et.php?admin_id=$admin_id");
	}
}
/*==========================================Admin Şəkil əlave et bitir==============================*/



/*==========================================Slider əlave et başlayır==============================*/
if (isset($_POST['sliderelaveet'])) {
	$uploads_dir = '../production/images/slider';
	@$tmp_name = $_FILES['slider_img']["tmp_name"];
	@$name = $_FILES['slider_img']["name"];
	$avtoad=uniqid();
	$refimgyol=substr($uploads_dir, 32).$avtoad.$name;
	if($_FILES['slider_img']["size"]>0){
		@move_uploaded_file($tmp_name, "$uploads_dir/$avtoad$name");
		$slider_seourl=seo($_POST['slider_ad']);
		$kaydet=$db->prepare("INSERT INTO slider SET 
			slider_ad=:slider_ad,
			slider_teks=:slider_teks,
			slider_seourl=:slider_seourl,	
			slider_img=:slider_img");
		$insert=$kaydet->execute(array(
			'slider_ad'=>StrToUpper($_POST['slider_ad']),
			'slider_teks'=>$_POST['slider_teks'],
			'slider_seourl'=>$slider_seourl,						
			'slider_img'=>$refimgyol
		));
	}if($insert){
		header("Location:../production/sliderelaveet.php?durum=ok");
	}
	else{
		header("Location:../production/sliderelaveet.php?durum=no");
	}
}
/*==========================================Slider əlave et bitir==============================*/





/*==========================================slider durum baslayir================================*/
if (isset($_POST['slider_durum'])) {
	$slider_id=$_POST['slider_durum'];
	$slidersor=$db->prepare("SELECT * FROM slider where slider_id=:slider_id");
	$slidersor->execute(array(
		'slider_id'=>$slider_id));
	$slidercek=$slidersor->fetch(PDO::FETCH_ASSOC); 
	if($slidercek['slider_durum']==1){
		$slider_durum=0;
	}elseif($slidercek['slider_durum']==0){
		$slider_durum=1;
	}
	$kaydet=$db->prepare("UPDATE slider SET
		slider_durum=:slider_durum
		WHERE slider_id=$slider_id");
	$update=$kaydet->execute(array(
		'slider_durum' => $slider_durum
	));
}
/*==========================================slider durum bitir================================*/




/*====================================Slider sil baslayir====================================*/
if ($_GET['slider_sil']=="ok") {
	$sil=$db->prepare("DELETE from slider WHERE slider_id=:slider_id");
	$kontrol=$sil->execute(array(
		'slider_id'=>$_GET['slider_id']));
	if($kontrol){
		$resimsilunlink=$_GET['slider_img'];
		unlink("../production/images/slider/$resimsilunlink");
		header("Location:../production/slider?durum=silok");
	}else{
		header("Location:../production/slider.php?durum=silno");
	}
}
/*====================================Slider sil bitir==========================================*/



/*==========================================Slider duzenle başlayır==============================*/
if (isset($_POST['sliderduzenle'])) {
	$slider_id=$_POST['slider_id'];
	if($_FILES['slider_img']["size"]>0){
		$uploads_dir = '../production/images/slider';
		@$tmp_name = $_FILES['slider_img']["tmp_name"];
		@$name = $_FILES['slider_img']["name"];
		$avtoad=uniqid();
		$refimgyol=substr($uploads_dir, 32).$avtoad.$name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$avtoad$name");
		$slider_seourl=seo($_POST['slider_ad']);
		$kaydet=$db->prepare("UPDATE slider SET 
			slider_ad=:slider_ad,
			slider_teks=:slider_teks,
			slider_seourl=:slider_seourl,
			slider_durum=:slider_durum,	
			slider_img=:slider_img
			WHERE slider_id=$slider_id");
		$update=$kaydet->execute(array(
			'slider_ad'=>StrToUpper($_POST['slider_ad']),
			'slider_teks'=>$_POST['slider_teks'],
			'slider_seourl'=>$slider_seourl,	
			'slider_durum'=>0,					
			'slider_img'=>$refimgyol
		));
		if ($update) {
			$resimsilunlink=$_POST['eski_yol'];
			unlink("../production/images/slider/$resimsilunlink");
			Header("Location:../production/slider_duzenle.php?durum=ok&slider_id=$slider_id");
		} else {
			Header("Location:../production/slider_duzenle.php?durum=no&slider_id=$slider_id");
		}
	}else{
		$slider_seourl=seo($_POST['slider_ad']);
		$kaydet=$db->prepare("UPDATE slider SET 
			slider_ad=:slider_ad,
			slider_teks=:slider_teks,
			slider_seourl=:slider_seourl,
			slider_durum=:slider_durum
			WHERE slider_id=$slider_id");
		$update=$kaydet->execute(array(
			'slider_ad'=>StrToUpper($_POST['slider_ad']),
			'slider_teks'=>$_POST['slider_teks'],
			'slider_seourl'=>$slider_seourl	,
			'slider_durum'=>0
		));if ($update) {
			Header("Location:../production/slider_duzenle.php?durum=ok&slider_id=$slider_id");
		} else {
			Header("Location:../production/slider_duzenle.php?durum=no&slider_id=$slider_id");
		}
	}
}
/*==========================================Slider duzenle bitir==============================*/





/*==========================================Proqram əlave et başlayır==============================*/
if (isset($_POST['program_elave_et'])) {
	if($_POST['proqram_kataqori']==0){

		$proqramkataqori_ad=StrToLower($_POST['proqram_kataqori_yeni']);
		$proqramkataqorisor=$db->prepare("SELECT * FROM proqramkataqori where proqramkataqori_ad=:proqramkataqori_ad ");
		$proqramkataqorisor->execute(array(			
			'proqramkataqori_ad'=>$proqramkataqori_ad
		));				
		$proqramkataqoricek=$proqramkataqorisor->fetch(PDO::FETCH_ASSOC);
		$proqramkataqorisay=$proqramkataqorisor->rowCount();
		if($proqramkataqorisay==0){
			$proqramkataqori_seourl=seo(StrToLower($_POST['proqram_kataqori_yeni']));
			$kaydet=$db->prepare("INSERT INTO proqramkataqori SET 
				proqramkataqori_ad=:proqramkataqori_ad,
				proqramkataqori_seourl=:proqramkataqori_seourl");
			$insert=$kaydet->execute(array(
				'proqramkataqori_ad'=>StrToLower($_POST['proqram_kataqori_yeni']),
				'proqramkataqori_seourl'=>md5($proqramkataqori_seourl)
			));
			if($insert){
				$stmt = $db->query("SELECT LAST_INSERT_ID()");
				$proqramkataqori_id = $stmt->fetchColumn();
			}else{
				header("Location:../production/program_elave_et?durum=kataqori");
				exit;
			}
		}else{
			$proqramkataqori_id=$proqramkataqoricek['proqramkataqori_id'];
		}
	}else{
		$proqramkataqori_id= $_POST['proqram_kataqori'];
	}

	if($_FILES['program_yol']["size"]>0){
		$uploads_program = '../production/programlar';
		@$tmp_name_program = $_FILES['program_yol']["tmp_name"];
		@$name_program = $_FILES['program_yol']["name"];
		$tip = $_FILES['program_yol']['type'];
		$uzanti = explode('.', $name_program);
		$ad=$uzanti[0];
		$uzanti = $uzanti[count($uzanti)-1];
		$avtoadp=uniqid();
		$yeniad=$ad."-".$avtoadp.".".$uzanti;
		$program_yol=$yeniad;
		@move_uploaded_file($tmp_name_program, "$uploads_program/$yeniad");
	}
	else{
		$program_yol=$_FILES['program_yol']["name"];

	}		

	if($_FILES['proqram_img']["size"]>0){
		$uploads_dir = '../production/images/program';
		@$tmp_name = $_FILES['proqram_img']["tmp_name"];
		@$name = $_FILES['proqram_img']["name"];
		$avtoad=uniqid();
		$refimgyol=substr($uploads_dir, 32).$avtoad.$name;

		@move_uploaded_file($tmp_name, "$uploads_dir/$avtoad$name");
		$proqram_seourl=seo($_POST['proqram_ad']);
		$kaydet=$db->prepare("INSERT INTO proqramlar SET 
			proqram_ad=:proqram_ad,
			proqram_img=:proqram_img,
			program_yol=:program_yol,
			proqram_download_link=:proqram_download_link,
			proqram_seourl=:proqram_seourl,				
			proqram_detay=:proqram_detay,
			proqramkataqori_id=:proqramkataqori_id");
		$insert=$kaydet->execute(array(
			'proqram_ad'=>StrToLower($_POST['proqram_ad']),
			'proqram_img'=>$refimgyol,
			'program_yol'=>$program_yol,
			'proqram_download_link'=>$_POST['proqram_download_link'],		
			'proqram_seourl'=>$proqram_seourl,
			'proqram_detay'=>$_POST['proqram_detay'],		
			'proqramkataqori_id'=>$proqramkataqori_id
		));if($insert){
			header("Location:../production/program.php?durum=peok");
		}
		else{
			header("Location:../production/program_elave_et.php?durum=peno");
		}
	}else{$proqram_seourl=seo($_POST['proqram_ad']);
	$kaydet=$db->prepare("INSERT INTO proqramlar SET 
		proqram_ad=:proqram_ad,
		proqram_download_link=:proqram_download_link,
		proqram_seourl=:proqram_seourl,				
		proqram_detay=:proqram_detay,
		proqramkataqori_id=:proqramkataqori_id");
	$insert=$kaydet->execute(array(
		'proqram_ad'=>StrToLower($_POST['proqram_ad']),
		'proqram_download_link'=>$_POST['proqram_download_link'],		
		'proqram_seourl'=>$proqram_seourl,
		'proqram_detay'=>$_POST['proqram_detay'],		
		'proqramkataqori_id'=>$proqramkataqori_id
	));
	
}if($insert){
	header("Location:../production/program.php?durum=peok");
}
else{
	header("Location:../production/program_elave_et.php?durum=peno");
}
}
/*==========================================Proqram əlave et bitir==============================*/


/*==========================================Proqram duzenle başlayır==============================*/
if (isset($_POST['program_duzenle'])) {

	$proqram_id=$_POST['proqram_id'];
	if($_POST['proqram_kataqori']==0){
		$proqramkataqori_ad=StrToLower($_POST['proqram_kataqori_yeni']);
		$proqramkataqorisor=$db->prepare("SELECT * FROM proqramkataqori where proqramkataqori_ad=:proqramkataqori_ad ");
		$proqramkataqorisor->execute(array(			
			'proqramkataqori_ad'=>$proqramkataqori_ad
		));				
		$proqramkataqoricek=$proqramkataqorisor->fetch(PDO::FETCH_ASSOC);
		$proqramkataqorisay=$proqramkataqorisor->rowCount();
		if($proqramkataqorisay==0){
			$proqramkataqori_seourl=seo(StrToLower($_POST['proqram_kataqori_yeni']));
			$kaydet=$db->prepare("INSERT INTO proqramkataqori SET 
				proqramkataqori_ad=:proqramkataqori_ad,
				proqramkataqori_seourl=:proqramkataqori_seourl");
			$insert=$kaydet->execute(array(
				'proqramkataqori_ad'=>StrToLower($_POST['proqram_kataqori_yeni']),
				'proqramkataqori_seourl'=>$proqramkataqori_seourl
			));
			if($insert){
				$stmt = $db->query("SELECT LAST_INSERT_ID()");
				$proqramkataqori_id = $stmt->fetchColumn();
			}else{
				header("Location:../production/program_elave_et?durum=kataqori");
				exit;
			}
		}else{
			$proqramkataqori_id=$proqramkataqoricek['proqramkataqori_id'];
		}
	}else{
		$proqramkataqori_id= $_POST['proqram_kataqori'];
	}

	if($_FILES['program_yol']["size"]>0){
		$uploads_program = '../production/programlar';
		@$tmp_name_program = $_FILES['program_yol']["tmp_name"];
		@$name_program = $_FILES['program_yol']["name"];
		$tip = $_FILES['program_yol']['type'];
		$uzanti = explode('.', $name_program);
		$ad=$uzanti[0];
		$uzanti = $uzanti[count($uzanti)-1];
		$avtoadp=uniqid();
		$yeniad=$ad."-".$avtoadp.".".$uzanti;
		$program_yol=$yeniad;
		@move_uploaded_file($tmp_name_program, "$uploads_program/$yeniad");
	}
	else{
		$program_yol=$_FILES['program_yol']["name"];

	}		

	if($_FILES['proqram_img']["size"]>0){
		$uploads_dir = '../production/images/program';
		@$tmp_name = $_FILES['proqram_img']["tmp_name"];
		@$name = $_FILES['proqram_img']["name"];
		$avtoad=uniqid();
		$refimgyol=substr($uploads_dir, 32).$avtoad.$name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$avtoad$name");
		$proqram_seourl=seo($_POST['proqram_ad']);
		$kaydet=$db->prepare("UPDATE proqramlar   SET 
			proqram_ad=:proqram_ad,
			proqram_img=:proqram_img,
			program_yol=:program_yol,
			proqram_download_link=:proqram_download_link,
			proqram_seourl=:proqram_seourl,				
			proqram_detay=:proqram_detay,
			proqramkataqori_id=:proqramkataqori_id
			WHERE proqram_id=$proqram_id");
		$insert=$kaydet->execute(array(
			'proqram_ad'=>StrToLower($_POST['proqram_ad']),
			'proqram_img'=>$refimgyol,
			'program_yol'=>$program_yol,
			'proqram_download_link'=>$_POST['proqram_download_link'],		
			'proqram_seourl'=>$proqram_seourl,
			'proqram_detay'=>$_POST['proqram_detay'],		
			'proqramkataqori_id'=>$proqramkataqori_id
		));if($insert){
			$resimsilunlink=$_POST['kone_img'];
			unlink("../production/images/program/$resimsilunlink");
			header("Location:../production/program.php?durum=pduzok");
		}
		else{
			header("Location:../production/program_duzenle.php?durum=pduzno&proqram_id=$proqram_id");
		}
	}else{$proqram_seourl=seo($_POST['proqram_ad']);
	$kaydet=$db->prepare("UPDATE proqramlar   SET 
		proqram_ad=:proqram_ad,
		proqram_download_link=:proqram_download_link,
		proqram_seourl=:proqram_seourl,				
		proqram_detay=:proqram_detay,
		proqramkataqori_id=:proqramkataqori_id
		WHERE proqram_id=$proqram_id");
	$insert=$kaydet->execute(array(
		'proqram_ad'=>StrToLower($_POST['proqram_ad']),
		'proqram_download_link'=>$_POST['proqram_download_link'],		
		'proqram_seourl'=>$proqram_seourl,
		'proqram_detay'=>$_POST['proqram_detay'],		
		'proqramkataqori_id'=>$proqramkataqori_id
	));
	

}if($insert){
	header("Location:../production/program.php?durum=pduzok");
}
else{
	header("Location:../production/program_duzenle.php?durum=yno&proqram_id=$proqram_id");
}
}
/*==========================================Proqram duzenle  bitir==============================*/




/*====================================Proqaram sil baslayir====================================*/
if ($_GET['program_sil']=="ok") {
	$proqram_id=$_GET['proqram_id'];
	$programsor=$db->prepare("SELECT * from proqramlar where proqram_id=:proqram_id");
	$programsor->execute(array(
		'proqram_id'=>$proqram_id));
	$sil=$db->prepare("DELETE from proqramlar WHERE proqram_id=:proqram_id");
	$kontrol=$sil->execute(array(
		'proqram_id'=>$proqram_id));
	if($kontrol){
		while ($programcek=$programsor->fetch(PDO::FETCH_ASSOC)) {
			$resimsilunlink=$programcek['proqram_img'];
			$programunlink=$programcek['program_yol'];
			unlink("../production/images/program/$resimsilunlink");
			unlink("../production/programlar/$programunlink");
		}header("Location:../production/program?durum=psilok");
	}else{
		header("Location:../production/program.php?durum=psilno");
	}
}
/*====================================Proqaram sil bitir==========================================*/




/*====================================kataqori sil baslayir====================================*/
if ($_GET['proqramkataqoricek_sil']=="ok") {
	$proqramkataqori_id=$_GET['proqramkataqori_id'];
	$sil=$db->prepare("DELETE from proqramkataqori WHERE proqramkataqori_id=:proqramkataqori_id");
	$kontrol=$sil->execute(array(
		'proqramkataqori_id'=>$proqramkataqori_id));
	if($kontrol){
		$programsor=$db->prepare("SELECT * from proqramlar where proqramkataqori_id=:proqramkataqori_id");
		$programsor->execute(array(
			'proqramkataqori_id'=>$proqramkataqori_id));
		$sil=$db->prepare("DELETE from proqramlar WHERE proqramkataqori_id=:proqramkataqori_id");
		$kontrol=$sil->execute(array(
			'proqramkataqori_id'=>$proqramkataqori_id));
		if($kontrol){				
			while ($programcek=$programsor->fetch(PDO::FETCH_ASSOC)) {
				$resimsilunlink=$programcek['proqram_img'];
				$programunlink=$programcek['program_yol'];
				unlink("../production/images/program/$resimsilunlink");
				unlink("../production/programlar/$programunlink");
			}
			header("Location:../production/program?durum=katsilok");
		}else{
			header("Location:../production/program.php?durum=katsilno");
		}
	}else{
		header("Location:../production/program.php?durum=katsilno");
	}		
}
/*====================================kataqori sil bitir==========================================*/





/*==========================================Proqram kataqori durum baslayir================================*/
if (isset($_POST['programkataqoridurum'])) {
	$proqramkataqori_id=$_POST['programkataqoridurum'];
	$proqramkataqorisor=$db->prepare("SELECT * FROM proqramkataqori where proqramkataqori_id=:proqramkataqori_id");
	$proqramkataqorisor->execute(array(
		'proqramkataqori_id'=>$proqramkataqori_id));
	$proqramkataqoricek=$proqramkataqorisor->fetch(PDO::FETCH_ASSOC); 
	if($proqramkataqoricek['proqramkataqori_durum']==1){
		$proqramkataqori_durum=0;
	}elseif($proqramkataqoricek['proqramkataqori_durum']==0){
		$proqramkataqori_durum=1;
	}
	$kaydet=$db->prepare("UPDATE proqramkataqori SET
		proqramkataqori_durum=:proqramkataqori_durum
		WHERE proqramkataqori_id=$proqramkataqori_id");
	$update=$kaydet->execute(array(
		'proqramkataqori_durum' => $proqramkataqori_durum
	));
}
/*==========================================sProqram kataqori durum bitir================================*/


/*==========================================Proqram  durum baslayir================================*/
if (isset($_POST['proqram_durum'])) {
	$proqram_id=$_POST['proqram_durum'];
	$proqramsor=$db->prepare("SELECT * FROM proqramlar where proqram_id=:proqram_id");
	$proqramsor->execute(array(
		'proqram_id'=>$proqram_id));
	$proqramicek=$proqramsor->fetch(PDO::FETCH_ASSOC); 
	if($proqramicek['proqram_durum']==1){
		$proqram_durum=0;
	}elseif($proqramicek['proqram_durum']==0){
		$proqram_durum=1;
	}
	$kaydet=$db->prepare("UPDATE proqramlar SET
		proqram_durum=:proqram_durum
		WHERE proqram_id=$proqram_id");
	$update=$kaydet->execute(array(
		'proqram_durum' => $proqram_durum
	));
}
/*==========================================sProqram  durum bitir================================*/



/*==========================================Alt menu sor================================*/
if (isset($_POST['menu_id'])) {
	$menu_id=$_POST['menu_id'];
	$altmenusor=$db->prepare("SELECT * FROM menu where menu_ust=:menu_ust");
	$altmenusor->execute(array(
		'menu_ust'=>$menu_id));
	$altmenusay=$altmenusor->rowCount();
	$altmenucek=$altmenusor->fetch(PDO::FETCH_ASSOC);	
	echo $altmenucek['menu_id'];

}
/*==========================================Admin durum bitir================================*/








































?>
