 <?php 
 ob_start();
 session_start();
 require_once 'baglan.php'; 
 require_once '../production/fonksiyon.php';


 /*==================================Admin Giriş başlayır================================*/

 if (isset($_POST['kullanici_giris'])) {
 	$kullanici_ad=$_POST['kullanici_ad'];
 	$kullanici_password=md5($_POST['kullanici_password']);
 	$kullanici_mail=$_POST['kullanici_ad'];

 	$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_durum=:kullanici_durum and kullanici_password=:kullanici_password and kullanici_ad=:kullanici_ad or kullanici_mail=:kullanici_mail and kullanici_durum=:kullanici_durum and kullanici_password=:kullanici_password ");
 	$kullanicisor->execute(array(
 		'kullanici_durum'=>1,
 		'kullanici_password'=>$kullanici_password,
 		'kullanici_ad'=>$kullanici_ad,
 		'kullanici_mail'=>$kullanici_mail
 	));
 	$kullanicisay=$kullanicisor->rowCount();

 	if ($kullanicisay==1) {
 		$_SESSION['kullanici_giris']=$kullanici_ad;
 		header("Location:../../index?durum=yes");
 	}else{	header("Location:../../index");
 }
}


/*================================Admin Giriş bitir====================================*/



if (isset($_POST['social_ayarguncelle'])) {
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		ayar_facebook=:ayar_facebook,
		ayar_twitter=:ayar_twitter,
		ayar_google=:ayar_google,
		ayar_youtube=:ayar_youtube
		WHERE ayar_id=0");
	$update=$ayarkaydet->execute(array(
		'ayar_facebook' => $_POST['ayar_facebook'],
		'ayar_twitter' => $_POST['ayar_twitter'],
		'ayar_google'=>$_POST['ayar_google'],		
		'ayar_youtube' =>$_POST['ayar_youtube']
	));
	if ($update) {
		header("Location:../production/social-ayarlar?durum=ok");
	} 
	else {
		header("Location:../production/social-ayarlar?durum=no");
	}
}



if(isset($_POST['umumi_ayarguncelle'])){
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		ayar_title=:ayar_title,
		ayar_description=:ayar_description,
		ayar_keywords=:ayar_keywords,
		ayar_author=:ayar_author
		WHERE ayar_id=0");
	$update=$ayarkaydet->execute(array(
		'ayar_title'=>$_POST['ayar_title'],
		'ayar_description'=>$_POST['ayar_description'],
		'ayar_keywords'=>$_POST['ayar_keywords'],
		'ayar_author'=>$_POST['ayar_author']
	));
	if ($update) {
		header("Location:../production/ayarlar?durum=ok");
	} 
	else {
		header("Location:../production/ayarlar?durum=no");
	}
}




if(isset($_POST['elaqe_ayarguncelle'])){
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		ayar_elaqe_basliq=:ayar_elaqe_basliq,
		ayar_tel=:ayar_tel,
		ayar_gsm=:ayar_gsm,
		ayar_faks=:ayar_faks,
		ayar_mail=:ayar_mail,
		ayar_dovlet=:ayar_dovlet,
		ayar_seher=:ayar_seher,
		ayar_adres=:ayar_adres

		WHERE ayar_id=0");
	$update=$ayarkaydet->execute(array(
		'ayar_elaqe_basliq'=>$_POST['ayar_elaqe_basliq'],
		'ayar_tel'=>$_POST['ayar_tel'],
		'ayar_gsm'=>$_POST['ayar_gsm'],
		'ayar_faks'=>$_POST['ayar_faks'],
		'ayar_mail'=>$_POST['ayar_mail'],
		'ayar_dovlet'=>$_POST['ayar_dovlet'],
		'ayar_seher'=>$_POST['ayar_seher'],
		'ayar_adres'=>$_POST['ayar_adres']

	));
	if ($update) {
		header("Location:../production/elaqe-ayar?durum=ok");
	} 
	else {
		header("Location:../production/elaqe-ayar?durum=no");
	}
}




