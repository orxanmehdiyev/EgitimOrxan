


/*header mene ajax baslayir*/
function  kontrol(){
  var element = event.target;//event.target funksiyani tetikleyen elementi tapir
  var x = element.id;// element.id il' funksiyani teteikleyen elementin id si alinir
  var xhttp=new XMLHttpRequest();  // xhttp nesnesi yaradilir
  xhttp.open("POST","../nedmin/admin_islem.php",true);// emeliyat edilecek seyfe secilir
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");// elaveler post ucun gonderilir
  xhttp.send("menu_header_durum="+x);    // adi ve id si gonderilir

};
/*header mene ajax bitir*/

function kontrol2(){

 var element2=event.target;
 var menu_durum=element2.id;  
 var xhttp2=new XMLHttpRequest();
 xhttp2.open("POST","../nedmin/admin_islem.php",true);
 xhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
 xhttp2.send("menu_durum="+menu_durum);
 /* xhttp2.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
      document.getElementById('sonuc').innerHTML=this.responseText;
    }else{
       document.getElementById('sonuc').innerHTML="Problem";
  }
}*/
};

/*menu durum AJAX bitir*/


function kontrol3(){
  var element3=event.target;
  var menu_footer_durum=element3.id;  
  var xhttp3=new XMLHttpRequest();

  xhttp3.open("POST","../nedmin/admin_islem.php",true);

  xhttp3.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhttp3.send("menu_footer_durum="+menu_footer_durum);
 /* xhttp3.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
      document.getElementById('sonuc').innerHTML=this.responseText;
    }else{
     document.getElementById('sonuc').innerHTML="Problem";
   }
 }*/
};


/*menu durum AJAX bitir*/




/*menu sira AJAX başlayır*/

function menusira(){

  var elementmenu_sira=event.target;
  var menusira_id=elementmenu_sira.id;
  var menusira_value=elementmenu_sira.value;
  var menusiar_xhttp=new XMLHttpRequest();

  menusiar_xhttp.open("POST","../nedmin/admin_islem.php",true);

  menusiar_xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  menusiar_xhttp.send("menusira_id="+menusira_id+
    "&menusira_value="+menusira_value);
  window.location.reload(false);// səyfəyi yeniləyir

};



/*menu sira AJAX bitir*/







/*Admin istifadeci ad kontrol başlayir*/

function admin_nick(){
  var admin_nick_imput=event.target;
  var admin_istifateci_ad=admin_nick_imput.value;
  var admin_istifateci_ad_xhttp=new XMLHttpRequest();
  admin_istifateci_ad_xhttp.open("POST","../nedmin/admin_islem.php",true);
  admin_istifateci_ad_xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  admin_istifateci_ad_xhttp.send("admin_istifateci_ad="+admin_istifateci_ad);
  //console.log(admin_istifateci_ad_xhttp);
  admin_istifateci_ad_xhttp.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
      document.getElementById('admin_nick').innerHTML=this.responseText;
    }
  }
}

/*Admin istifadeci ad kontrol bitir*/

/*Admin E-mail kontrol baslayir*/
function admin_email(){
  var admin_email_imput=event.target;
  var admin_email=admin_email_imput.value;
  var admin_email_xhttp=new XMLHttpRequest();
  admin_email_xhttp.open("POST","../nedmin/admin_islem.php",true);
  admin_email_xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  admin_email_xhttp.send("admin_email="+admin_email);
  admin_email_xhttp.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
      document.getElementById('admin_email').innerHTML=this.responseText;
    }
  }
}
/*Admin E-mail kontrol bitir*/

/*Admin telefon kontrol baslayir*/
function adminGsm(){

  var admin_gsm_imput=event.target;
  var admin_gsm=admin_gsm_imput.value;
  var admin_gsm_xhttp=new XMLHttpRequest();

  admin_gsm_xhttp.open("POST","../nedmin/admin_islem.php",true);
  admin_gsm_xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  admin_gsm_xhttp.send("admin_gsm="+admin_gsm);
  admin_gsm_xhttp.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
      document.getElementById('admin_gsm').innerHTML=this.responseText;
    }
  }
}
/*Admin telefon kontrol bitir*/



