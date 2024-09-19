<?php 
ob_start();
session_start();
require_once 'baglan.php'; 
require_once '../production/fonksiyon.php';

if (isset($_POST['admingiris'])) {

	$kullanici_mail=$_POST['kullanici_mail'];
	$kullanici_password=md5($_POST['kullanici_password']);
	$kullanici_istifadeciad=$_POST['kullanici_istifadeciad'];

	$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail or kullanici_istifadeciad=:istifadeciad and kullanici_password=:password and kullanici_yetki=:yetki");
	$kullanicisor->execute(array(
		'mail' => $kullanici_mail,
		'password' => $kullanici_password,
		'istifadeciad'=>$kullanici_istifadeciad,
		'yetki' => 5
	));

	echo $say=$kullanicisor->rowCount();

	if ($say==1) {

		$_SESSION['kullanici_mail']=$kullanici_mail;
		header("Location:../production/index.php");
		exit;



	} else {

		header("Location:../production/login.php?durum=no");
		exit;
	}
	

}




if (isset($_POST['kullanicigiris'])) {

	$kullanici_mail=htmlspecialchars($_POST['kullanici_mail']);
	$kullanici_password=md5($_POST['kullanici_password']);


	$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail  and kullanici_password=:password and kullanici_yetki=:yetki");
	$kullanicisor->execute(array(
		'mail' => $kullanici_mail,
		'password' => $kullanici_password,
		'yetki' => 1
	));

	$say=$kullanicisor->rowCount();

	if ($say==1) {

		$_SESSION['kullanici_mail']=$kullanici_mail;
		header("Location:../../");
		exit;



	} else {

		header("Location:../../index.php?durum=no");
		exit;
	}
	

}