if(isset($_POST['ayar_map'])){
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
		header("Location:../production/ayar_map?durum=ok");
	} 
	else {
		header("Location:../production/ayar_map?durum=no");
	}
}



if(isset($_POST['bakim'])){
	if( $_POST['bakimmod']==on){
		$bakim=1;
	}
	else{
		$bakim=0;
	};
	
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		ayar_bakim=:ayar_bakim
		WHERE ayar_id=0");
	$update=$ayarkaydet->execute(array(
		'ayar_bakim'=>$bakim

	));
	if ($update) {
		header("Location:../production/ayar_bakim?durum=ok");
	} 
	else {
		header("Location:../production/ayar_bakim?durum=no");
	}
}





if(isset($_POST['smtp'])){
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
		header("Location:../production/ayar_smtpp?durum=ok");
	} 
	else {
		header("Location:../production/ayar_smtpp?durum=no");
	}
}















/*=====================================User kayid başlayır==========================================*/
if(isset($_POST['kullanici_kayit'])){

	$kullanici_ad=$_POST['kullanici_ad'];
	$kullanici_mail=$_POST['kullanici_mail'];
	$kullanici_gsm=$_POST['kullanici_gsm'];
	$password1=$_POST['password1'];
	$password2=$_POST['password2'];
	$kullanici_mail_kod=uniqid();
	$kullanici_mail_kod=substr($kullanici_mail_kod,7);
	if ($password2==$password1) {

		$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_ad=:kullanici_ad or kullanici_mail=:kullanici_mail or kullanici_gsm=:kullanici_gsm ");
		$kullanicisor->execute(array(
			'kullanici_ad'=>$kullanici_ad,
			'kullanici_mail'=>$kullanici_mail,
			'kullanici_gsm'=>$kullanici_gsm
		));	
		$kullanicikayidsor=$kullanicisor->rowCount();
		if($kullanicikayidsor==0){
			$kaydet=$db->prepare("INSERT INTO kullanici SET 
				kullanici_ad=:kullanici_ad,
				kullanici_mail=:kullanici_mail,
				kullanici_password=:kullanici_password,
				kullanici_gsm=:kullanici_gsm,
				kullanici_adsoyad=:kullanici_adsoyad,
				kullanici_dovlet=:kullanici_dovlet,
				kullanici_seher=:kullanici_seher,
				kullanici_unvan=:kullanici_unvan,
				kullanici_mail_kod=:kullanici_mail_kod
				");
			$insert=$kaydet->execute(array(
				'kullanici_ad'=>$kullanici_ad,
				'kullanici_mail'=>$kullanici_mail,
				'kullanici_password'=>md5($password1),
				'kullanici_gsm'=>$kullanici_gsm,
				'kullanici_adsoyad'=>$_POST['kullanici_adsoyad'],
				'kullanici_dovlet'=>$_POST['kullanici_dovlet'],
				'kullanici_seher'=>$_POST['kullanici_seher'],
				'kullanici_unvan'=>$_POST['kullanici_unvan'],
				'kullanici_mail_kod'=>$kullanici_mail_kod

			));
			if($insert){
				header("Location:../../registr?durum=ok");
			}
			else{
				header("Location:../../registr?durum=no");
			}

		}else{
			header("Location:../../registr?durum=nok");
		}
		

	}
}


/*==============================================User kayid bitir==========================================*/




/*==================================Kullanici  ad kontrol baslayir================================*/
if(isset($_POST['kullanici_ad'])){
	$kullanici_ad=$_POST['kullanici_ad'];

	$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_ad=:kullanici_ad ");
	$kullanicisor->execute(array(
		'kullanici_ad'=>$kullanici_ad,
	));	
	$kullanicikayidsor=$kullanicisor->rowCount();	
	if($kullanicikayidsor==0){

	}else{
		echo " Bu istifadçi adı mövçüdur xaiş edirik başaq ad secin";
	}
}

/*==========================================Kullanici  ad kontrol bitir================================*/

/*==================================Kullanici  email kontrol baslayir================================*/
if(isset($_POST['kullanici_mail'])){
	$kullanici_mail=$_POST['kullanici_mail'];

	$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:kullanici_mail ");
	$kullanicisor->execute(array(
		'kullanici_mail'=>$kullanici_mail,
	));	
	$kullanicikayidsor=$kullanicisor->rowCount();	
	if($kullanicikayidsor==0){

	}else{
		echo " Bu e-mail mövçüdur xaiş edirik başaq e-mail secin";
	}
}

/*==========================================Kullanici  email kontrol bitir================================*/



/*==================================Kullanici  email kontrol baslayir================================*/
if(isset($_POST['kullanici_gsm'])){
	$kullanici_gsm=$_POST['kullanici_gsm'];

	$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_gsm=:kullanici_gsm ");
	$kullanicisor->execute(array(
		'kullanici_gsm'=>$kullanici_gsm,
	));	
	$kullanicikayidsor=$kullanicisor->rowCount();	
	if($kullanicikayidsor==0){

	}else{
		echo " Bu telefon mövçüdur xaiş edirik başaq telefon secin";
	}
}

/*==========================================Kullanici  email kontrol bitir================================*/











/*=====================================Kullanici düzəliş et başlayır==========================================*/
if(isset($_POST['kullanici_duzenle'])){
	$kullanici_id=$_POST['kullanici_id'];
	$password=md5($_POST['password']);
	$kullanici_ad=$_POST['kullanici_add'];
	$kullanici_mail=$_POST['kullanici_maill'];
	$kullanici_gsm=$_POST['kullanici_gsmm'];

	$kullanicipassor=$db->prepare("SELECT * FROM kullanici where kullanici_id=:kullanici_id  ");
	$kullanicipassor->execute(array(
		'kullanici_id'=>$kullanici_id
	));	
	$kullanicipascek=$kullanicipassor->fetch(PDO::FETCH_ASSOC);
	if($password==$kullanicipascek['kullanici_password']){

		$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_ad=:kullanici_ad  ");
		$kullanicisor->execute(array(
			'kullanici_ad'=>$kullanici_ad
		));	
		$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
		$kullanicikayidsor=$kullanicisor->rowCount();

		if($kullanicikayidsor==1 && $kullanici_id==$kullanicicek['kullanici_id'] ){
			$kullanicikayidsor=1;

		}
		elseif($kullanicikayidsor==0){
			$kullanicikayidsor=1;

		}else{
			header("Location:../../kullanici_duzenle?durum=advar");
			exit;
		}

		if($kullanicikayidsor==1  ){

			$kullanicisor1=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:kullanici_mail");
			$kullanicisor1->execute(array(			
				'kullanici_mail'=>$kullanici_mail
			));	
			$kullanicicek1=$kullanicisor1->fetch(PDO::FETCH_ASSOC);
			$kullanicikayidsor1=$kullanicisor1->rowCount();



			if($kullanicikayidsor1==1 && $kullanici_id==$kullanicicek1['kullanici_id'] ){
				$kullanicikayidsort1=1;

			}
			elseif($kullanicikayidsor1==0){
				$kullanicikayidsort1=1;


			}else{
				header("Location:../../kullanici_duzenle?durum=mailvar");
			}

			if($kullanicikayidsort1==1){

				$kullanicisor2=$db->prepare("SELECT * FROM kullanici where kullanici_gsm=:kullanici_gsm ");
				$kullanicisor2->execute(array(			
					'kullanici_gsm'=>$kullanici_gsm
				));	
				$kullanicicek2=$kullanicisor2->fetch(PDO::FETCH_ASSOC);
				$kullanicikayidsor2=$kullanicisor2->rowCount();

				if($kullanicikayidsor2==1 && $kullanici_id==$kullanicicek2['kullanici_id']){
					$kullanicikayidsort2=1;

				}
				elseif($kullanicikayidsor2==0){
					$kullanicikayidsort2=1;
					
				}else{
					header("Location:../../kullanici_duzenle?durum=telvar");
				}


				if($kullanicikayidsort2==1){
					$kaydet=$db->prepare("UPDATE kullanici SET 
						kullanici_ad=:kullanici_ad,
						kullanici_mail=:kullanici_mail,
						kullanici_gsm=:kullanici_gsm,
						kullanici_adsoyad=:kullanici_adsoyad,
						kullanici_dovlet=:kullanici_dovlet,
						kullanici_seher=:kullanici_seher,
						kullanici_unvan=:kullanici_unvan
						WHERE kullanici_id=$kullanici_id
						");
					$insert=$kaydet->execute(array(
						'kullanici_ad'=>$kullanici_ad,
						'kullanici_mail'=>$kullanici_mail,
						'kullanici_gsm'=>$kullanici_gsm,
						'kullanici_adsoyad'=>$_POST['kullanici_adsoyad'],
						'kullanici_dovlet'=>$_POST['kullanici_dovlet'],
						'kullanici_seher'=>$_POST['kullanici_seher'],
						'kullanici_unvan'=>$_POST['kullanici_unvan']
					));
					if($insert){

						$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_durum=:kullanici_durum and kullanici_password=:kullanici_password and kullanici_ad=:kullanici_ad and kullanici_mail=:kullanici_mail");
						$kullanicisor->execute(array(
							'kullanici_durum'=>1,
							'kullanici_password'=>$password,
							'kullanici_ad'=>$kullanici_ad,
							'kullanici_mail'=>$kullanici_mail
						));
						$kullanicisay=$kullanicisor->rowCount();

						if ($kullanicisay==1) {
							$_SESSION['kullanici_giris']=$kullanici_ad;
							header("Location:../../kullanici_duzenle?durum=ok");
						}else{	header("Location:../../index?durum=no");
					}

				}
				else{
					header("Location:../../kullanici_duzenle?durum=no");
				}
			}
		}
	}
}else{
	header("Location:../../kullanici_duzenle?durum=kodsef");
	exit;
}



}

/*===============================Kullanici düzəliş et bitir==============================================*/


/*=====================================Kullanici sifre düzəliş et baslayir================================*/
if(isset($_POST['kullanici_sifreduzenle'])){
	$kullanici_id=$_POST['kullanici_id'];
	$password=md5($_POST['password']);
	$password1=md5($_POST['password1']);
	$password2=md5($_POST['password2']);
	$kullanici_ad=$_POST['kullanici_ad'];
	$kullanici_mail=$_POST['kullanici_mail'];
	

	$kullanicipassor=$db->prepare("SELECT * FROM kullanici where kullanici_id=:kullanici_id  ");
	$kullanicipassor->execute(array(
		'kullanici_id'=>$kullanici_id
	));	
	$kullanicipascek=$kullanicipassor->fetch(PDO::FETCH_ASSOC);
	if($password==$kullanicipascek['kullanici_password']){

		if($password1==$password2){
			$kaydet=$db->prepare("UPDATE kullanici SET 
				kullanici_password=:kullanici_password
				WHERE kullanici_id=$kullanici_id
				");
			$insert=$kaydet->execute(array(
				'kullanici_password'=>$password1
			));
			if($insert){
				$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_durum=:kullanici_durum and kullanici_password=:kullanici_password and kullanici_ad=:kullanici_ad and kullanici_mail=:kullanici_mail");
				$kullanicisor->execute(array(
					'kullanici_durum'=>1,
					'kullanici_password'=>$password1,
					'kullanici_ad'=>$kullanici_ad,
					'kullanici_mail'=>$kullanici_mail
				));
				$kullanicisay=$kullanicisor->rowCount();

				if ($kullanicisay==1) {
					$_SESSION['kullanici_giris']=$kullanici_ad;
					header("Location:../../kullanici_sifre_duzenle?sifre=ok");
				}else{	header("Location:../../index?durum=no");
			}

		}
		else{
			header("Location:../../kullanici_sifre_duzenle?durum=no");
		}
		

	}else{
		header("Location:../../kullanici_sifre_duzenle?durum=eynideyil");
	}
}else{
	header("Location:../../kullanici_sifre_duzenle?durum=kohnesef");
}

}

/*===============================Kullanici sifre duzene bitir==============================================*/












?>