/*admin durum mene ajax baslayir*/
function admindurum(){

  var admindurum_imput=event.target;
  var admin_durum=admindurum_imput.id;
  var admin_durum_xhttp=new XMLHttpRequest();

  admin_durum_xhttp.open("POST","../nedmin/admin_islem.php",true);
  admin_durum_xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  admin_durum_xhttp.send("admin_durum="+admin_durum);
}
/*admin durum mene ajax bitir*/



/*admin hakkimizda yetgi  ajax baslayir*/
function headerYetgi(){
 var headeryetgi=event.target;
 var adminhakkimizdayetgi=headeryetgi.name;
 var adminhakkimizdayetgi_xhttp=new XMLHttpRequest();

 adminhakkimizdayetgi_xhttp.open("POST","../nedmin/admin_islem.php",true);
 adminhakkimizdayetgi_xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
 adminhakkimizdayetgi_xhttp.send("adminhakkimizdayetgi="+adminhakkimizdayetgi);
}
/*aadmin hakkimizda yetgi ajax bitir*/


/*menularda adimini gorunmesi baslayir*/
function adminyetgi_iki(){
  var adminyetgi_iki=event.target;
  var adminyetgiiki_ad=adminyetgi_iki.name;
  var adminyetgi_iki_xhttp=new XMLHttpRequest();
  adminyetgi_iki_xhttp.open("POST","../nedmin/admin_islem.php",true);
  adminyetgi_iki_xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  adminyetgi_iki_xhttp.send("adminyetgiiki_ad="+adminyetgiiki_ad);


}
/*menularda adimini gorunmesi bitir*/




/*slider durum mene ajax baslayir*/
function sliderdurum(){

  var sliderdurum_imput=event.target;

  var slider_durum=sliderdurum_imput.id;
  var slider_durum_xhttp=new XMLHttpRequest();
  slider_durum_xhttp.open("POST","../nedmin/admin_islem.php",true);
  slider_durum_xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  slider_durum_xhttp.send("slider_durum="+slider_durum);
}
/*slider durum mene ajax bitir*/


/*Proqram kataqori ad baslayir*/


/*Proqram kataqori ad bitir*/

function kataqori(){
  var d=event.target;   
  var a=d.id;
  var res = a.substr(40);            
  if(res==0){
    document.getElementById("kataad").style.display = 'block';
  }else{
    document.getElementById("kataad").style.display = 'none';
  }
}



/*kataqori durum mene ajax baslayir*/
function proqramkatkontrol(){
  var programkataqoridurum_imput=event.target;
  var programkataqoridurum=programkataqoridurum_imput.id;
  var programkataqoridurum_xhttp=new XMLHttpRequest();
  programkataqoridurum_xhttp.open("POST","../nedmin/admin_islem.php",true);
  programkataqoridurum_xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  programkataqoridurum_xhttp.send("programkataqoridurum="+programkataqoridurum);
}
/*kataqori durum mene ajax bitir*/



/*Proqram durum*/
function programdurum(){
  var programdurum_imput=event.target;
  var proqram_durum=programdurum_imput.id;
  var proqram_durum_xhttp=new XMLHttpRequest();
  proqram_durum_xhttp.open("POST","../nedmin/admin_islem.php",true);
  proqram_durum_xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  proqram_durum_xhttp.send("proqram_durum="+proqram_durum);
}
/*Proqram durum*/


/*Alt menu sorgusu baslayir*/
function menusor(){
  var e = document.getElementById("menu_ust");
  var menu_id = e.options[e.selectedIndex].value;
  var menu_id_xhttp=new XMLHttpRequest();
  console.log(menu_id_xhttp);
  menu_id_xhttp.open("POST","../nedmin/admin_islem.php",true);
  menu_id_xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  menu_id_xhttp.send("menu_id="+menu_id);

  menu_id_xhttp.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
      if(this.responseText>0){
        document.getElementById('sec').style.display = 'block';
        var altmenu_id=Number(this.responseText);
        var altmenu_id_xhttp=new XMLHttpRequest();
        console.log(altmenu_id_xhttp);
        altmenu_id_xhttp.open("POST","../xeberelaveet.php",true);
        altmenu_id_xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        altmenu_id_xhttp.send("altmenu_id="+altmenu_id);


      }
      else{
        document.getElementById("sec").style.display = 'none';
      }
    }
  }
}
/*Alt menu sorgusu bitir*/


























