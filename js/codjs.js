// JavaScript Document
function check_cedula( form )
{
  var cedula = form.ced.value;
  array = cedula.split( "" );
  num = array.length;
  if ( num == 10 )
  {
    total = 0;
    digito = (array[9]*1);
    for( i=0; i < (num-1); i++ )
    {
      mult = 0;
      if ( ( i%2 ) != 0 )
        total = total + ( array[i] * 1 );
      else
      {
        mult = array[i] * 2;
        if ( mult > 9 )
          total = total + ( mult - 9 );
        else
          total = total + mult;
      }
    }
    decena = total / 10;
    decena = Math.floor( decena );
    decena = ( decena + 1 ) * 10;
    final = ( decena - total );
    if ( ( final == 10 && digito == 0 ) || ( final == digito ) ){
    }else
    {
      return false;
    }
  }
  else
  {
    return false;
  }
}
function verific(fvc){
	if(check_cedula(fvc)==false && fvc.ced.value.length>0){
	 alert('Cedula Incorrecto');
	 fvc.ced.value='';
	 }
}
function valid(f,string){
//no = new Array ('profesion','fonotrabajo','n','n1','n2','dpto','ccn');
var no  = string.split(",");
var msj="";
var nc=0;
var opcional=0;
//bucle for paso 16 para saber el total campos
	for(i=0; i<f.length; i++){
	//si el elemento definido en la array formulario esta vacio...
		if(f.elements[i].value == ""){
		  for(j=0;j<no.length;j++){
			 if(f.elements[i].name==no[j]){//campos no *
			   opcional=1;
			  }
		  }
		   if(opcional!=1){
			// cambio de color el fondo a rojo y la letra
			f.elements[i].style.backgroundColor = '#84FFFF';
			nc=1;
		   }
		   opcional=0;
		}else{
		f.elements[i].style.backgroundColor = '';
		}
	}
 //verificar email valido
/* if(f.email.value.indexOf('@')<1 && nc<1){
	 f.email.focus();
	 msj='E-Mail ingresado incorrecto';
 }////////////////fin email*/
 // verificar condiciones
 /*if(f.pv.checked==true && f.ac.checked==false && nc<1){
	 msj='Debe Aceptar las Condiciones de Uso';
 }////////////////fin email*/
/* if(f.Pais.value=='ECUADOR' && check_cedula(f)==false){
	 msj='Nº Cédula Invalido';
	 f.cedula.focus();
 }////////////////verificar cedula*/
 if(nc<1 && msj==''){
  f.btng.value='Guardando..';
  f.btng.disabled=true;
 // f.btnc.disabled=true;
  f.submit();
 }else{
 alert("Favor ingrese todos los datos obligatorios: \n\n" + msj);
 }	
}
function validfc(f,string){
//no = new Array ('profesion','fonotrabajo','n','n1','n2','dpto','ccn');
var no  = string.split(",");
var msj="";
var nc=0;
var opcional=0;
//bucle for paso 16 para saber el total campos
	for(i=0; i<f.length; i++){
	//si el elemento definido en la array formulario esta vacio...
		if(f.elements[i].value == ""){
		  for(j=0;j<no.length;j++){
			 if(f.elements[i].name==no[j]){//campos no *
			   opcional=1;
			  }
		  }
		   if(opcional!=1){
			// cambio de color el fondo a rojo y la letra
			f.elements[i].style.backgroundColor = '#FF8080';
			nc=1;
		   }
		   opcional=0;
		}else{
		f.elements[i].style.backgroundColor = '';
		}
	}
 if(nc<1 && msj==''){
  f.btne.value='Enviando..';
  f.btne.disabled=true;
  f.submit();
 }else{
 alert("Favor ingrese todos los datos");
 }	
}
function m_o(m,b){
	$("#ds1").css("display", "none");
	$("#ds2").css("display", "none");
	$("#ds3").css("display", "none");
	$("#dan").css("display", "none");
	$("#dco").css("display", "none");
	$("#bs1").removeClass('botonesa').addClass('botones');
	$("#bs2").removeClass('botonesa').addClass('botones');
	$("#bs3").removeClass('botonesa').addClass('botones');
	$("#ban").removeClass('botonesa').addClass('botones');
	$("#bco").removeClass('botonesa').addClass('botones');
	$(b).removeClass('botones').addClass('botonesa');
	$(m).toggle(200);
}
function m_o1(m){
	$("#la").css("display", "none");
	$("#ld").css("display", "none");
	$("#lp").css("display", "none");
	$(m).toggle(200);
}
function selp(c,ic){
	if(document.getElementById(c).checked==true){
		document.getElementById(ic).style.backgroundColor='#CCCCCC';
	}else{
		document.getElementById(ic).style.backgroundColor='';
	}
}
function selp1(c,ic){
	if(document.getElementById(c).checked==true){
		document.getElementById(c).checked=false;
		document.getElementById(ic).style.backgroundColor='';
	}else{
		document.getElementById(c).checked=true;
		document.getElementById(ic).style.backgroundColor='#CCCCCC';
	}
}
function ingresado(){
window.opener.location.reload();
//window.close();
}
//codigo kanpeon//
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function pocision(a){
	//document.getElementById('flotante').style.display='block';
	if(a==1){
	$('#flotante').toggle(200);
	}else{
	 document.getElementById('flotante').style.display='none';
	}
}