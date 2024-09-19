 
/*kullanici ad kontrol başlayir*/

function user_nick(){
  var user_nick_imput=event.target; 
  var kullanici_ad=user_nick_imput.value;
  var kullanici_ad_xhttp=new XMLHttpRequest();
  kullanici_ad_xhttp.open("POST","admin/nedmin/islem.php",true);
  kullanici_ad_xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  kullanici_ad_xhttp.send("kullanici_ad="+kullanici_ad);
  console.log(kullanici_ad_xhttp);
  kullanici_ad_xhttp.onreadystatechange=function(){
   if(this.readyState==4 && this.status==200){
    document.getElementById('user_nick').innerHTML=this.responseText;
  }
}
}

/*Kullanici ad kontrol bitir*/


/*kullanici mail kontrol başlayir*/
function useremail(){
  var kullanici_mail_imput=event.target; 
  var kullanici_mail=kullanici_mail_imput.value;
  var kullanici_mail_xhttp=new XMLHttpRequest();
  console.log(kullanici_mail_xhttp);
  kullanici_mail_xhttp.open("POST","admin/nedmin/islem.php",true);
  kullanici_mail_xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  kullanici_mail_xhttp.send("kullanici_mail="+kullanici_mail);
  console.log(kullanici_mail_xhttp);
  kullanici_mail_xhttp.onreadystatechange=function(){
   if(this.readyState==4 && this.status==200){
    document.getElementById('kullanici_mail').innerHTML=this.responseText;
  }
}
}
/*Kullanici mail kontrol bitir*/


/*kullanici gsm kontrol başlayir*/
function usergsm(){
  var kullanici_gsm_imput=event.target; 
  var kullanici_gsm=kullanici_gsm_imput.value;
  var kullanici_gsm_xhttp=new XMLHttpRequest();
  kullanici_gsm_xhttp.open("POST","admin/nedmin/islem.php",true);
  kullanici_gsm_xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  kullanici_gsm_xhttp.send("kullanici_gsm="+kullanici_gsm);
  console.log(kullanici_gsm_xhttp);
  kullanici_gsm_xhttp.onreadystatechange=function(){
   if(this.readyState==4 && this.status==200){
    document.getElementById('kullanici_gsm').innerHTML=this.responseText;
  }
}
}
/*Kullanici gsm kontrol bitir*/