if (isset($_POST['logoduzenle'])) {

	

	$uploads_dir = '../../img/logo';

	@$tmp_name = $_FILES['ayar_logo']["tmp_name"];
	@$name = $_FILES['ayar_logo']["name"];

	$benzersizsayi4=rand(20000,32000);
	echo $refimgyol=substr($uploads_dir, 6)."/".$benzersizsayi4.$name;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name");

	
	$duzenle=$db->prepare("UPDATE ayar SET
		ayar_logo=:logo
		WHERE ayar_id=0");
	$update=$duzenle->execute(array(
		'logo' => $refimgyol
	));



	if ($update) {

		$resimsilunlink=$_POST['eski_yol'];
		unlink("../../$resimsilunlink");

		Header("Location:../production/logo-ayar.php?durum=ok");

	} else {

		Header("Location:../production/logo-ayar.php?durum=no");
	}

}









if (isset($_POST['genelayarguncelle'])) {
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		ayar_title=:ayar_title,
		ayar_description=:ayar_description,
		ayar_keywords=:ayar_keywords,
		ayar_author=:ayar_author
		WHERE ayar_id=0");
	$update=$ayarkaydet->execute(array(
		'ayar_title' => UcWords(StrToLower($_POST['ayar_title'])),
		'ayar_description' => UcWords(StrToLower($_POST['ayar_description'])),
		'ayar_keywords'=>UcWords(StrToLower($_POST['ayar_keywords'])),		
		'ayar_author' =>UcWords(StrToLower($_POST['ayar_author']))
	));

	if ($update) {
		header("Location:../production/genel-ayar.php?durum=ok");
	} 
	else {
		header("Location:../production/genel-ayar.php?durum=no");
	}
}
if (isset($_POST['iletisimayarguncelle'])) {
	$ayarkaydet=$db->prepare("UPDATE ayar SET 
		ayar_tel=:ayar_tel,
		ayar_gsm=:ayar_gsm,
		ayar_faks=:ayar_faks,
		ayar_mail=:ayar_mail
		WHERE ayar_id=0");
	$update=$ayarkaydet->execute(array(
		'ayar_tel'=>$_POST['ayar_tel'],
		'ayar_gsm'=>$_POST['ayar_gsm'],
		'ayar_faks'=>$_POST['ayar_faks'],
		'ayar_mail'=>$_POST['ayar_mail']
	));
	if ($update) {
		header("Location:../production/iletisim-ayar.php?durum=ok");
	}else{
		header("Location:../production/iletisim-ayar.php?durum=no");
	}
}



if (isset($_POST['unvanayarguncelle'])) {
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		ayar_dovlet=:ayar_dovlet,
		ayar_seher=:ayar_seher,
		ayar_adres=:ayar_adres
		WHERE ayar_id=0");
	$update=$ayarkaydet->execute(array(
		'ayar_dovlet'=>$_POST['ayar_dovlet'],
		'ayar_seher'=>$_POST['ayar_seher'],
		'ayar_adres'=>$_POST['ayar_adres']
	));
	if ($update) {
		header("Location:../production/unvan-ayar.php?durum=ok");
	}else{
		header("Location:../production/unvan-ayar.php?durum=no");
	}

}
if (isset($_POST['apiayarguncelle'])) {
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		ayar_maps=:ayar_maps,
		ayar_analistic=:ayar_analistic,
		ayar_zopim=:ayar_zopim
		WHERE ayar_id=0");
	$update=$ayarkaydet->execute(array(
		'ayar_maps'=>$_POST['ayar_maps'],
		'ayar_analistic'=>$_POST['ayar_analistic'],
		'ayar_zopim'=>$_POST['ayar_zopim']
	));
	if ($update) {
		header("Location:../production/api-ayar.php?durum=ok");
	}else{
		header("Location:../production/api-ayar.php?durum=no");
	}
}
if (isset($_POST['socialayarguncelle'])) {
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		ayar_facebook=:ayar_facebook,
		ayar_twitter=:ayar_twitter,
		ayar_youtube=:ayar_youtube,
		ayar_google=:ayar_google
		WHERE ayar_id=0");
	$update=$ayarkaydet->execute(array(
		'ayar_facebook'=>$_POST['ayar_facebook'],
		'ayar_twitter'=>$_POST['ayar_twitter'],
		'ayar_youtube'=>$_POST['ayar_youtube'],
		'ayar_google'=>$_POST['ayar_google']
	));
	if ($update) {
		header("Location:../production/social-ayar.php?durum=ok");
	}else{
		header("Location:../production/social-ayar.php?durum=no");
	}
}

if (isset($_POST['smtpalayarguncelle'])) {
	$ayarkaydet=$db->prepare("UPDATE ayar SET 
		ayar_smtphost=:ayar_smtphost,
		ayar_smtpuser=:ayar_smtpuser,
		ayar_smtppassword=:ayar_smtppassword,
		ayar_smtpport=:ayar_smtpport
		WHERE ayar_id=0");
	$update=$ayarkaydet->execute(array(
		'ayar_smtphost'=>$_POST['ayar_smtphost'],
		'ayar_smtpuser'=>$_POST['ayar_smtpuser'],
		'ayar_smtppassword'=>$_POST['ayar_smtppassword'],
		'ayar_smtpport'=>$_POST['ayar_smtpport']
	));
	if ($update) {
		header("LOcation:../production/smtp-ayar.php?durum=ok");
	}else{
		header("Location:../production/smtp-ayar.php?durum=no");
	}
}




/*--------------------kullanici kayid--------------------*/

if (isset($_POST['userkaydet'])) {
	$kullanici_ad=htmlspecialchars($_POST['kullanici_ad']);
	$kullanici_soyad=htmlspecialchars($_POST['kullanici_soyad']);
	$kullanici_adasininadi=htmlspecialchars($_POST['kullanici_adasininadi']);
	$kullanici_istifadeciad=htmlspecialchars($_POST['kullanici_istifadeciad']);
	$kullanici_mail=htmlspecialchars($_POST['kullanici_mail']);
	$kullanici_passwordone=$_POST['kullanici_passwordone'];
	$kullanici_passwordtwo=$_POST['kullanici_passwordtwo'];

	if($kullanici_passwordone==$kullanici_passwordtwo){

		if (strlen($kullanici_passwordone)>=6) {

//baslangic
			$kullanicisor=$db->prepare('SELECT * FROM kullanici where kullanici_mail=:mail or kullanici_istifadeciad=:istifadeciad');
			$kullanicisor->execute(array(
				'mail'=>$kullanici_mail,
				'istifadeciad'=>$kullanici_istifadeciad));
			/*Əgər kullanici varsa  say dəyisgəni onun sayini deyeəcək yoxsa 0 dəyəsini dondurəcək*/
			$say=$kullanicisor->rowCount();
			if($say==0){
				$password=md5($kullanici_passwordone);
				$kullanici_yetki=1;
//kulanici kayit islemi edilir
				$kullanicikaydet=$db->prepare("INSERT INTO kullanici SET
					kullanici_ad=:kullanici_ad,
					kullanici_soyad=:kullanici_soyad,
					kullanici_adasininadi=:kullanici_adasininadi,
					kullanici_mail=:kullanici_mail,
					kullanici_istifadeciad=:kullanici_istifadeciad,
					kullanici_password=:kullanici_password,
					kullanici_yetki=:kullanici_yetki");
				$kaydet=$kullanicikaydet->execute(array(
					'kullanici_ad' =>$kullanici_ad,
					'kullanici_soyad'=>$kullanici_soyad,
					'kullanici_adasininadi'=>$kullanici_adasininadi,
					'kullanici_mail'=>$kullanici_mail,
					'kullanici_istifadeciad'=>$kullanici_istifadeciad,
					'kullanici_password'=>$password,
					'kullanici_yetki'=>$kullanici_yetki
				));
				if($kaydet){
					header("Location:../../index.php?durum=kaytbasarili");

				} else {


					header("Location:../../register.php?durum=basarisiz");
				}
			}else {

				header("Location:../../register.php?durum=mukerrerkayit");

			}
// bitis
		}else{
			header("Location:../../register.php?durum=eksiksifre");
		}
	}else{
		header("Location:../../register.php?durum=farklisifre");
	}
}





/*----------------------------İstifadəçi Düzənlə başlayır--------------------*/

if (isset($_POST['elaqeuserduzenle'])) {
	$dovlet_id=htmlspecialchars($_POST['dovlet_id']);
	$kullanici_seher=htmlspecialchars($_POST['kullanici_seher']);
	$kullanici_unvan=htmlspecialchars($_POST['kullanici_unvan']);
	$kullanici_tel=htmlspecialchars($_POST['kullanici_tel']);
	$kullanici_id=$_POST['kullanici_id'];

	
//kulanici kayit islemi edilir
	$kaydet=$db->prepare("UPDATE kullanici SET
		dovlet_id=:dovlet_id,
		kullanici_seher=:kullanici_seher,
		kullanici_unvan=:kullanici_unvan,
		kullanici_tel=:kullanici_tel
		WHERE kullanici_id=$kullanici_id");
	$update=$kaydet->execute(array(
		'dovlet_id' =>$dovlet_id,
		'kullanici_seher'=>$kullanici_seher,
		'kullanici_unvan'=>$kullanici_unvan,
		'kullanici_tel'=>$kullanici_tel
	));
	if($update){
		header("Location:../../hesabim.php?durum=yenilendi");

	} else {
		header("Location:../../hesabim.php?durum=yenilenmedi");
	}	
}






if (isset($_POST['sexsiuserduzenle'])) {
	$kullanici_ad=htmlspecialchars($_POST['kullanici_ad']);
	$kullanici_soyad=htmlspecialchars($_POST['kullanici_soyad']);
	$kullanici_adasininadi=htmlspecialchars($_POST['kullanici_adasininadi']);
	$kullanici_istifadeciad=htmlspecialchars($_POST['kullanici_istifadeciad']);
	$kullanici_id=$_POST['kullanici_id'];

	$kullanici_yetki=1;
//kulanici kayit islemi edilir
	$kaydet=$db->prepare("UPDATE kullanici SET
		kullanici_ad=:kullanici_ad,
		kullanici_soyad=:kullanici_soyad,
		kullanici_adasininadi=:kullanici_adasininadi,
		kullanici_istifadeciad=:kullanici_istifadeciad,					
		kullanici_yetki=:kullanici_yetki
		WHERE kullanici_id=$kullanici_id");
	$update=$kaydet->execute(array(
		'kullanici_ad' =>$kullanici_ad,
		'kullanici_soyad'=>$kullanici_soyad,
		'kullanici_adasininadi'=>$kullanici_adasininadi,
		'kullanici_istifadeciad'=>$kullanici_istifadeciad,					
		'kullanici_yetki'=>$kullanici_yetki
	));
	if($update){
		header("Location:../../hesabim.php?durum=yenilendi");

	} else {
		header("Location:../../hesabim.php?durum=yenilenmedi");
	}	
}






if (isset($_POST['sifreduzenle'])) {
	$kullanici_passwordone=$_POST['kullanici_passwordone'];
	$kullanici_passwordtwo=$_POST['kullanici_passwordtwo'];
	$kullanici_password=$_POST['kullanici_password'];
	$kullanici_passwordeski=md5($_POST['kullanici_passwordeski']);

	$kullanici_id=$_POST['kullanici_id'];
	$password=md5($kullanici_passwordone);
	if($kullanici_passwordone==$kullanici_passwordtwo){
		if($kullanici_password==$kullanici_passwordeski){
			if (strlen($kullanici_passwordone)>=6) {

//kulanici kayit islemi edilir
				$kaydet=$db->prepare("UPDATE kullanici SET
					kullanici_password=:kullanici_password
					WHERE kullanici_id=$kullanici_id");
				$update=$kaydet->execute(array(
					'kullanici_password'=>$password
				));
			}
		}if($kaydet){
			header("Location:../../index.php?durum=kaytbasarili");
		} else {
			header("Location:../../register.php?durum=basarisiz");				}
		}
		else {	header("Location:../../register.php?durum=mukerrerkayit");}
// bitis
	}

	

	/*----------------------------İstifadəçi Düzənlə Bitir--------------------*/



	if(isset($_POST['hakkimizdaguncelle'])){
		$kaydet=$db->prepare("UPDATE hakkimizda SET 
			hakkimizda_baslik=:hakkimizda_baslik,
			hakkimizda_icerik=:hakkimizda_icerik,
			hakkimizda_video=:hakkimizda_video,
			hakkimizda_vizyon=:hakkimizda_vizyon,
			hakkimizda_misyon=:hakkimizda_misyon
			WHERE hakkimizda_id=0");
		$update=$kaydet->execute(array(
			'hakkimizda_baslik'=>$_POST['hakkimizda_baslik'],
			'hakkimizda_icerik'=>$_POST['hakkimizda_icerik'],
			'hakkimizda_video'=>$_POST['hakkimizda_video'],
			'hakkimizda_vizyon'=>$_POST['hakkimizda_vizyon'],
			'hakkimizda_misyon'=>$_POST['hakkimizda_misyon']
		));
		if($update){
			header("Location:../production/hakkimizda.php?durum=ok");
		} else{
			header("Location:../production/hakkimizda.php?durum=no");
		}
	}



	if(isset($_POST['kullaniciduzenle'])){
		$kullanici_id=$_POST['kullanici_id'];
		$kaydet=$db->prepare("UPDATE kullanici SET 
			kullanici_ad=:kullanici_ad,
			kullanici_soyad=:kullanici_soyad,
			kullanici_adasininadi=:kullanici_adasininadi,
			kullanici_dovlet=:kullanici_dovlet,
			kullanici_seher=:kullanici_seher,
			kullanici_tel=:kullanici_tel,
			kullanici_unvan=:kullanici_unvan,
			kullanici_tehsil=:kullanici_tehsil,
			kullanici_isyeri=:kullanici_isyeri,
			kullanici_yetki=:kullanici_yetki,
			kullanici_durum=:kullanici_durum
			WHERE kullanici_id=$kullanici_id");
		$update=$kaydet->execute(array(
			'kullanici_ad'=>$_POST['kullanici_ad'],
			'kullanici_soyad'=>$_POST['kullanici_soyad'],
			'kullanici_adasininadi'=>$_POST['kullanici_adasininadi'],
			'kullanici_dovlet'=>$_POST['kullanici_dovlet'],
			'kullanici_seher'=>$_POST['kullanici_seher'],
			'kullanici_tel'=>$_POST['kullanici_tel'],
			'kullanici_unvan'=>$_POST['kullanici_unvan'],
			'kullanici_tehsil'=>$_POST['kullanici_tehsil'],
			'kullanici_isyeri'=>$_POST['kullanici_isyeri'],
			'kullanici_yetki'=>$_POST['kullanici_yetki'],
			'kullanici_durum'=>$_POST['kullanici_durum']
		));

		if($update){
			header("Location:../production/kulanici-duzenle.php?durum=ok&kullanici_id=$kullanici_id");
		}
		else{
			header("Location:../production/kulanici-duzenle.php?durum=no&kullanici_id=$kullanici_id");
		}
	}	


	if ($_GET['kulanicisil']=="ok") {
		$sil=$db->prepare("DELETE from kullanici WHERE kullanici_id=:id");
		$kontrol=$sil->execute(array(
			'id'=>$_GET['kullanici_id']));
		if($kontrol){
			header("Location:../production/kullanicilar.php?durum=silok");
		}else{
			header("Location:../production/kullanicilar.php?durum=silno");
		}

	}






	if ($_GET['kulanicisil']=="ok") {
		$sil=$db->prepare("DELETE from kullanici WHERE kullanici_id=:id");
		$kontrol=$sil->execute(array(
			'id'=>$_GET['kullanici_id']));
		if($kontrol){
			header("Location:../production/kullanicilar.php?durum=silok");
		}else{
			header("Location:../production/kullanicilar.php?durum=silno");
		}

	}





	if(isset($_POST['menuduzenle'])){
		if($_POST['menu_durum']==="on"){
			$menu_durum=1;
		} else{
			$menu_durum=0;
		}

		$menu_id=$_POST['menu_id'];
		$menu_seourl=seo($_POST['menu_ad']);
		$kaydet=$db->prepare("UPDATE menu SET 
			menu_ust=:menu_ust,
			menu_ad=:menu_ad,
			menu_detay=:menu_detay,
			menu_url=:menu_url,
			menu_sira=:menu_sira,
			menu_durum=:menu_durum,
			menu_seourl=:menu_seourl
			WHERE menu_id=$menu_id");
		$update=$kaydet->execute(array(
			'menu_ust'=>$_POST['menu_ust'],
			'menu_ad'=>$_POST['menu_ad'],
			'menu_detay'=>$_POST['menu_detay'],
			'menu_url'=>$_POST['menu_url'],
			'menu_sira'=>$_POST['menu_sira'],
			'menu_durum'=>$menu_durum,
			'menu_seourl'=>$menu_seourl
		));

		if($update){
			header("Location:../production/menu-duzenle.php?durum=ok&menu_id=$menu_id");
		}
		else{
			header("Location:../production/menu-duzenle.php?durum=no&menu_id=$menu_id");
		}
	}	


	if ($_GET['menusil']=="ok") {
		$sil=$db->prepare("DELETE from menu WHERE menu_id=:id");
		$kontrol=$sil->execute(array(
			'id'=>$_GET['menu_id']));
		if($kontrol){
			header("Location:../production/menu.php?durum=silok");
		}else{
			header("Location:../production/menu.php?durum=silno");
		}

	}


	if(isset($_POST['menuekle'])){
		if($_POST['menu_durum']==="on"){
			$menu_durum=1;
		} else{
			$menu_durum=0;
		}


		$menu_seourl=seo($_POST['menu_ad']);
		$kaydet=$db->prepare("INSERT INTO menu SET 
			menu_ust=:menu_ust,
			menu_ad=:menu_ad,
			menu_detay=:menu_detay,
			menu_url=:menu_url,
			menu_sira=:menu_sira,
			menu_durum=:menu_durum,
			menu_seourl=:menu_seourl");
		$insert=$kaydet->execute(array(
			'menu_ust'=>$_POST['menu_ust'],
			'menu_ad'=>StrToUpper($_POST['menu_ad']),
			'menu_detay'=>$_POST['menu_detay'],
			'menu_url'=>$_POST['menu_url'],
			'menu_sira'=>$_POST['menu_sira'],
			'menu_durum'=>$menu_durum,
			'menu_seourl'=>$menu_seourl
		));

		if($insert){
			header("Location:../production/menu-ekle.php?durum=ok");
		}
		else{
			header("Location:../production/menu-ekle.php?durum=no");
		}
	}	




	if (isset($_POST['sliderkaydet'])) {


		$uploads_dir = '../../img/slider';
		@$tmp_name = $_FILES['slider_resimyol']["tmp_name"];
		@$name = $_FILES['slider_resimyol']["name"];
	//resmin isminin benzersiz olması
		$benzersizsayi1=rand(20000,32000);
		$benzersizsayi2=rand(20000,32000);
		$benzersizsayi3=rand(20000,32000);
		$benzersizsayi4=rand(20000,32000);	
		$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
		$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");



		$kaydet=$db->prepare("INSERT INTO slider SET
			slider_ad=:slider_ad,
			slider_sira=:slider_sira,
			slider_link=:slider_link,
			slider_resimyol=:slider_resimyol
			");
		$insert=$kaydet->execute(array(
			'slider_ad' => $_POST['slider_ad'],
			'slider_sira' => $_POST['slider_sira'],
			'slider_link' => $_POST['slider_link'],
			'slider_resimyol' => $refimgyol
		));

		if ($insert) {

			Header("Location:../production/slider-ekle.php?durum=ok");

		} else {

			Header("Location:../production/slider-ekle.php?durum=no");
		}

	}

// sloder düzəliş etmə

	if (isset($_POST['sliderduzenle'])) {

		if($_FILES['slider_resimyol']["size"]>0){
			$slider_id=$_POST['slider_id'];
			if($_POST['slider_durum']==="on"){
				$slider_durum=1;
			} else{
				$slider_durum=0;
			}


			$uploads_dir = '../../img/slider';
			@$tmp_name = $_FILES['slider_resimyol']["tmp_name"];
			@$name = $_FILES['slider_resimyol']["name"];
	//resmin isminin benzersiz olması
			$benzersizsayi1=rand(20000,32000);
			$benzersizsayi2=rand(20000,32000);
			$benzersizsayi3=rand(20000,32000);
			$benzersizsayi4=rand(20000,32000);	
			$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
			$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
			@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

			$kaydet=$db->prepare("UPDATE slider SET 
				slider_ad=:slider_ad,
				slider_sira=:slider_sira,
				slider_durum=:slider_durum,
				slider_link=:slider_link,
				slider_resimyol=:slider_resimyol
				WHERE slider_id=$slider_id
				");
			$update=$kaydet->execute(array(
				'slider_ad' => $_POST['slider_ad'],
				'slider_sira' => $_POST['slider_sira'],
				'slider_durum' => $slider_durum,
				'slider_link' => $_POST['slider_link'],
				'slider_resimyol' => $refimgyol
			));



			if ($update) {
				$resimsil=$_POST['slidereskiresimyol'];
				unlink("../../$resimsil");

				Header("Location:../production/slider.php?durum=ok");

			} else {

				Header("Location:../production/slider.php?durum=no");
			}
		}else{
			$slider_id=$_POST['slider_id'];
			if($_POST['slider_durum']==="on"){
				$slider_durum=1;
			} else{
				$slider_durum=0;
			}


			$kaydet=$db->prepare("UPDATE slider SET 
				slider_ad=:slider_ad,
				slider_sira=:slider_sira,
				slider_durum=:slider_durum,
				slider_link=:slider_link
				WHERE slider_id=$slider_id
				");
			$insert=$kaydet->execute(array(
				'slider_ad' => $_POST['slider_ad'],
				'slider_sira' => $_POST['slider_sira'],
				'slider_durum' => $slider_durum,
				'slider_link' => $_POST['slider_link']
			));

			if ($insert) {

				Header("Location:../production/slider.php?durum=ok");

			} else {

				Header("Location:../production/slider.php?durum=no");
			}

		}



	}
	/*-------------------Slider duzelis bitir----------------*/

	/*-------------------Slider sil baslayir----------------*/

	if ($_GET['slidersil']=="ok") {
		$sil=$db->prepare("DELETE from slider WHERE slider_id=:id");
		$kontrol=$sil->execute(array(
			'id'=>$_GET['slider_id']));
		if($kontrol){
			$resimsil=$_GET['slider_resimyol'];
			unlink("../../$resimsil");
			header("Location:../production/slider.php?durum=silok");
		}else{
			header("Location:../production/slider.php?durum=silno");
		}

	}
	/*-------------------slider sil bitir----------------*/

	/*-------------------slider aktiv passif yapma baslayir----------------*/

	if ($_GET['slideraktiv']=="ok"){
		$slider_durum=0;
		$slider_id=$_GET['slider_id'];
		$kaydet=$db->prepare("UPDATE slider SET

			slider_durum=:slider_durum
			WHERE slider_id=$slider_id");
		$insert=$kaydet->execute(array(

			'slider_durum'=>$slider_durum
		));

		if($insert){
			header("Location:../production/slider.php");
		}
		else{
			header("Location:../production/slider.php");
		}
	}	



	if ($_GET['sliderpassiv']=="ok"){
		$slider_durum=1;
		$slider_id=$_GET['slider_id'];
		$kaydet=$db->prepare("UPDATE slider SET

			slider_durum=:slider_durum
			WHERE slider_id=$slider_id");
		$insert=$kaydet->execute(array(

			'slider_durum'=>$slider_durum
		));

		if($insert){
			header("Location:../production/slider.php");
		}
		else{
			header("Location:../production/slider.php");
		}
	}	

	/*-------------------slider aktiv passif yapma bitir----------------*/

	/*-------------------Kataqori Əlavə Et başlayır----------------*/

	if(isset($_POST['kataqoriekle'])){

		if($_POST['kataqori_durum']==="on"){
			$kataqori_durum=1;
		} else{
			$kataqori_durum=0;
		}


		$kataqori_seourl=seo($_POST['kataqori_ad']);
		$kaydet=$db->prepare("INSERT INTO kataqori SET		
			kataqori_ad=:kataqori_ad,
			kataqori_sira=:kataqori_sira,
			kataqori_durum=:kataqori_durum,
			kataqori_seourl=:kataqori_seourl");
		$insert=$kaydet->execute(array(
			'kataqori_ad'=>StrToUpper($_POST['kataqori_ad']),
			'kataqori_sira'=>$_POST['kataqori_sira'],
			'kataqori_durum'=>$kataqori_durum,
			'kataqori_seourl'=>$kataqori_seourl
		));

		if($insert){
			header("Location:../production/kataqori-ekle.php?durum=ok");
		}
		else{
			header("Location:../production/kataqori-ekle.php?durum=no");
		}
	}

	/*-------------------Kataqori Əlavə Et Bitir----------------*/



	/*-------------------Kataqori Sil Başlanır----------------*/


	if ($_GET['kataqorisil']=="ok") {
		$sil=$db->prepare("DELETE from kataqori WHERE kataqori_id=:id");
		$kontrol=$sil->execute(array(
			'id'=>$_GET['kataqori_id']));
		if($kontrol){
			header("Location:../production/kataqoriler.php?durum=silok");
		}else{
			header("Location:../production/kataqoriler.php?durum=silno");
		}

	}
	/*-------------------Kataqori Sil Bitir----------------*/


	if(isset($_POST['kataqoriduzenle'])){
		if($_POST['kataqori_durum']==="on"){
			$kataqori_durum=1;
		} else{
			$kataqori_durum=0;
		}

		$kataqori_id=$_POST['kataqori_id'];
		$kataqori_seourl=seo($_POST['kataqori_ad']);
		$kaydet=$db->prepare("UPDATE kataqori SET 
			kataqori_ad=:kataqori_ad,
			kataqori_sira=:kataqori_sira,
			kataqori_durum=:kataqori_durum,
			kataqori_seourl=:kataqori_seourl
			WHERE kataqori_id=$kataqori_id");
		$update=$kaydet->execute(array(
			'kataqori_ad'=>$_POST['kataqori_ad'],
			'kataqori_sira'=>$_POST['kataqori_sira'],
			'kataqori_durum'=>$kataqori_durum,
			'kataqori_seourl'=>$kataqori_seourl
		));

		if($update){
			header("Location:../production/kataqori-duzenle.php?durum=ok&kataqori_id=$kataqori_id");
		}
		else{
			header("Location:../production/kataqori-duzenle.php?durum=no&kataqori_id=$kataqori_id");
		}
	}




	/*---------------Urun ekle baslayır--------*/

	if(isset($_POST['urunekle'])){


		if($_POST['urun_durum']==="on"){
			$urun_durum=1;
		} else{
			$urun_durum=0;
		}


		$urun_seourl=seo($_POST['urun_ad']);
		$kaydet=$db->prepare("INSERT INTO urun SET 
			urun_ad=:urun_ad,
			urun_fiyat=:urun_fiyat,
			urun_durum=:urun_durum,
			kataqori_id=:kataqori_id,
			urun_detay=:urun_detay,
			urun_keyword=:urun_keyword,
			urun_sira=:urun_sira,
			urun_stok=:urun_stok,
			urun_seourl=:urun_seourl");
		$insert=$kaydet->execute(array(
			'urun_ad'=>StrToUpper($_POST['urun_ad']),
			'urun_fiyat'=>$_POST['urun_fiyat'],
			'urun_durum'=>$urun_durum,
			'kataqori_id'=>$_POST['kataqori_id'],
			'urun_detay'=>$_POST['urun_detay'],
			'urun_keyword'=>$_POST['urun_keyword'],
			'urun_sira'=>$_POST['urun_sira'],
			'urun_stok'=>$_POST['urun_stok'],
			'urun_seourl'=>$urun_seourl
		));

		if($insert){
			header("Location:../production/urun-ekle.php?durum=ok");
		}
		else{
			header("Location:../production/urun-ekle.php?durum=no");
		}
	}	


	/*--------------------------Ürün sil başlanır-----------------------*/

	if ($_GET['urunsil']=="ok") {
		$sil=$db->prepare("DELETE from urun WHERE urun_id=:id");
		$kontrol=$sil->execute(array(
			'id'=>$_GET['urun_id']));
		if($kontrol){
			header("Location:../production/urun.php?durum=silok");
		}else{
			header("Location:../production/urun.php?durum=silno");
		}

	}

	/*----------------------- Ürün sil bitir-------------------------*/



	if(isset($_POST['urunduzenle'])){

		if($_POST['urun_onecikar']==="on"){
			$urun_onecikar=1;
		} else{
			$urun_onecikar=0;
		}



		if($_POST['urun_durum']==="on"){
			$urun_durum=1;
		} else{
			$urun_durum=0;
		}

		$urun_id=$_POST['urun_id'];
		$urun_seourl=seo($_POST['urun_ad']);
		$kaydet=$db->prepare("UPDATE urun SET
			urun_ad=:urun_ad,
			urun_fiyat=:urun_fiyat,
			urun_durum=:urun_durum,
			kataqori_id=:kataqori_id,
			urun_detay=:urun_detay,
			urun_keyword=:urun_keyword,
			urun_sira=:urun_sira,
			urun_stok=:urun_stok,
			urun_seourl=:urun_seourl,
			urun_onecikar=:urun_onecikar
			WHERE urun_id=$urun_id");
		$insert=$kaydet->execute(array(
			'urun_ad'=>StrToUpper($_POST['urun_ad']),
			'urun_fiyat'=>$_POST['urun_fiyat'],
			'urun_durum'=>$urun_durum,
			'kataqori_id'=>$_POST['kataqori_id'],
			'urun_detay'=>$_POST['urun_detay'],
			'urun_keyword'=>$_POST['urun_keyword'],
			'urun_sira'=>$_POST['urun_sira'],
			'urun_stok'=>$_POST['urun_stok'],
			'urun_seourl'=>$urun_seourl,
			'urun_onecikar'=>$urun_onecikar
		));

		if($insert){
			header("Location:../production/urun-duzenle.php?durum=ok&$urun_id");
		}
		else{
			header("Location:../production/urun-duzenle.php?durum=no");
		}
	}	



	/*--------------------------Ürün one cixar başlanır-----------------------*/


	if ($_GET['urunonecixar']=="ok"){
		$urun_onecikar=0;
		$urun_id=$_GET['urun_id'];
		$kaydet=$db->prepare("UPDATE urun SET

			urun_onecikar=:urun_onecikar
			WHERE urun_id=$urun_id");
		$insert=$kaydet->execute(array(

			'urun_onecikar'=>$urun_onecikar
		));

		if($insert){
			header("Location:../production/urun.php");
		}
		else{
			header("Location:../production/urun.php");
		}
	}	




	if ($_GET['urunonecixarma']=="ok"){
		$urun_onecikar=1;
		$urun_id=$_GET['urun_id'];
		$kaydet=$db->prepare("UPDATE urun SET

			urun_onecikar=:urun_onecikar
			WHERE urun_id=$urun_id");
		$insert=$kaydet->execute(array(

			'urun_onecikar'=>$urun_onecikar
		));

		if($insert){
			header("Location:../production/urun.php");
		}
		else{
			header("Location:../production/urun.php");
		}
	}		



	if ($_GET['aktiv']=="ok"){
		$urun_durum=0;
		$urun_id=$_GET['urun_id'];
		$kaydet=$db->prepare("UPDATE urun SET

			urun_durum=:urun_durum
			WHERE urun_id=$urun_id");
		$insert=$kaydet->execute(array(

			'urun_durum'=>$urun_durum
		));

		if($insert){
			header("Location:../production/urun.php");
		}
		else{
			header("Location:../production/urun.php");
		}
	}	



	if ($_GET['passiv']=="ok"){
		$urun_durum=1;
		$urun_id=$_GET['urun_id'];
		$kaydet=$db->prepare("UPDATE urun SET

			urun_durum=:urun_durum
			WHERE urun_id=$urun_id");
		$insert=$kaydet->execute(array(

			'urun_durum'=>$urun_durum
		));

		if($insert){
			header("Location:../production/urun.php");
		}
		else{
			header("Location:../production/urun.php");
		}
	}	





	if(isset($_POST['yorumyaz'])){


		$gelen_url=$_POST['gelen_url'];
		$kullanici_ad=$_POST['kullanici_ad'];
		$kaydet=$db->prepare("INSERT INTO yorumlar set
			kullanici_id=:kullanici_id,
			kullanici_ad=:kullanici_ad,
			urun_id=:urun_id,
			yorum_detay=:yorum_detay
			");
		$insert=$kaydet->execute(array(
			'kullanici_id'=>$_POST['kullanici_id'],
			'kullanici_ad'=>$kullanici_ad,
			'urun_id'=>$_POST['urun_id'],
			'yorum_detay'=>htmlspecialchars($_POST['yorum_detay'])
		));

		if($insert){
			header("Location:$gelen_url");
		}
		else{
			header("Location:$gelen_url");
		}
	}


	if(isset($_POST['sebeteekle'])){
		$kaydet=$db->prepare("INSERT INTO seped set
			kullanici_id=:kullanici_id,
			urun_id=:urun_id,
			urun_aded=:urun_aded
			");
		$insert=$kaydet->execute(array(
			'kullanici_id'=>$_POST['kullanici_id'],
			'urun_id'=>$_POST['urun_id'],
			'urun_aded'=>htmlspecialchars($_POST['urun_aded'])
		));

		if($insert){
			header("Location:../../seped.php?durum=ok");
		}
		else{
			header("Location:$gelen_url");
		}
	}



	if ($_GET['sepedsil']=="ok") {

		$sil=$db->prepare("DELETE from seped WHERE seped_id=:id");
		$kontrol=$sil->execute(array(
			'id'=>$_GET['seped_id']));
		if($kontrol){
			header("Location:../../seped.php?durum=ok");
		}else{
			header("Location:../../seped.php?durum=no");
		}

	}


	/*--------------------yorum onay baslayir---------------------*/


	if ($_GET['yorum-aktiv']=="ok"){
		$yorum_durum=0;
		$yorum_id=$_GET['yorum_id'];
		$kaydet=$db->prepare("UPDATE yorumlar SET

			yorum_durum=:yorum_durum
			WHERE yorum_id=$yorum_id");
		$insert=$kaydet->execute(array(

			'yorum_durum'=>$yorum_durum
		));

		if($insert){
			header("Location:../production/yorumlar.php");
		}
		else{
			header("Location:../production/yorumlar.php");
		}
	}	



	if ($_GET['yorum-passiv']=="ok"){
		$yorum_durum=1;
		$yorum_id=$_GET['yorum_id'];
		$kaydet=$db->prepare("UPDATE yorumlar SET

			yorum_durum=:yorum_durum
			WHERE yorum_id=$yorum_id");
		$insert=$kaydet->execute(array(

			'yorum_durum'=>$yorum_durum
		));

		if($insert){
			header("Location:../production/yorumlar.php");
		}
		else{
			header("Location:../production/yorumlar.php");
		}
	}	

	/*--------------------yorum onay bitir---------------------*/


	/* ------------------yorum Duzenleme baslayir------------------*/
	if(isset($_POST['yorumduzenle'])){

		$yorum_id=$_POST['yorum_id'];
		$kaydet=$db->prepare("UPDATE yorumlar SET		
			yorum_detay=:yorum_detay
			WHERE yorum_id=$yorum_id");
		$insert=$kaydet->execute(array(

			'yorum_detay'=>$_POST['yorum_detay']
		));

		if($insert){
			header("Location:../production/yorumlar.php");
		}
		else{
			header("Location:../production/yorumlar.php");
		}
	}	



	/* ------------------yorum Duzenleme baslayir------------------*/


	/* ------------------Yorum Sil  baslayir------------------*/

	if ($_GET['yorumsil']=="ok") {
		$sil=$db->prepare("DELETE from yorumlar WHERE yorum_id=:id");
		$kontrol=$sil->execute(array(
			'id'=>$_GET['yorum_id']));
		if($kontrol){
			header("Location:../production/yorumlar.php?durum=silok");
		}else{
			header("Location:../production/yorumlar.php?durum=silno");
		}

	}

	/* ------------------Yorum Sil  Bitir------------------*/
	/* ------------------Bank Əlavə et başlayır------------------*/

	if(isset($_POST['bankekle'])){


		$kaydet=$db->prepare("INSERT INTO bank SET 
			bank_ad=:bank_ad,
			bank_iban=:bank_iban,
			bank_ad_soyad=:bank_ad_soyad");
		$insert=$kaydet->execute(array(
			'bank_ad'=>$_POST['bank_ad'],
			'bank_iban'=>$_POST['bank_iban'],
			'bank_ad_soyad'=>$_POST['bank_ad_soyad']
		));

		if($insert){
			header("Location:../production/bank-ekle.php?durum=ok");
		}
		else{
			header("Location:../production/bank-ekle.php?durum=no");
		}
	}	

	/* ------------------Bank Əlavə et başlayır------------------*/






	if(isset($_POST['bankduzenle'])){

		$bank_id=$_POST['bank_id'];
		$kaydet=$db->prepare("UPDATE bank SET
			bank_ad=:bank_ad,
			bank_iban=:bank_iban,
			bank_ad_soyad=:bank_ad_soyad
			WHERE bank_id=$bank_id");
		$insert=$kaydet->execute(array(
			'bank_ad'=>$_POST['bank_ad'],
			'bank_iban'=>$_POST['bank_iban'],
			'bank_ad_soyad'=>$_POST['bank_ad_soyad']
		));

		if($insert){
			header("Location:../production/bank.php?durum=ok&$bank_id");
		}
		else{
			header("Location:../production/bank.php?durum=no");
		}
	}	





	if ($_GET['banksil']=="ok") {
		$sil=$db->prepare("DELETE from bank WHERE bank_id=:id");
		$kontrol=$sil->execute(array(
			'id'=>$_GET['bank_id']));
		if($kontrol){
			header("Location:../production/bank.php?durum=silok");
		}else{
			header("Location:../production/bank.php?durum=silno");
		}

	}







	/*--------------------bank onay baslayir---------------------*/


	if ($_GET['bank-aktiv']=="ok"){
		$bank_durum=0;
		$bank_id=$_GET['bank_id'];
		$kaydet=$db->prepare("UPDATE bank SET

			bank_durum=:bank_durum
			WHERE bank_id=$bank_id");
		$insert=$kaydet->execute(array(

			'bank_durum'=>$bank_durum
		));

		if($insert){
			header("Location:../production/bank.php");
		}
		else{
			header("Location:../production/bank.php");
		}
	}	



	if ($_GET['bank-passiv']=="ok"){
		$bank_durum=1;
		$bank_id=$_GET['bank_id'];
		$kaydet=$db->prepare("UPDATE bank SET

			bank_durum=:bank_durum
			WHERE bank_id=$bank_id");
		$insert=$kaydet->execute(array(

			'bank_durum'=>$bank_durum
		));

		if($insert){
			header("Location:../production/bank.php");
		}
		else{
			header("Location:../production/bank.php");
		}
	}	

	/*--------------------bank onay bitir---------------------*/

	/*--------------------Siparis ver baslayir---------------------*/
/* burani gələcəkdə istifadə ucun saxlayiram oyrənmək ucun
	if(isset($_POST['bankasiparisekle'])){

		$siparis_tip="Bank Həvaləsi";
		$kaydet=$db->prepare("INSERT INTO siparis set
			kullanici_id=:kullanici_id,
			siparis_tip=:siparis_tip,
			siparis_toplam=:siparis_toplam,
			siparis_banka=:siparis_banka
			");
		$insert=$kaydet->execute(array(
			'kullanici_id'=>$_POST['kullanici_id'],
			'siparis_tip'=>$siparis_tip,
			'siparis_toplam'=>$_POST['siparis_toplam'],
			'siparis_banka'=>$_POST['siparis_banka']
		));

		if($insert){
			echo $siparis_id = $db->lastInsertId();
			echo "<hr>";
			$urunler= $_POST['urun_id'];
			foreach ($urunler as $urun ) {

				$urun_id=$_GET['urun_id'];
				$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:id");
				$urunsor->execute(array(
					'id'=>$urun));
				$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
				$urun_fiyat=$uruncek['urun_fiyat'];



				$kaydet=$db->prepare("INSERT INTO siparis_detay set
					siparis_id=:siparis_id,
					urun_id=:urun_id,
					urun_fiyat=:urun_fiyat
					");
				$insert=$kaydet->execute(array(
					'siparis_id'=>$siparis_id,
					'urun_id'=>$urun,
					'urun_fiyat'=>$urun_fiyat
				));
			}echo "string";

			}
			else{
				echo "Başarısız";
			}
		}
*/
		/*--------------------Siparis ver bitir---------------------*/

		/*--------------------Siparis ver baslayir---------------------*/

		if(isset($_POST['bankasiparisekle'])){

			$siparis_tip="Bank Həvaləsi";
			$kaydet=$db->prepare("INSERT INTO siparis set
				kullanici_id=:kullanici_id,
				siparis_tip=:siparis_tip,
				siparis_toplam=:siparis_toplam,
				siparis_banka=:siparis_banka
				");
			$insert=$kaydet->execute(array(
				'kullanici_id'=>$_POST['kullanici_id'],
				'siparis_tip'=>$siparis_tip,
				'siparis_toplam'=>$_POST['siparis_toplam'],
				'siparis_banka'=>$_POST['siparis_banka']
			));





			if($insert){
				$siparis_id = $db->lastInsertId();
				$kullanici_id=$_POST['kullanici_id'];
				$sepedsor=$db->prepare("SELECT * FROM seped where kullanici_id=:kullanici_id");
				$sepedsor->execute(array(
					'kullanici_id'=>$kullanici_id));
				while($sepedcek=$sepedsor->fetch(PDO::FETCH_ASSOC)){

					$urun_id=$sepedcek['urun_id'];
					$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:id");
					$urunsor->execute(array(
						'id'=>$urun_id));
					$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);					
					$urun_id=$sepedcek['urun_id'];					
					$urun_aded=$sepedcek['urun_aded'];
					$urun_fiyat=$uruncek['urun_fiyat'];
					$uruntoplam_fiyat=$urun_aded*$urun_fiyat;



					$kaydet=$db->prepare("INSERT INTO siparis_detay set
						siparis_id=:siparis_id,
						urun_id=:urun_id,
						urun_aded=:urun_aded,
						urun_fiyat=:urun_fiyat,
						uruntoplam_fiyat=:uruntoplam_fiyat
						");
					$insert=$kaydet->execute(array(
						'siparis_id'=>$siparis_id,
						'urun_id'=>$urun_id,
						'urun_aded'=>$urun_aded,
						'urun_fiyat'=>$urun_fiyat,
						'uruntoplam_fiyat'=>$uruntoplam_fiyat
					));
				}
				if($insert){
					$sil=$db->prepare("DELETE from seped WHERE kullanici_id=:kullanici_id");
					$kontrol=$sil->execute(array(
						'kullanici_id'=>$kullanici_id));
					if($kontrol){
						header("Location:../../siparislerim.php");
					}else{
						header("Location:../../siparislerim.php");
					}

				}


			}
			else{
				header("Location:../../siparis.php?durum=banksecin");
			}
		}

		/*--------------------Siparis ver bitir---------------------*/

if(isset($_POST['urunfotosil'])) {

	$urun_id=$_POST['urun_id'];


	echo $checklist = $_POST['urunfotosec'];

	
	foreach($checklist as $list) {

		$sil=$db->prepare("DELETE from urunfoto where urunfoto_id=:urunfoto_id");
		$kontrol=$sil->execute(array(
			'urunfoto_id' => $list
			));
	}

	if ($kontrol) {

		Header("Location:../production/urun-galeri.php?urun_id=$urun_id&durum=ok");

	} else {

		Header("Location:../production/urun-galeri.php?urun_id=$urun_id&durum=no");
	}


} 










		?>