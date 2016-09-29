<?php 
if (!isset($_SESSION)) {
  session_start();
}
/*error_reporting(0);*/
include_once("../conect.php");
if($_SESSION['id_us']){
$idop=$_SESSION['id_us'];
$du=mysql_fetch_object(mysql_query("select * from usuarios where idus=".$idop));
}else{
header("Location:index.php");
}//fin de if($_SESSION['cod_e']){
if($_GET['option']){
$op=$_GET['option'];
$_SESSION['option']=$op;
}elseif($_SESSION['option']){
$op=$_SESSION['option'];
}else{
$op='ini';
}
$mes=array("Ene.","Feb.","Mar.","Abr.","May.","Jun.","Jul.","Ago.","Sep.","Oct.","Nov.","Dic.");
$sc=mysql_query("select * from categorias");
while($rowc=mysql_fetch_object($sc)){
 $categ[$rowc->cat]=$rowc->nom;
}
////// actualizar admin///////////
if($_POST['fadmin']==1){
	foreach ($_POST as $key => $value) {
		//echo "Key: $key; Value: $value<br />\n";
		$dat[$key] = trim($value);
	}
	 if(mysql_query("update usuarios set nombre='".$dat['nom']."',apellido='".$dat['ape']."',ciudad='".$dat['ciu']."',direccion='".$dat['dir']."',telefono='".$dat['tel']."',celular='".$dat['cel']."',email='".$dat['ema']."',pais='".$dat['pai']."' where idus=".$idop)){
  header("Location:index_1.php");	
  }else{
  header("Location:index_1.php");	
  }
}
/////fin de guardar admin//////////
//delete noticia
if($_GET['dn']){
$vdg=sprintf("%d",$_GET['dn']);
$f1=$_GET['im'];
mysql_query("delete from noticias where idn=".$vdg);
	$rutap="../imagenes/p/".$f1;
	$rutag="../imagenes/g/".$f1;
		if (file_exists($rutap)){
		unlink($rutap);
		}
		 if (file_exists($rutag)){
		unlink($rutag);
		}	
}
//fin de delete noticia
//delete paquete
if($_GET['dp']){
$vdg=sprintf("%d",$_GET['dp']);
//$codp=mysql_fetch_object(mysql_query("select codp from detalleproductos where coddp=".$vdg));
//$np=mysql_num_rows(mysql_query("select codp from detalleproductos where codp=".$codp->codp));
	//if($np<=1){
		$fotos=mysql_fetch_object(mysql_query("select imagenp from productos where codp=".$vdg));
		$f=explode("+",$fotos->imagenp);
		if($f[0]){
			unlink("../imagenes/p/". $f[0]);
			unlink("../imagenes/g/". $f[0]);
		}
		if($f[1]){
			unlink("../imagenes/p/". $f[1]);
			unlink("../imagenes/g/". $f[1]);
		}
		if($f[2]){
			unlink("../imagenes/p/". $f[2]);
			unlink("../imagenes/g/". $f[2]);
		}
		mysql_query("delete from productos where codp=".$vdg);
	//}
	//mysql_query("delete from detalleproductos where coddp=".$vdg);
}
//fin de delete producto
///guardar cotizacion//////////
if($_POST['nomc'] and $_POST['emailc']){
 mysql_query("insert into cotiza values('','','".$_POST['nomc']."','','','".$_POST['emailc']."',NOW())");
  $sql=mysql_query("SELECT LAST_INSERT_ID( ) AS cnum FROM cotiza");
$sql1=mysql_fetch_object($sql);
$numc=$sql1->cnum;//recuperamos y guradamos el id de acceso
  $msjcot='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<LINK HREF="../style.css" TYPE="text/css" REL="stylesheet">
<title>COTIZACIÓN</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #FFFFFF;
	font-size:10px;
	font-family:Verdana;
}
.style1 {color: #FFFFFF}
.Estilo11 {font-size: 12px}
.Estilo14 {font-size: 9px}
.style21 {font-size: 9px}
-->
</style>
</head>
<body"><br><table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
      </p>
      <br />
      <br />
      <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
        <tr bgcolor="#FFFFFF">
          <td class="ladoi"><table width="100%" border="0" cellpadding="5" cellspacing="0">
              <tr>
                <td><img src="http://www.swat-store.com/imagenes/logo.jpg" width="112" height="56" /></td>
                <td><div align="center">
                      <strong>Swat Store</strong><br />
                      Matriz: '.$du->direccion.'<br />Teléfono:'.$du->telefono.'<br /> 
                      '.$du->ciudad.'-'.$du->pais.'<br /></div></td>
              </tr>
            </table>
          </td>
          <td class="ladod"><strong>Proforma N&ordm;</strong>: '.$numc.'</td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td class="ladoi"><strong>Nombre: </strong>'.$_POST['nomc'].'</td>
          <td nowrap="nowrap" class="ladod"><strong>Fecha: </strong>'.date('d-m-Y').'</td>
        </tr>
      </table>
      <br />
      <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
          <th width="170" bgcolor="#FFFFFF" class="ladobi">Producto</th>
          <th width="70" bgcolor="#FFFFFF" class="ladobi">V. Unit </th>
          <th width="50" bgcolor="#FFFFFF" class="ladobi">Cantidad</th>
          <th width="80" bgcolor="#FFFFFF" class="ladobi">V. Total </th>
        </tr>';
			  $i=1;
			  $compramp=$_SESSION['cotiza'];
			     foreach($compramp as $k => $v){ 
				 //$producto=mysql_query("select * from productos where codp='$k'");
				 //$producto1=mysql_fetch_object($producto);
        $msjcot.='<tr bgcolor="#FFFFFF">
          <td class="ladobi"><div align="center">'.$compramp[$k]['prod'].'</div></td>
          <td class="ladobi"><div align="center">'.sprintf("%01.2f",$compramp[$k]['prec']).'</div></td>
          <td class="ladobi"><div align="center">'.$compramp[$k]['cant'].'</div></td>
          <td class="ladobi"><div align="center">';
				$vtotal=$compramp[$k]['cant']*$compramp[$k]['prec'];
				$msjcot.=sprintf("%01.2f",$vtotal); 
				$subtotal=$subtotal+$vtotal;
         $msjcot.=' </div></td>
        </tr>';
			  } // fin de foreach($compramp as $k => $v){ 
       $msjcot.='
        <tr bgcolor="#FFFFFF">
          <td colspan="3" class="ladoi"><div align="right" ><strong>TOTAL</strong></div></td>
          <td nowrap="nowrap" class="ladobi"><div align="center">';
			  $total=round($subtotal+$iva+$operadora,2);
			  $msjcot.=sprintf("%01.2f",$total).'</div></td>
        </tr>
      </table>
      <br />
      <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
        <tr bgcolor="#FFFFFF">
          <td class="ladoi">'.$_POST['comc'].'</td>
        </tr>
      </table></td>
  </tr>
</table>';
if($_POST['link']==1){//envio de link de pago opcional
$msjcot.='<table width="90%" align="center" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC"><tr bgcolor="#FFFFFF"><td>Puede Realizar el pago de forma segura en el siguiente Link:<br>
<a href="http://blueplanetecuador.com/blueplanet/pago.php?id='. md5($numc) .'">http://blueplanetecuador.com/blueplanet/pago.php?id='. md5($numc) .'
</a></td></tr></table>';
}
$msjcot.='</body>
</html>';
mysql_query("update cotiza set idl='".md5($numc)."',msj='$msjcot',total='$total' where idcot='$numc'");
// Para enviar correo HTML, la cabecera Content-type debe definirse
			$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
			$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			// Cabeceras adicionales
		   $cabeceras .= 'From: info@swat-store.com' . "\r\n";
		 // Enviamos el mensaje por e-mail
			@mail($_POST['emailc'], 'Cotización Swat Store', $msjcot,$cabeceras);
			unset($_SESSION['cotiza']);
header("Location:index_1.php?env=1");			
}//fin de if($_GET['gc']==1){
///////////fin de guardar cotizacion////
//delete testimonio
if($_GET['dt']){
$vdg=sprintf("%d",$_GET['dt']);
		$fotos=mysql_fetch_object(mysql_query("select foto from testimonios where idt=".$vdg));
		$f=explode("+",$fotos->foto);
		if($f[0]){
			unlink("../imagenes/p/". $f[0]);
			unlink("../imagenes/g/". $f[0]);
		}
		if($f[1]){
			unlink("../imagenes/p/". $f[1]);
			unlink("../imagenes/g/". $f[1]);
		}
		if($f[2]){
			unlink("../imagenes/p/". $f[2]);
			unlink("../imagenes/g/". $f[2]);
		}
		mysql_query("delete from testimonios where idt=".$vdg);
}
//fin de delete testimonio
//delete noticia
if($_GET['dn']){
$vdg=sprintf("%d",$_GET['dn']);
		$fotos=mysql_fetch_object(mysql_query("select f1 from noticias where idn=".$vdg));
		if($f[0]){
			unlink("../imagenes/p/". $fotos->f1);
			unlink("../imagenes/g/". $fotos->f1);
		}
	
		mysql_query("delete from noticias where idn=".$vdg);
}
//fin de delete noticia
//delete restaurante
if($_GET['dr']){
$vdg=sprintf("%d",$_GET['dr']);
		$fotos=mysql_fetch_object(mysql_query("select foto from restaurantes where idr=".$vdg));
		$f=explode("+",$fotos->foto);
		if($f[0]){
			unlink("../imagenes/p/". $f[0]);
			unlink("../imagenes/g/". $f[0]);
		}
		if($f[1]){
			unlink("../imagenes/p/". $f[1]);
			unlink("../imagenes/g/". $f[1]);
		}
		if($f[2]){
			unlink("../imagenes/p/". $f[2]);
			unlink("../imagenes/g/". $f[2]);
		}
		mysql_query("delete from restaurantes where idr=".$vdg);
}
//fin de delete vuelo
//delete Galeria
if($_GET['dg']){
$vdg=sprintf("%d",$_GET['dg']);
$f1=$_GET['im'];
$tip=$_GET['tip'];
mysql_query("delete from galeria where idg=".$vdg);
	if($tip==1 or $tip==3 or $tip==2){//borrar imagen si es el caso
	$rutap="../imagenes/p/".$f1;
	$rutag="../imagenes/g/".$f1;
		if (file_exists($rutap)){
		unlink($rutap);
		}
		 if (file_exists($rutag)){
		unlink($rutag);
		}
	}	
}
//fin de delete galeria
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="../favicon.ico" >
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>APLICACION CHACAY</title>
<link rel="stylesheet" type="text/css" href="../fancybox/jquery.fancybox.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../css/admin.css" media="screen" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../fancybox/jquery.fancybox.js"></script>
<script language="javascript">
$(document).ready(function() {
	/* This is basic - uses default settings */
	$("a#single_image").fancybox();
	/* Using custom settings */
	$("a#inline").fancybox({
		'hideOnContentClick': true
	});
	/* Apply fancybox to multiple items */
	$("a.group").fancybox();
});
function buscao(f){
	if(f.orden.value==''){
		alert("Ingrese un numero de orden");
	}else{
		 f.submit();
	}
}
function enviob(f){
	if(f.pal.value==''){
		alert("Ingrese una palabra de busqueda");
		f.pal.focus();
	}else{
		 f.submit();
	}
}
</script>				
<script language="javascript">
function validap(f){
 if(f.nombre.value==''){
 alert("Ingrese Nombre");
 }else if(f.codigo.value==''){
 alert("Ingrese código de artículo");
 }else if(f.cantidad.value==''){
 alert("Ingrese cantidad");
 }else{
 f.submit();
 }
}
function confirmap(a,d){
	if (confirm("Esta seguro de borrar el Tour \n" + d))
	{
	 window.location.href="index_1.php?option=pro&d=" + a;
	}
}
function confirma(a,d){
	if (confirm("Esta seguro de borrar este registro \n" + d))
	{
	 window.location.href="index_1.php?" + a;
	}
}
function confirmavu(a,b){
	if (confirm("Esta seguro de borrar el Vuelo \n" + b))
	{
	 window.location.href="index_1.php?option=vue&dv=" + a;
	}
}
function confirmar(a,b){
	if (confirm("Esta seguro de borrar el Restaurante \n" + b))
	{
	 window.location.href="index_1.php?option=rest&dr=" + a;
	}
}
function confirmau(a,b){
	if (confirm("Esta seguro de borrar el Usuario \n" + b))
	{
	 window.location.href="index_1.php?option=usu&du=" + a;
	}
}
function confirmah(a,b){
	if (confirm("Esta seguro de borrar el Hotel \n" + b))
	{
	 window.location.href="index_1.php?option=hot&dh=" + a;
	}
}
function confirmav(a,b){
var gal="";
    if(b==1){
	gal="esta imagen";
	}else if(b==2){
	gal="este video";
	}
	if (confirm("Esta seguro de eliminar "+ gal)){
	 window.location.href="index_1.php?v=" + a;
	}
}
function sig(fp){
var p_as=eval(fp.pag.value)+1;
fp.pag.value=p_as;
fp.submit();
}
function ant(fp1){
var p_as1=eval(fp1.pag.value)-1;
fp1.pag.value=p_as1;
fp1.submit();
}
function enviot(f){
 var  msj='';
 if(f.titt.value==''){ msj=msj + "Ingrese un titulo\n"; }
 if(f.tipt.value==''){ msj=msj + "Seleccione tipo"; }
 if(msj==''){
  f.env.value='Enviando';
  f.env.disabled=true;
  f.submit();
 }else{
  alert(msj);
 }
}
function acot(f){
var  msj='';
 if(f.articulo.value=='' && f.articulo1.value==''){ msj=msj + "Ingrese un nombre de articulo\n";   }
 if(f.cantidad.value<=0){ msj=msj + "Ingrese cantidad\n";   }
 if(f.precio.value<=0 && f.articulo1.value==''){ msj=msj + "Ingrese precio\n";   }
 if(msj==''){
  f.submit();
  }else{
  alert(msj);
  }
}
function vistacot(f){
 f.action='previacot.php';
 f.target='previa';
 window.open('', 'previa', 'scrollbars=yes,width=600,height=500,top=100, left=300');
 f.submit();
}
function enviacot(f){
 var  msj='';
 if(f.nomc.value==''){ msj=msj + "Ingrese Nombre Destinatario\n"; }
 if(f.emailc.value==''){ msj=msj + "Ingrese E-Mail Destinatario"; }
 if(msj==''){
  f.action='index_1.php';
  f.target='_self';
  f.envc.value='Enviando';
  f.envc.disabled=true;
  f.envc1.disabled=true;
  f.submit();
 }else{
  alert(msj);
 }
}
function arti(f,d){
 if(f.articulo1.value==''){
   f.articulo.value='';
   document.getElementById(d).style.display='block';
 }else{
   //f.articulo.value=f.articulo1.value;
   document.getElementById(d).style.display='none';
 }
}
</script>
<script language="javascript" type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
		// General options
		 mode : "exact", 
	     elements : "texton,textot,textoh,textot1,textoh1,texton1",
		//mode : "textareas",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect,bullist,numlist,hr,removeformat,visualaid,sub,sup,",
		theme_advanced_buttons2 : "undo,redo,|,link,unlink,code,|,insertdate,inserttime,preview,|,forecolor,backcolor,tablecontrols,charmap,emotions,print",
		theme_advanced_buttons3 : "",
		
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example word content CSS (should be your site CSS) this one removes paragraph margins
		content_css : "css/word.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
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
</script>
<style type="text/css">
<!--
.boton_aa {font-family: Century Gothic;
	color: #003333;
	font-weight: bold;
	width:30px; 
	height:20px;
}
.campo1 {height:20px; font-size:11px }
.texto {font:Arial; font-size:14px; color:#000 }
.boton {width:115px; height:30px; font-size:11px; font-family:Verdana; font-weight:bold }
.Estilo7 { color:#993300; font-size:12px}
.select {height:15px; font:Batang; font-size:10px}
body,td,th {
	font-family: Arial;
	font-size: 12px;
	color: #000000;
}
a:link {
	color: #FFFFFF;
	text-decoration: none;
}
a:visited {
	color: #FFFFFF;
	text-decoration: none;
}
a:hover {
	color: #CCCCCC;
	text-decoration: none;
}
#cdes {
	position:absolute;
	width:300px;
	height:115px;
	z-index:1;
}
.Estilo10 {
	font-size: 20px;
	color: #000033;
}
.lorden {color:#550000; font-family:Verdana; font-size:12px}
a.lorden:link{ color:#550000; text-decoration:none}
a.lorden:visited {color: #550000; text-decoration:none}
a.lorden.active{ background-color:#550000}
a.lorden:hover {color:#000;}
.link1 {color:#550000; font-family:Verdana; font-size:10px; font-weight:bold}
a.link1:link{ color:#550000; text-decoration:none}
a.link1:visited {color: #550000; text-decoration:none}
a.link1.active{ background-color:#550000}
a.link1:hover {color:#CCCCCC;}
.link2 {color:#000099; font-family:Verdana; font-size:12px; font-weight:bold}
a.link2:link{ color:#000099; text-decoration:none}
a.link2:visited {color: #000099; text-decoration:none}
a.link2.active{ background-color:#000099}
a.link2:hover {color:#CCCCCC}
.boton1 { background:url(../imagenes/boton1.png) bottom; }
.Estilo14 {	font-size: 10px;
	font-family: Verdana;
}
.subl {color:#000000; font-size:12px; font-weight:bold}
a.ba:link, a.ba:visited, a.ba.active{ color:#FFF; font-weight:bold; background-image:url(../imagenes/ba.png); padding:3px; -moz-border-radius:15px; -webkit-border-radius:15x; border-radius:15px; }
a.ba:hover { color:#666 }
a.ba1 {color:#FFF; font-weight:bold; background-image:url(../imagenes/ba.png); padding:3px; -moz-border-radius:15px; -webkit-border-radius:15x; border-radius:15px; }
a.link11 {background-color:#550000}
a.ba2 {color:#FFF; font-weight:bold; background-image:url(../imagenes/ba.png); padding:3px; -moz-border-radius:15px; -webkit-border-radius:15x; border-radius:15px; }
a.ba3 {color:#FFF; font-weight:bold; background-image:url(../imagenes/ba.png); padding:3px; -moz-border-radius:15px; -webkit-border-radius:15x; border-radius:15px; }
a.lorden1 {background-color:#550000}
a.link21 {background-color:#000099}

.Estilo2 {font-family: Verdana;
	color: #000066;
	font-size:10px
}
a.ba31 {color:#FFF; font-weight:bold; background-image:url(../imagenes/ba.png); padding:3px; -moz-border-radius:15px; -webkit-border-radius:15x; border-radius:15px; }
a.ba311 {color:#FFF; font-weight:bold; background-image:url(../imagenes/ba.png); padding:3px; -moz-border-radius:15px; -webkit-border-radius:15x; border-radius:15px; }
.Estilo8 {color: #000033}
.texto1 {font:Arial; font-size:14px }
a.ba32 {color:#FFF; font-weight:bold; background-image:url(../imagenes/ba.png); padding:3px; -moz-border-radius:15px; -webkit-border-radius:15x; border-radius:15px; }
a.ba33 {color:#FFF; font-weight:bold; background-image:url(../imagenes/ba.png); padding:3px; -moz-border-radius:15px; -webkit-border-radius:15x; border-radius:15px; }
a.ba3111 {color:#FFF; font-weight:bold; background-image:url(../imagenes/ba.png); padding:3px; -moz-border-radius:15px; -webkit-border-radius:15x; border-radius:15px; }
a.ba4 {color:#FFF; font-weight:bold; background-image:url(../imagenes/ba.png); padding:3px; -moz-border-radius:15px; -webkit-border-radius:15x; border-radius:15px; }
a.ba34 {color:#FFF; font-weight:bold; background-image:url(../imagenes/ba.png); padding:3px; -moz-border-radius:15px; -webkit-border-radius:15x; border-radius:15px; }
a.ba341 {color:#FFF; font-weight:bold; background-image:url(../imagenes/ba.png); padding:3px; -moz-border-radius:15px; -webkit-border-radius:15x; border-radius:15px; }
-->
</style>
</head>

<body onLoad="MM_preloadImages('../imagenes/botones/datos.png','../imagenes/botones/productos.png','../imagenes/botones/contactos.png','../imagenes/botones/ventas.png','../imagenes/botones/noticias.png','../imagenes/botones/estadisticas.png','../imagenes/botones/reservacionesh.png','../imagenes/botones/cerrarh.png','../imagenes/botones/galeriah.png')">
<table width="90%" border="0" align="center" cellpadding="5" cellspacing="0" style="border:solid 1px #000; border-radius:5px">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" width="33%">&nbsp;         </td>
        <td align="center"><a href="../" target="_blank"><img src="../imagenes/chacay.png" width="175" border="0" /></a></td>
        <td width="33%" align="right">
        <a href="close.php" style="color:#000000; font-size:14px; font-weight:bold">
          <img src="../imagenes/botones/iconos/icon_error.gif" width="19" height="15" border="0">Cerrar Sesi&oacute;n</a><br><br>
          <a href="../" target="_blank" style="color:#000000; font-size:14px; font-weight:bold">
          <img src="../imagenes/botones/iconos/noticias.png" width="19" height="15" border="0">Ver Sitio Web</a>     </td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="400" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="100%" border="0" align="right" cellpadding="2" cellspacing="0" style="background:url(../imagenes/menu_bg.jpg) top; border-bottom:solid 10px #333">
          <tr>
            <th width="80" height="30"  <?php if($op=='ini'){?>class="boton1"<?php } ?>><a href="index_1.php?option=ini">
              <div style="background:url(../imagenes/botones/iconos/menu_bg.png) no-repeat; color:#000">Inicio</div>
              </a></th>
            <th width="85" height="30"  style="border-left:solid 1px #FFF" <?php if($op=='dat'){?>class="boton1"<?php } ?>><a href="index_1.php?option=dat">
              <div style="background:url(../imagenes/botones/iconos/datos.png) no-repeat; color:#000">Datos </div>
              </a></th>
            <th width="80" style="border-left:solid 1px #FFF" <?php if($op=='pro'){?>class="boton1"<?php } ?>><a href="index_1.php?option=pro">
              <div style="background:url(../imagenes/botones/iconos/productos.png) no-repeat; color:#000">Tours</div>
              </a></th>
              <th width="80" style="border-left:solid 1px #FFF;" <?php if($op=='abo'){?>class="boton1"<?php } ?>><a href="index_1.php?option=abo">
                <div style="background:url(../imagenes/botones/iconos/cont.png) no-repeat; color:#000">About</div>
              </a></th>
              <th width="100" style="border-left:solid 1px #FFF;" <?php if($op=='our'){?>class="boton1"<?php } ?>><a href="index_1.php?option=our">
                <div style="background:url(../imagenes/botones/iconos/cont.png) no-repeat; color:#000">Our Dream</div>
              </a></th>
            <th width="95" style="border-left:solid 1px #FFF;" <?php if($op=='con'){?>class="boton1" <?php } ?>><a href="index_1.php?option=con">
              <div style="background:url(../imagenes/botones/iconos/contactos.png) no-repeat; color:#000">Contactos</div>
            </a></th>
            <th width="80"  style="border-left:solid 1px #FFF" <?php if($op=='ven'){?>class="boton1"<?php } ?>><a href="index_1.php?option=ven">
              <div style="background:url(../imagenes/botones/iconos/ventas.png) no-repeat; color:#000">Ventas</div>
              </a></th>
            <th width="117" style="border-left:solid 1px #FFF" <?php if($op=='res'){?> class="boton1"<?php } ?>><a href="index_1.php?option=res">
              <div style="background:url(../imagenes/botones/iconos/ireservacion.png) no-repeat; color:#000">Reservaciones</div>
              </a></th>
            <th width="100" style="border-left:solid 1px #FFF" <?php if($op=='tes'){?>class="boton1"<?php } ?>><a href="index_1.php?option=tes">
              <div style="background:url(../imagenes/botones/iconos/isocios.png) no-repeat; color:#000">Testimonios</div>
              </a></th>
              <th width="80" style="border-left:solid 1px #FFF;" <?php if($op=='not'){?>class="boton1" <?php } ?>><a href="index_1.php?option=not">
              <div style="background:url(../imagenes/botones/iconos/ihotel.png) no-repeat; color:#000">Noticias</div>
              </a></th>
              <th width="80" style="border-left:solid 1px #FFF;" <?php if($op=='gal'){?>class="boton1" <?php } ?>><a href="index_1.php?option=gal">
              <div style="background:url(../imagenes/botones/iconos/igaleria.png) no-repeat; color:#000">Galer&iacute;a</div>
              </a></th>
              <th width="80" style="border-left:solid 1px #FFF;" <?php if($op=='ban'){?>class="boton1" <?php } ?>><a href="index_1.php?option=ban">
              <div style="background:url(../imagenes/botones/iconos/ban.png) no-repeat; color:#000">Banner</div>
              </a></th>
              <th width="95" style="border-left:solid 1px #FFF" <?php if($op=='est'){?>class="boton1"<?php } ?>><a href="index_1.php?option=est">
              <div style="background:url(../imagenes/botones/iconos/estadisticas.png) no-repeat; color:#000">Estad&iacute;sticas</div>
              </a></th>
            </tr>
          </table></td>
        </tr>
      </table>
      <?php if($op=='con'){
	          ?>
      <table width="100%" border="0" cellpadding="2" cellspacing="2">
        <tr>
          <td><?php
			  //paginacion 
			$numn=10;
			if($_GET['pag']){
			$fin=$_GET['pag']*$numn;
			$ini=$fin-$numn;
			$vpag=$_GET['pag'];
			}else{
			$fin=$numn;
			$ini=0;
			$vpag=1;
			}//fin de if($_GET['pag']){
			
			$sqlv=mysql_query("select * from contactos order by fecha DESC LIMIT ".$ini." , ".$numn);
			$_SESSION['print']="select * from contactos order by fecha DESC LIMIT ".$ini." , ".$numn;
			$numv=mysql_num_rows($sqlv);
			   $numf=mysql_fetch_object(mysql_query("select count(*) as nf from contactos"));
											 $num_filas=$numf->nf;
			  ?>
            <br>
            <strong>Contactos</strong> : <span class="link2"><?php echo $num_filas; ?> </span>
            <a href="imprimir.php?i=u" onClick="Javascript:window.open('', 'imprimir', 'scrollbars=yes,width=750,height=400,top=100, left=200')" target="imprimir" class="ba3" title="Imprimir Contactos"><strong> <img src="../imagenes/printer.gif" width="12" height="12" border="0">Imprimir </strong></a>
            <br>
            <br>
            <?php if($numv>0){ ?>
            <div>
              <table width="1000" border="0" cellpadding="2" cellspacing="1">
                <tr bgcolor="#CCCCCC">
                  <th><div align="center">N&ordm;</div></th>
                  <th>Nombre</th>
                  <th><div align="center">Ciudad</div></th>
                  <th><div align="center">Tel&eacute;fono</div></th>
                  <th><div align="center">E-mail</div></th>
                  <th><div align="center">Requerimiento</div></th>
                  <th><div align="center">Fecha</div></th>
                </tr>
                <?php 
				  $i=$ini;
				  while($row=mysql_fetch_object($sqlv)){
  $i=$i+1;
  ?>
                <tr class="texto" style="background-color:#F5F5F5" onMouseOver="this.style.backgroundColor='#EBFCE2'" onMouseOut="this.style.backgroundColor='#F5F5F5'">
                  <td><div align="center"><?php echo $i; ?></div></td>
                  <td><div align="center"><?php echo $row->nombre; ?></div></td>
                  <td><div align="center"><?php echo $row->ciudad; ?></div></td>
                  <td><div align="center"><?php echo $row->telefono; ?></div></td>
                  <td><div align="center"><?php echo $row->email; ?></div></td>
                  <td><div align="center"><?php echo $row->asunto; ?></div></td>
                  <td><div align="center">
                    <?php 
		  $fecha_1=explode(" ",$row->fecha);
		  $fecha=explode("-",$fecha_1[0]);
		  echo $mes[$fecha[1]-1]." ".$fecha[2].", ".$fecha[0]; ?>
                  </div></td>
                </tr>
                <?php }//fin de while?>
              </table>
              <table border="0" cellpadding="0" cellspacing="0" style="background:url(images/fcde1.jpg) repeat-x top">
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="center" > <span class="Est6">
                    <?php 

											 if($vpag<=7){//control para desplegar solo $numn catalogos 

											 $j=0;//inicio

											 $k=7;//final

											 }else{

											 $j=$vpag-7;//inicio

											 $k=$vpag;//final

											 }

											 $sp=$vpag+1;//siguiente pagina

											 $ap=$vpag-1;//pagina anterior

											 //desplegar numeros si hay mas numeros de pagina
											

											 if($num_filas>$numn){

											 $i=$num_filas/$numn;

											 

											 ?>
                    <?php

											 echo 'P&Aacute;GINAS: ';

											 if($ap>0){//control para mostrar o ocultar pagina anterior

										  ?>
                    </span><a href="index_1.php?pag=1" title="Primera p&aacute;gina" class="link1">&lt;&lt; </a> | <a href="index_1.php?pag=<?php echo $ap; ?>" class="link1">Anterior</a>
                    <?php

										    }//fin de if($ap>1)

											 while($j<$i and $j<$k){

											 $j++;

											 if($vpag==$j){//ver en que catalogo estamos

											 

											 ?>
                    | <strong><?php echo $j; ?></strong>
                    <?php

										  }else{

										  ?>
                    | <a href="index_1.php?pag=<?php echo $j; ?>" class="link1"><?php echo $j; ?></a>
                    <?php

										  }//fin de if($vpag=$j)

										   }//fin While

										   if($sp<$i+1){//control para mostrar o ocultar siguiente pagina

										  ?>
                    | <a href="index_1.php?pag=<?php echo $sp; ?>" class="link1">Siguiente</a> | <a href="index_1.php?pag=<?php echo ceil($i); ?>" title="Ultima p&aacute;gina" class="link1">&gt;&gt;</a>
                    <?php

										    }//fin de if($sp<=$j)
											}

											?>
                    <br />
                  </div></td>
                  <td><div align="right"></div></td>
                </tr>
              </table>
            </div>
            <?php }//fin de if($numv<0)
			  
			  ?></td>
        </tr>
        </table>
      <?php }elseif($op=='dat'){//datos contacto ?>
  <table width="100%" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td>
        <?php if($_GET['in']==1){ ?>
        <form action="index_1.php" method="post" name="fcon" id="fcon">
          <table border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td><img src="../imagenes/1.png" width="20" height="20"></td>
              <td bgcolor="#F1EADB">&nbsp;</td>
              <td><img src="../imagenes/2.png" width="20" height="20"></td>
              </tr>
            <tr>
              <td bgcolor="#F1EADB">&nbsp;</td>
              <td bgcolor="#F1EADB"><table border="0" align="center" cellpadding="1" cellspacing="1">
                <tr>
                  <td colspan="2" class="link2"><div align="center">Actualizaci&oacute;n de Datos <?php echo $du->organizacion; ?></div></td>
                  </tr>
                <tr>
                  <td><div align="right"><strong>Nombre Administrador:</strong></div></td>
                  <td><label>
                    <input name="nom" type="text" id="nom" value="<?php echo $du->nombre; ?>" size="50">
                    </label></td>
                  </tr>
                <tr>
                  <td><div align="right"><strong>Apellido Administrador:</strong></div></td>
                  <td><label>
                    <input name="ape" type="text" id="ape" value="<?php echo $du->apellido; ?>" size="50">
                    </label></td>
                  </tr>
                <tr>
                  <td><div align="right"><strong>Direcci&oacute;n:</strong></div></td>
                  <td><label>
                    <input name="dir" type="text" id="dir" value="<?php echo $du->direccion; ?>" size="50">
                    </label></td>
                  </tr>
                <tr>
                  <td><div align="right"><strong>Ciudad:</strong></div></td>
                  <td><input name="ciu" type="text" id="ciu" value="<?php echo $du->ciudad; ?>"></td>
                  </tr>
                <tr>
                  <td><div align="right"><strong>Pa&iacute;s:</strong></div></td>
                  <td><input name="pai" type="text" id="pai" value="<?php echo $du->pais; ?>"></td>
                  </tr>
                <tr>
                  <td><div align="right"><strong>Tel&eacute;fono:</strong></div></td>
                  <td><input name="tel" type="text" id="tel" value="<?php echo $du->telefono; ?>"></td>
                  </tr>
                <tr>
                  <td><div align="right"><strong>Celular:</strong></div></td>
                  <td><input name="cel" type="text" id="cel" value="<?php echo $du->celular; ?>"></td>
                  </tr>
                <tr>
                  <td><div align="right"><strong>E-Mail:</strong></div></td>
                  <td><input name="ema" type="text" id="ema" value="<?php echo $du->email; ?>" size="50"></td>
                  </tr>
                <tr>
                  <td><div align="right"></div></td>
                  <td>&nbsp;</td>
                  </tr>
                <tr>
                  <td><div align="right"><strong>Usuario:</strong></div></td>
                  <td><input name="usu" type="text" id="usu" value="<?php echo $du->usuario; ?>" size="50" disabled></td>
                  </tr>
                <tr>
                  <td><div align="right"><strong>Clave :</strong></div></td>
                  <td><input name="cla" type="text" id="cla" value="<?php echo $du->clave; ?>" size="50" disabled></td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  </tr>
                <tr>
                  <td colspan="2"><label>
                    <div align="center">
                      <input type="submit" name="Submit" value="Guardar" style="width:100px; height:30px">
                      <input name="fadmin" type="hidden" id="fadmin" value="1">
                      <label>
                        <input type="button" name="Submit2" value="Cancelar" style="width:100px; height:30px" onClick="window.location.href='index_1.php'">
                        </label>
                      </div>
                    </label></td>
                  </tr>
                </table></td>
              <td bgcolor="#F1EADB">&nbsp;</td>
              </tr>
            <tr>
              <td><img src="../imagenes/3.png" width="20" height="20"></td>
              <td bgcolor="#F1EADB">&nbsp;</td>
              <td><img src="../imagenes/4.png" width="20" height="20"></td>
              </tr>
            </table>
          </form>
        <?php }else{ 
	        
	?><br><table border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td valign="top"><table border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="../imagenes/1.png" width="20" height="20"></td>
        <td bgcolor="#F1EADB">&nbsp;</td>
        <td><img src="../imagenes/2.png" width="20" height="20"></td>
      </tr>
      <tr>
        <td bgcolor="#F1EADB">&nbsp;</td>
        <td bgcolor="#F1EADB"><table border="0" align="center" cellpadding="1" cellspacing="1">
          <tr>
            <td colspan="2" class="link2"><div align="center">Datos Empresa <?php echo $du->organizacion; ?></div></td>
          </tr>
          <tr>
            <td><div align="right"><strong>Nombre Administrador:</strong></div></td>
            <td><?php echo $du->nombre; ?></td>
          </tr>
          <tr>
            <td><div align="right"><strong>Apellido Administrador:</strong></div></td>
            <td><?php echo $du->apellido; ?></td>
          </tr>
          <tr>
            <td><div align="right"><strong>Direcci&oacute;n:</strong></div></td>
            <td><?php echo $du->direccion; ?></td>
          </tr>
          <tr>
            <td><div align="right"><strong>Ciudad:</strong></div></td>
            <td><?php echo $du->ciudad; ?></td>
          </tr>
          <tr>
            <td><div align="right"><strong>Pa&iacute;s:</strong></div></td>
            <td><?php echo $du->pais; ?></td>
          </tr>
          <tr>
            <td><div align="right"><strong>Tel&eacute;fono:</strong></div></td>
            <td><?php echo $du->telefono; ?></td>
          </tr>
          <tr>
            <td><div align="right"><strong>Celular:</strong></div></td>
            <td><?php echo $du->celular; ?></td>
          </tr>
          <tr>
            <td><div align="right"><strong>E-Mail:</strong></div></td>
            <td><?php echo $du->email; ?></td>
          </tr>
          <tr>
            <td><div align="right"></div></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"><div align="center"><a href="index_1.php?in=1" class="ba4"> <img src="../imagenes/visto.png" width="12" height="12" border="0"><strong>Actualizar Datos </strong></a></div></td>
          </tr>
        </table></td>
        <td bgcolor="#F1EADB">&nbsp;</td>
      </tr>
      <tr>
        <td><img src="../imagenes/3.png" width="20" height="20"></td>
        <td bgcolor="#F1EADB">&nbsp;</td>
        <td><img src="../imagenes/4.png" width="20" height="20"></td>
      </tr>
    </table>
    <br></td>
    <td valign="top">&nbsp;</td>
  </tr>
</table>
        <br><br>
        <?php }//fin de if($_GET['ac']){ ?>
        </td>
      </tr>
  </table>
  <?php }elseif($op=='est'){//opcion estadistica
?>
  <table width="100%" border="0" cellpadding="2" cellspacing="2">
    <tr>
      <td><br>
        <a href="datos.php?i=u" onClick="Javascript:window.open('', 'imprimir', 'scrollbars=yes,width=750,height=400,top=100, left=200')" target="imprimir" class="ba3" title="Imprimir Contactos"><strong> <img src="../imagenes/printer.gif" width="12" height="12" border="0">Imprimir </strong></a>
        <table width="200" border="0" align="center" cellpadding="0" cellspacing="1" style="margin-left:100px; margin-bottom:10px">
          <tr>
            <td colspan="2" style="border-bottom:solid 1px #000000"><strong>Visitas</strong></td>
            </tr>
          <tr>
            <td style="border-bottom:solid 1px #000000">Hoy</td>
            <td style="border-bottom:solid 1px #000000"><div align="left"><strong><img src="../Contador/imagenes/userinvit.gif" border="0" /><strong>
              <?php $rowh=mysql_fetch_object(mysql_query("select * from visitast"));
		  echo $rowh->hoy + $num_vb;
		  ?>
              </strong></div></td>
            </tr>
          <tr>
            <td style="border-bottom:solid 1px #000000">Totales</td>
            <td style="border-bottom:solid 1px #000000"><div align="left"><strong><img src="../Contador/imagenes/usertotal.gif" border="0" /><strong>
              <?php 
		  echo $rowh->cont;
		  ?>
              </strong></div></td>
            </tr>
          </table>
        <table border="0" align="center" cellpadding="0" cellspacing="1" style="margin-left:100px; margin-bottom:10px">
          <tr>
            <td colspan="3" style="border-bottom:solid 1px #000000"><strong>Productos Mas Visitados </strong></td>
            </tr>
          <?php
								  $sqlp=mysql_query("select  nombrep,visto from productos where visto>0 order by visto DESC limit 0,20");
			$sqlpst=mysql_fetch_object(mysql_query("select sum(visto) as vt from productos where visto>0"));
			$sumav1=$sqlpst->vt;
			$p=0;
			while($rowp=mysql_fetch_object($sqlp)){
			 if($p==0){
			  $sumav=$rowp->visto;
			 }
			 $p=$p+1;
			 //calculo de porcentaje
			  $por=round(($rowp->visto*100)/$sumav1,2);
			  $bar=ceil(($rowp->visto*200)/$sumav);
			?>
          <tr>
            <td style="border-bottom:solid 1px #000000"><strong><?php echo $p ?>&deg;</strong></td>
            <td style="border-bottom:solid 1px #000000; font-family:Verdana; font-size:11px"><div align="left"><?php echo $rowp->nombrep ?></div></td>
            <td style="border-bottom:solid 1px #000000"><table border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td valign="middle"><div align="right"><img src="../imagenes/barra.png" width="<?php echo $bar ?>" height="15" /></div></td>
                <td><span class="Estilo2"><?php echo $por ?>%</span></td>
                </tr>
              </table></td>
            </tr>
          <?php } ?>
          </table>
        <table border="0" align="center" cellpadding="0" cellspacing="1" style="margin-left:100px">
          <tr>
            <td colspan="4" style="border-bottom:solid 1px #000000"><strong>Origen de Visitantes </strong></td>
            </tr>
          <?php
			$sqlp=mysql_query("select  * from paises where hit>0 order by hit DESC limit 0,20");
			$sqlpst=mysql_fetch_object(mysql_query("select sum(hit) as vt from paises where hit>0"));
			$sumav1=$sqlpst->vt;
			$p=0;
			while($rowp=mysql_fetch_object($sqlp)){
			 if($p==0){
			  $sumav=$rowp->hit;
			 }
			 $p=$p+1;
			 //calculo de porcentaje
			  $por=round(($rowp->hit*100)/$sumav1,2);
			  $bar=ceil(($rowp->hit*200)/$sumav);
			?>
          <tr>
            <td style="border-bottom:solid 1px #000000"><strong><?php echo $p ?>&deg;</strong></td>
            <td style="border-bottom:solid 1px #000000"><img src="../imagenes/flags/<?php 
$search  = array(' ', 'Ñ');
$replace = array('', 'N');
									  echo str_replace($search,$replace,$rowp->nombre); ?>.png" /></td>
            <td style="border-bottom:solid 1px #000000; font-family:Verdana; font-size:11px"><div align="left"><?php echo $rowp->nombre ?></div></td>
            <td style="border-bottom:solid 1px #000000"><table border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td valign="middle"><div align="right"><img src="../imagenes/barra.png" width="<?php echo $bar ?>" height="15" /></div></td>
                <td><span class="Estilo2"><?php echo $por ?>%</span></td>
                </tr>
              </table></td>
            </tr>
          <?php } ?>
          </table>
        </td>
      </tr>
  </table>
  <?php }elseif($op=='gal'){ ?>
  <table width="100%" border="0" cellpadding="2" cellspacing="2">
    <tr>
      <td><?php
	$sqlc=mysql_query("select * from categorias");
	while($rc=mysql_fetch_object($sqlc)){
		$c[$rc->cat]=$rc->nom;
	}
			  //paginacion 
			$numn=20;
			if($_GET['pag']){
			$fin=$_GET['pag']*$numn;
			$ini=$fin-$numn;
			$vpag=$_GET['pag'];
			}else{
			$fin=$numn;
			$ini=0;
			$vpag=1;
			}//fin de if($_GET['pag']){
			
			$sqlv=mysql_query("select * from galeria where tipo in (1,3) order by fecha DESC LIMIT ".$ini." , ".$numn);
			$_SESSION['print']="select * from galeria where tipo in (1,3) order by fecha DESC LIMIT ".$ini." , ".$numn;
			$numv=mysql_num_rows($sqlv);
			   $numf=mysql_fetch_object(mysql_query("select count(*) as nf from galeria where tipo in (1,3)"));
											 $num_filas=$numf->nf;
											
			  ?>
        
        <form action="index_1.php" method="post" name="fpg" id="fpg"><br>
          <table border="0" cellpadding="1" cellspacing="1">
            <tr><td nowrap>
              <?php if($num_filas<100){ ?>
              <a href="igaleria.php" onClick="Javascript:window.open('', 'igaleria', 'scrollbars=yes,width=750,height=300,top=100, left=200')" target="igaleria" class="ba3" title="Ingresar a Galer&iacute;a"><strong> <img src="../imagenes/pa.gif" width="12" height="12" border="0">Ingresar Nuevo </strong></a>
              <?php }//fin de if($num_filas<=){ ?>
              </td>
              <td>&nbsp;</td>
              <td>
                <strong>Imagenes Ingresados: </strong><?php echo $num_filas; ?></td></tr>
            </table>
          </form>
        <?php if($numv>0){ ?>
        <div id="gallery">
          <table width="500" border="0" cellpadding="2" cellspacing="1">
            <tr bgcolor="#666666">
              <th bgcolor="#CCCCCC"><div align="center">N&ordm;</div></th>
              <th bgcolor="#CCCCCC">Tipo</th>
              <th bgcolor="#CCCCCC">Item</th>
              <th bgcolor="#CCCCCC"><div align="center">Fecha</div></th>
              <th bgcolor="#CCCCCC">Borrar</th>
              </tr>
            <?php 
				  $i=$ini;
				  while($row=mysql_fetch_object($sqlv)){
  $i=$i+1;
  ?>
            <tr class="texto" style="background-color:#F5F5F5" onMouseOver="this.style.backgroundColor='#CCCCCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'">
              <td><div align="center"><strong><?php echo $i; ?></strong></div></td>
              <td><div align="center"><?php if($row->tipo==1){
			  echo 'Imagen';
			  }elseif($row->tipo==3){
				  echo 'Video';
			  }?></div></td>
              <td><div align="center">
                <?php 
			  if($row->tipo==1){
			  echo '<a class="group" rel="group1" href="../imagenes/g/'.$row->imagen.'"><img src="../imagenes/p/'.$row->imagen.'" /></a>';
			  }elseif($row->tipo==3){
				  echo '<object width="150" height="150"><param name="movie" value="'.str_replace("watch?v=","v/",$row->imagen).'"></param><param name="allowFullScreen" value="true"></param><embed src="'.str_replace("watch?v=","v/",$row->imagen).'" type="application/x-shockwave-flash" allowfullscreen="true" width="150" height="150"></embed></object>';
			  }
			  ?>
                </div>                </td>
              <td><div align="center">
                <?php 
		  $fecha_1=explode(" ",$row->fecha);
		  $fecha=explode("-",$fecha_1[0]);
		  echo $mes[$fecha[1]-1]." ".$fecha[2].", ".$fecha[0]; ?>
                </div></td>
              <td><div align="center"><a href="Javascript:confirmav('<?php echo md5($row->idg)."&dg=".$row->idg."&im=".$row->imagen."&tip=".$row->tipo; ?>','<?php echo $row->tipo ?>')" class="link1"><img src="../imagenes/botones/borrar.png" alt="Borrar" width="25" height="25" border="0" title="Borrar"></a></div>                </td>
              </tr>
            <?php }//fin de while?>
            </table>
          <table border="0" cellpadding="0" cellspacing="0" style="background:url(images/fcde1.jpg) repeat-x top">
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              </tr>
            <tr>
              <td><div align="center" > <span class="Est6">
                <?php 

											 if($vpag<=7){//control para desplegar solo $numn catalogos 

											 $j=0;//inicio

											 $k=7;//final

											 }else{

											 $j=$vpag-7;//inicio

											 $k=$vpag;//final

											 }

											 $sp=$vpag+1;//siguiente pagina

											 $ap=$vpag-1;//pagina anterior

											 //desplegar numeros si hay mas numeros de pagina
											

											 if($num_filas>$numn){

											 $i=$num_filas/$numn;

											 

											 ?>
                <?php

											 echo 'P&Aacute;GINAS: ';

											 if($ap>0){//control para mostrar o ocultar pagina anterior

										  ?>
                </span><a href="index_1.php?pag=1" title="Primera p&aacute;gina" class="link1">&lt;&lt; </a> | <a href="index_1.php?pag=<?php echo $ap; ?>" class="link1">Anterior</a>
                <?php

										    }//fin de if($ap>1)

											 while($j<$i and $j<$k){

											 $j++;

											 if($vpag==$j){//ver en que catalogo estamos

											 

											 ?>
                | <strong><?php echo $j; ?> </strong>
                <?php

										  }else{

										  ?>
                | <a href="index_1.php?pag=<?php echo $j; ?>" class="link1"><?php echo $j; ?></a>
                <?php

										  }//fin de if($vpag=$j)

										   }//fin While

										   if($sp<$i+1){//control para mostrar o ocultar siguiente pagina

										  ?>
                | <a href="index_1.php?pag=<?php echo $sp; ?>"  class="link1">Siguiente</a> | <a href="index_1.php?pag=<?php echo ceil($i); ?>" title="Ultima p&aacute;gina" class="link1">&gt;&gt;</a>
                <?php

										    }//fin de if($sp<=$j)
											}

											?>
                <br />
                </div></td>
              <td><div align="right"></div></td>
              </tr>
            </table>
          </div>
        <?php }//fin de if($numv<0)
			  
			  ?></td>
      </tr>
  </table>
  <?php }elseif($op=='not'){ ?>
  <table width="100%" border="0" cellpadding="2" cellspacing="2">
    <tr>
      <td><?php
			  //paginacion 
			$numn=20;
			if($_GET['pag']){
			$fin=$_GET['pag']*$numn;
			$ini=$fin-$numn;
			$vpag=$_GET['pag'];
			}else{
			$fin=$numn;
			$ini=0;
			$vpag=1;
			}//fin de if($_GET['pag']){
			
			$sqlv=mysql_query("select * from noticias order by fecha DESC LIMIT ".$ini." , ".$numn);
			$_SESSION['print']="select * from noticias order by fecha DESC LIMIT ".$ini." , ".$numn;
			$numv=mysql_num_rows($sqlv);
			   $numf=mysql_fetch_object(mysql_query("select count(*) as nf from noticias"));
											 $num_filas=$numf->nf;											
			  ?>
        <br>
        <table width="400" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td>
              <a href="inoticia.php" onClick="Javascript:window.open('', 'inoticia', 'scrollbars=yes,width=750,height=500,top=100, left=200')" target="inoticia" class="ba" title="Ingresar a Galer&iacute;a"><strong> <img src="../imagenes/pa.gif" width="12" height="12" border="0">Ingresar Nuevo </strong></a>
              </td>
            <td><strong>Noticias Ingresadas: </strong> <span class="link2"><?php echo $num_filas; ?></span></td>
            </tr>
          </table>
        <br>
        <?php if($numv>0){ ?>
        <div id="gallery">
          <table width="500" border="0" cellpadding="2" cellspacing="1">
            <tr bgcolor="#666666">
              <th bgcolor="#CCCCCC"><div align="center">N&ordm;</div></th>
              <th bgcolor="#CCCCCC">T&iacute;tulo</th>
              <th bgcolor="#CCCCCC">Imagen</th>
              <th bgcolor="#CCCCCC"><div align="center">Fecha</div></th>
              <th bgcolor="#CCCCCC">Borrar</th>
              <th bgcolor="#CCCCCC">Actualizar</th>
              </tr>
            <?php 
				  $i=$ini;
				  while($row=mysql_fetch_object($sqlv)){
  $i=$i+1;
  ?>
            <tr class="texto" style="background-color:#F5F5F5" onMouseOver="this.style.backgroundColor='#CCCCCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'">
              <td><div align="center"><strong><?php echo $i; ?></strong></div></td>
              <td><a href="../news.php?n=<?php echo $row->idn; ?>"  target="_blank" class="lorden" title="Ver informaci&oacute;n de Noticia">
                <div align="center"><?php echo $row->tit; ?></div>
                </a></td>
              <td><div align="center">
                <img src="../imagenes/p/<?php echo $row->f1; ?>" width="100" height="100" />
                
                </div>                </td>
              <td><div align="center">
                <?php 
		  $fecha_1=explode(" ",$row->fecha);
		  $fecha=explode("-",$fecha_1[0]);
		  echo $mes[$fecha[1]-1]." ".$fecha[2].", ".$fecha[0]; ?>
                </div></td>
              <td><div align="center"><a href='Javascript:confirma("<?php echo "id=".md5($row->idn)."&dn=".$row->idn."&im=".$row->f1; ?>","<?php echo str_replace("'","",$row->tit) ?>","","")' class="link1"><img src="../imagenes/botones/borrar.png" alt="Borrar" width="25" height="25" border="0" title="Borrar"></a></div></td>
              <td><div align="center"><a href="anoticia.php?n=<?php echo $row->idn; ?>" onClick="Javascript:window.open('', 'anoticia', 'scrollbars=yes,width=750,height=500,top=100, left=200')" target="anoticia" class="link1"><img src="../imagenes/botones/actualizar.png" alt="Actualizar" width="25" height="25" border="0" title="Actualizar"></a></div>                </td>
              </tr>
            <?php }//fin de while?>
            </table>
          <table border="0" cellpadding="0" cellspacing="0" style="background:url(images/fcde1.jpg) repeat-x top">
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              </tr>
            <tr>
              <td><div align="center" > <span class="Est6">
                <?php 
											 if($vpag<=7){//control para desplegar solo $numn catalogos 
											 $j=0;//inicio
											 $k=7;//final
											 }else{
											 $j=$vpag-7;//inicio
											 $k=$vpag;//final
											 }
											 $sp=$vpag+1;//siguiente pagina
											 $ap=$vpag-1;//pagina anterior
											 //desplegar numeros si hay mas numeros de pagina
											 if($num_filas>$numn){
											 $i=$num_filas/$numn;
											 ?>
                <?php
											 echo 'P&Aacute;GINAS: ';
											 if($ap>0){//control para mostrar o ocultar pagina anterior
										  ?>
                </span><a href="index_1.php?pag=1" title="Primera p&aacute;gina" class="link1">&lt;&lt; </a> | <a href="index_1.php?pag=<?php echo $ap; ?>" class="link1">Anterior</a>
                <?php
										    }//fin de if($ap>1)
											 while($j<$i and $j<$k){
											 $j++;
											 if($vpag==$j){//ver en que catalogo estamos
											 ?>
                | <strong><?php echo $j; ?> </strong>
                <?php
										  }else{
										  ?>
                | <a href="index_1.php?pag=<?php echo $j; ?>" class="link1"><?php echo $j; ?></a>
                <?php
										  }//fin de if($vpag=$j)
										   }//fin While
										   if($sp<$i+1){//control para mostrar o ocultar siguiente pagina
										  ?>
                | <a href="index_1.php?pag=<?php echo $sp; ?>" class="link1">Siguiente</a> | <a href="index_1.php?pag=<?php echo ceil($i); ?>" title="Ultima p&aacute;gina" class="link1">&gt;&gt;</a>
                <?php
										    }//fin de if($sp<=$j)
											}
											?>
                <br />
                </div></td>
              <td><div align="right"></div></td>
              </tr>
            </table>
          </div>
        <?php }//fin de if($numv<0)
			  
			  ?></td>
      </tr>
  </table>
  <?php }elseif($op=='ini'){ ?>
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><table border="0" align="center" cellpadding="1" cellspacing="2" style="margin-top:10px">
        <tr>
          <td><div class="admin"><a href="index_1.php?option=dat"><img src="../imagenes/botones/iconos/datos.png" width="16" height="16">DATOS</a></div></td>
          <td><div class="admin"><a href="index_1.php?option=pro"><img src="../imagenes/botones/iconos/itours.png" width="17" height="17">TOURS</a></div></a></div></td>
          <td><div class="admin"><a href="index_1.php?option=con"><img src="../imagenes/botones/iconos/contactos.png" width="16" height="16">CONTACTOS</a></div></td>
          <td><a href="index_1.php?option=res" onMouseOut="MM_swapImgRestore()" ></a></td>
          </tr>
        <tr>
          <td><div class="admin"><a href="index_1.php?option=est"><img src="../imagenes/botones/iconos/estadisticas.png" width="16" height="16">ESTAD&Iacute;STICA</a></div></td>
          <td><div class="admin"><a href="index_1.php?option=ven"><img src="../imagenes/botones/iconos/ventas.png" width="16" height="16">VENTAS</a></div></td>
          <td><div class="admin"><a href="index_1.php?option=res"><img src="../imagenes/botones/iconos/ireservacion.png" width="16" height="15">RESERVACIONES</a></div></td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td align="center"><div class="admin"><a href="index_1.php?option=not"><img src="../imagenes/botones/iconos/ihotel.png" width="16" height="16">NOTICIAS</a></div></td>
          <td align="center"><div class="admin"><a href="index_1.php?option=gal"><img src="../imagenes/botones/iconos/igaleria.png" width="17" height="17">GALERÍA</a></div></td>
          <td align="center"><div class="admin"><a href="index_1.php?option=tes"><img src="../imagenes/botones/iconos/isocios.png" width="17" height="17">TESTIMONIOS</a></div></td>
          <td align="center"><a href="index_1.php?option=gal" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Imagen42','','../imagenes/botones/galeriah.png',1)"></a></td>
          </tr>
        <tr>
          <td align="center"><div class="admin"><a href="index_1.php?option=abo"><img src="../imagenes/botones/iconos/cont.png" width="16" height="16">ABOUT</a></div></td>
          <td align="center"><div class="admin"><a href="index_1.php?option=our"><img src="../imagenes/botones/iconos/cont.png" width="16" height="16">OUR DREAM</a></div></td>
          <td align="center"><div class="admin"><a href="index_1.php?option=ban"><img src="../imagenes/botones/iconos/ban.png" width="16" height="16">BANNER</a></div></td>
          <td align="center">&nbsp;</td>
        </tr>
        </table></td>
      </tr>
  </table>
  <?php }elseif($op=='ven'){//fin de if($op=='va'){
	  $fechai=date('Y-m');
$fechai=$fechai."-01";
$fechah=date('Y-m-d');
if($_POST['dd']){
$vdd=$_POST['dd'];
$vdm=$_POST['dm'];
$vda=$_POST['da'];
$vhd=$_POST['hd'];
$vhm=$_POST['hm'];
$vha=$_POST['ha'];
$fechai=$vda.'-'.$vdm.'-'.$vdd;
$fechah=$vha.'-'.$vhm.'-'.$vhd;
}else{
$fechai_1=explode("-",$fechai);
$fechah_1=explode("-",$fechah);
$vdd=$fechai_1[2];
$vdm=$fechai_1[1];
$vda=$fechai_1[0];
$vhd=$fechah_1[2];
$vhm=$fechah_1[1];
$vha=$fechah_1[0];
}//fin de if($_POST['dd']){
$vor=$_POST['orden'];
$est=$_POST['est'];
$usu=$_POST['usu'];
if(isset($vor) and $vor>0){
$sqlrs=mysql_query("select * from facturas where numfactura='$vor'");
$sqlvt=mysql_fetch_object(mysql_query("select sum(total) as tv from facturas where numfactura='$vor'"));
$_SESSION['sql_his']="select * from facturas where numfactura='$vor'";
$_SESSION['sql_hist']=$sqlvt->tv;
$_SESSION['sql_hisf']="";
}else{
	if($est=='Pagado' or $est=='No Pagado'){
	$adisql.=" and estado='".$est."'";
    }
	if($usu>0){
	$adisql.=" and idus='".$usu."'";
    }
$sqlrs=mysql_query("select * from facturas where date(fecha)>=date('$fechai') and date(fecha)<=date('$fechah')".$adisql);
$sqlvt=mysql_fetch_object(mysql_query("select sum(total) as tv from facturas where date(fecha)>=date('$fechai') and date(fecha)<=date('$fechah')".$adisql));
$_SESSION['sql_his']="select * from facturas where date(fecha)>=date('$fechai') and date(fecha)<=date('$fechah')".$adisql;
$_SESSION['sql_hist']=$sqlvt->tv;
$_SESSION['sql_hisf']=$vdd."/".$vdm."/".$vda." - ".$vhd."/".$vhm."/".$vha;
}
//$numrs=mysql_num_rows($sqlrs);
$num_filas=mysql_num_rows($sqlrs);
	  ?>
      <br>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><table border="0" align="center" cellpadding="1" cellspacing="0">
            <tr>
              <td><form action="index_1.php" method="post" name="fbdoc" id="fbdoc">
                <table border="0" align="center" style="border:solid 1px #000000; border-radius:10px">
                  <tr>
                    <td colspan="2"><div align="center"><strong>Ver registros </strong></div></td>
                    </tr>
                  <tr>
                    <td><div align="right"><strong>Fecha:</strong><br>
                      <span class="campo1">(dd/mm/aa)</span></div></td>
                    <td><table width="100%" border="0" cellpadding="0" cellspacing="2" bgcolor="#FFFFFF">
                      <tr>
                        <td><?php $fecha=date('Y-m-d');
		  if($fechai==''){ 
		  $fechai=$fecha;
		  $fecha=explode('-',$fecha);
		  }else{
		  $fecha=explode('-',$fechai);
		  }
		  ?>
                          <span class="Estilo7">Desde:</span>
                          <select name="dd" class="select" id="dd">
                            <?php 
			               for($i=1;$i<=31;$i++){
				            $j= sprintf("%02d", $i);
			              ?>
                            <option value="<?php echo $j; ?>"<?php if($fecha[2]==$j){ ?> selected="selected"<?php }?>><?php echo $j; ?></option>
                            <?php } ?>
                            </select>
                          / <span style="border-left:solid 1px #CCCCCC">
                            <select name="dm" class="select" id="dm">
                              <?php 
			              for($i=1;$i<=12;$i++){
				          $j= sprintf("%02d", $i);
			            ?>
                              <option value="<?php echo $j; ?>"<?php if($fecha[1]==$j){ ?> selected="selected"<?php }?>><?php echo $j; ?></option>
                              <?php } ?>
                              </select>
                            </span> / <span style="border-left:solid 1px #CCCCCC">
                              <select name="da" class="select" id="da">
                                <?php 
		for($fa=2012;$fa<=date('Y');$fa++){
		  ?>
                                <option value="<?php echo $fa ?>" <?php if($fecha[0]==$fa){ echo 'selected';}?>><?php echo $fa ?></option>
                                <?php }?>
                                </select>
                              </span></td>
                        </tr>
                      <tr>
                        <td><?php $fecha=date('Y-m-d');
		  if(!$fechah){ 
		  $fechah=$fecha;
		  $fecha=explode('-',$fecha);
		  }else{
		  $fecha=explode('-',$fechah);
		  }
		  ?>
                          <span class="Estilo7">Hasta:</span>
                          <select name="hd" class="select" id="hd">
                            <?php 
			               for($i=1;$i<=31;$i++){
				            $j= sprintf("%02d", $i);
			              ?>
                            <option value="<?php echo $j; ?>"<?php if($fecha[2]==$j){ ?> selected="selected"<?php }?>><?php echo $j; ?></option>
                            <?php } ?>
                            </select>
                          / <span style="border-left:solid 1px #CCCCCC">
                            <select name="hm" class="select" id="hm">
                              <?php 
			              for($i=1;$i<=12;$i++){
				          $j= sprintf("%02d", $i);
			            ?>
                              <option value="<?php echo $j; ?>"<?php if($fecha[1]==$j){ ?> selected="selected"<?php }?>><?php echo $j; ?></option>
                              <?php } ?>
                              </select>
                            </span> / <span style="border-left:solid 1px #CCCCCC">
                              <select name="ha" class="select" id="ha">
                                <?php 
		for($fa=2012;$fa<=date('Y');$fa++){
		  ?>
                                <option value="<?php echo $fa ?>" <?php if($fecha[0]==$fa){ echo 'selected';}?>><?php echo $fa ?></option>
                                <?php }?>
                                </select>
                              </span></td>
                        </tr>
                      </table></td>
                    </tr>
                  <tr>
                    <td align="right"><strong>Estado:</strong></td>
                    <td><label>
                      <select name="est" id="est" class="select">
                        <option value="0">Todos</option>
                        <option value="Pagado" <?php if($est=='Pagado'){ ?>selected<?php }?>>Pagado</option>
                        <option value="No Pagado" <?php if($est=='No Pagado'){ ?>selected<?php }?>>No Pagado</option>
                        </select>
                      </label></td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><label>
                      <input name="Submit6" type="submit" class="boton" value="BUSCAR">
                      </label></td>
                    </tr>
                  </table>
                </form></td>
              <td><form action="index_1.php" method="post" name="fbo" id="fbo">
                <table border="0" align="center" style="border:solid 1px #000000; border-radius:10px">
                  <tr>
                    <td colspan="2"><div align="center"><strong>Ver registro</strong></div></td>
                  </tr>
                  <tr>
                    <td><div align="right"><strong>No.</strong><span class="campo1"></span></div></td>
                    <td><label>
                      <input name="orden2" type="text" id="orden2" size="5" maxlength="10">
                    </label></td>
                  </tr>
                  <tr>
                    <td colspan="2"><label>
                      <input name="Submit3" type="button" class="boton" value="BUSCAR" onClick="buscao(fbo)">
                    </label></td>
                  </tr>
                </table>
              </form></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4"><br><table border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td><table width="100%" border="0" cellpadding="1" cellspacing="1">
                      <tr>
                        <td><strong>Ventas:</strong> <span class="link2"><?php echo $num_filas; ?></span></td>
                        <td>&nbsp;</td>
                        <td><strong>Valor: </strong><span class="link2">$<?php echo sprintf("%01.2f",$sqlvt->tv); ?></span></td>
                        <td><?php if($num_filas>0){ ?>
                            <a href="imprimir.php?i=h" onClick="Javascript:window.open('', 'imprimir', 'scrollbars=yes,width=750,height=400,top=100, left=200')" target="imprimir" class="ba3111" title="Imprimir Productos"><strong> <img src="../imagenes/printer.gif" width="12" height="12" border="0">Imprimir </strong></a>
                          <?php } ?></td>
                      </tr>
                    </table>
                      <br>
                      <?php if($num_filas>0){ ?>
                      <table border="0" cellpadding="2" cellspacing="1">
                        <tr bgcolor="#666666">
                          <th bgcolor="#CCCCCC"><div align="center">N&ordm;</div></th>
                          <th bgcolor="#CCCCCC">Orden</th>
                          <th bgcolor="#CCCCCC">Cliente</th>
                          <th bgcolor="#CCCCCC">Valor</th>
                          <th bgcolor="#CCCCCC">Estado</th>
                          <th bgcolor="#CCCCCC"><div align="center">Fecha </div></th>
                          </tr>
                        <?php 
				  $i=$ini;
				 while ($rp=mysql_fetch_object($sqlrs)){
  $i=$i+1;
  ?>
                        <tr class="texto" style="background-color:#F5F5F5" onMouseOver="this.style.backgroundColor='#CCCCCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'">
                          <td><div align="center"><strong><?php echo $i; ?></strong></div></td>
                          <td><a href="../imprimirf.php?f=<?php echo $rp->numfactura; ?>"  onClick="Javascript:window.open('', 'orden', 'scrollbars=yes,width=750,height=500,top=100, left=200')" target="orden" class="lorden" title="Ver informaci&oacute;n">
                            <div align="center"><?php echo sprintf("%04d",$rp->numfactura); ?></div>
                          </a></td>
                          <td><?php echo $rp->cliente; ?></td>
                          <td>$<?php echo sprintf("%01.2f",$rp->total); ?></td>
                          <td><?php echo $rp->estado; ?></td>
                          <td><div align="center">
                            <?php 
		  $fecha_1=explode(" ",$rp->fecha);
		  $fecha=explode("-",$fecha_1[0]);
		  echo $mes[$fecha[1]-1]." ".$fecha[2].", ".$fecha[0]; ?>
                          </div></td>
                          </tr>
                        <?php }//fin de while?>
                      </table>
                    <?php }else{ ?>
                      <span class="texto">No hay registros en el rango de fechas consultado </span>
                      <?php }//fin de if($numv<0)?></td>
                </tr>
              </table></td>
              </tr>
            </table>
            <br></td>
        </tr>
      </table>
  <?php }elseif($op=='pro'){
?>
  <table width="100%" border="0" cellpadding="2" cellspacing="2">
    <tr>
      <td><?php
	$sqlc=mysql_query("select * from categorias");
	while($rc=mysql_fetch_object($sqlc)){
		$c[$rc->cat]=$rc->nom;
	}
	
			  //paginacion 
			$numn=40;
			if($_GET['pag']){
			$fin=$_GET['pag']*$numn;
			$ini=$fin-$numn;
			$vpag=$_GET['pag'];
			}else{
			$fin=$numn;
			$ini=0;
			$vpag=1;
			}//fin de if($_GET['pag']){
			$ord[1]='nombrep';	
			$ord[2]='fechaingreso';
			$tord[1]=' ASC';
			$tord[2]=' DESC';
			if($_POST['orden']){
				$io=$_POST['orden'];
				$it=$_POST['torden'];
			}elseif($_GET['orden']){
				$io=$_GET['orden'];
				$it=$_GET['torden'];
			}else{
				$io=1;
				$it=1;
			}
			$sqlor=$ord[$io].$tord[$it];
			$sqlv=mysql_query("select * from productos order by ".$sqlor."  LIMIT ".$ini." , ".$numn);
			//$sqlv=mysql_query("select p.codc,p.codp,p.imagenp,p.nombrep,p.fechaingreso,dp.coddp,dp.codp,dp.fechas,dp.fechar,dp.hotel,dp.habitacion,dp.precioa,dp.precion,dp.unidades,dp.otros from detalleproductos dp,productos p where dp.codp=p.codp order by ".$sqlor.",dp.coddp LIMIT ".$ini." , ".$numn);
			
			$_SESSION['print']="select * from productos order by ".$sqlor."  LIMIT ".$ini." , ".$numn;
			//$_SESSION['print']="select p.codc,p.codp,p.imagenp,p.nombrep,p.fechaingreso,dp.coddp,dp.codp,dp.fechas,dp.fechar,dp.hotel,dp.habitacion,dp.precioa,dp.precion,dp.unidades,dp.otros from detalleproductos dp,productos p where dp.codp=p.codp order by ".$sqlor.",dp.coddp LIMIT ".$ini." , ".$numn;
			$numv=mysql_num_rows($sqlv);
			   $numf=mysql_fetch_object(mysql_query("select count(*) as nf from productos"));
											 $num_filas=$numf->nf;										
			  ?>
        <br>
        <table border="0" cellpadding="1" cellspacing="10">
          <tr>
            <td nowrap><a href="iproducto.php" onClick="Javascript:window.open('', 'iproducto', 'scrollbars=yes,width=750,height=500,top=100, left=200')" target="iproducto" class="ba3" title="Ingresar Producto"><strong> <img src="../imagenes/pa.gif" width="12" height="12" border="0">Ingresar Nuevo </strong></a></td>
            <td><strong>Tours Ingresados: </strong> <span class="link2"><?php echo $num_filas; ?></span></td>
            <td><a href="imprimir.php?i=p" onClick="Javascript:window.open('', 'imprimir', 'scrollbars=yes,width=750,height=400,top=100, left=200')" target="imprimir" class="ba3" title="Imprimir Productos"><strong> <img src="../imagenes/printer.gif" width="12" height="12" border="0">Imprimir </strong></a></td>
            <td>&nbsp;</td>
            <td><form name="form1" method="post" action="index_1.php">
              <label><strong>Ordenar por</strong>
  <select name="orden" id="orden">
    <option value="1" <?php if($io==1){ ?>selected<?php } ?>>Nombre</option>
    <option value="2" <?php if($io==2){ ?>selected<?php } ?>>Fecha Ingreso</option>
  </select>
                <select name="torden" id="torden">
                  <option value="1" <?php if($it==1){ ?>selected<?php } ?>>Ascendente</option>
                  <option value="2" <?php if($it==2){ ?>selected<?php } ?>>Descendente</option>
                  </select>
                <input type="submit" name="button3" id="button3" value="Ver">
                </label>
              </form></td>
            </tr>
          </table>
        <br>
        <?php if($num_filas>0){ ?>
        <div id="gallery2">
          <table border="0" cellpadding="2" cellspacing="1">
            <tr bgcolor="#666666">
              <th bgcolor="#CCCCCC"><div align="center">N&ordm;</div></th>
              <th bgcolor="#CCCCCC">Regi&oacute;n</th>
              <th bgcolor="#CCCCCC">Nombre</th>
              <th bgcolor="#CCCCCC">Imagen</th>
              <th bgcolor="#CCCCCC">Precio</th>
              <th bgcolor="#CCCCCC"><div align="center">Fecha Ingreso</div></th>
              <th bgcolor="#CCCCCC">Borrar</th>
              <th bgcolor="#CCCCCC">Actualizar</th>
              </tr>
            <?php 
				  $i=$ini;
				 while ($rp=mysql_fetch_object($sqlv)){
  $i=$i+1;
  //$dp=mysql_fetch_object(mysql_query("select codc,nombrep,imagenp,fechaingreso from productos where codp=".$rp->codp));
  ?>
            <tr class="texto" style="background-color:#F5F5F5" onMouseOver="this.style.backgroundColor='#CCCCCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'">
              <td><div align="center"><strong><?php echo $i; ?></strong></div></td>
              <td>
                <div align="center"><?php echo $c[$rp->codc]; ?></div>            </td>
              <td><a href="../producto.php?p=<?php echo $rp->codp; ?>"  target="_blank" class="lorden" title="Ver informaci&oacute;n"><?php echo $rp->nombrep; ?></a></td>
              <td><div align="center">
                <?php $ip=explode("+",$rp->imagenp); ?>
                <img src="../imagenes/p/<?php echo $ip[0]; ?>" width="70" height="70" /></div></td>
              <td><div align="center">$<?php echo sprintf("%01.2f",$rp->precio); ?></div></td>
              <td><div align="center">
                <?php 
		  $fecha_1=explode(" ",$rp->fechaingreso);
		  $fecha=explode("-",$fecha_1[0]);
		  echo $mes[$fecha[1]-1]." ".$fecha[2].", ".$fecha[0]; ?>
                </div></td>
              <td><div align="center"><a href='Javascript:confirmap("<?php echo md5($rp->codp)."&dp=".$rp->codp; ?>","<?php echo str_replace("'","",$rp->nombrep) ?>")' class="link1"><img src="../imagenes/botones/borrar.png" alt="Borrar" width="25" height="25" border="0" title="Borrar"></a></div></td>
              <td><div align="center"><a href="aproducto.php?p=<?php echo $rp->codp; ?>" onClick="Javascript:window.open('', 'aproducto', 'scrollbars=yes,width=750,height=500,top=100, left=200')" target="aproducto" class="link1"></a><a href="aproducto.php?p=<?php echo $rp->codp; ?>" onClick="Javascript:window.open('', 'aproducto', 'scrollbars=yes,width=750,height=500,top=100, left=200')" target="aproducto" class="link1"><img src="../imagenes/botones/actualizar.png" alt="Actualizar" width="25" height="25" border="0" title="Actualizar"></a></div></td>
              </tr>
            <?php }//fin de while?>
            </table>
          <table border="0" cellpadding="0" cellspacing="0" style="background:url(images/fcde1.jpg) repeat-x top">
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              </tr>
            <tr>
              <td><div align="center" > <span class="Est6">
                <?php 
											 if($vpag<=7){//control para desplegar solo $numn catalogos 
											 $j=0;//inicio
											 $k=7;//final
											 }else{
											 $j=$vpag-7;//inicio
											 $k=$vpag;//final
											 }
											 $sp=$vpag+1;//siguiente pagina
											 $ap=$vpag-1;//pagina anterior
											 //desplegar numeros si hay mas numeros de pagina
											 if($num_filas>$numn){
											 $i=$num_filas/$numn;
											 ?>
                <?php
											 echo 'P&Aacute;GINAS: ';
											 if($ap>0){//control para mostrar o ocultar pagina anterior
										  ?>
                </span><a href="index_1.php?pag=1&orden=<?php echo $io; ?>&torden=<?php echo $it; ?>" title="Primera p&aacute;gina" class="link1">&lt;&lt; </a> | <a href="index_1.php?pag=<?php echo $ap; ?>&orden=<?php echo $io; ?>&torden=<?php echo $it; ?>" class="link1">Anterior</a>
                <?php
										    }//fin de if($ap>1)
											 while($j<$i and $j<$k){
											 $j++;
											 if($vpag==$j){//ver en que catalogo estamos
											 ?>
                | <strong><?php echo $j; ?></strong>
                <?php
										  }else{
										  ?>
                | <a href="index_1.php?pag=<?php echo $j; ?>&orden=<?php echo $io; ?>&torden=<?php echo $it; ?>" class="link1"><?php echo $j; ?></a>
                <?php
										  }//fin de if($vpag=$j)
										   }//fin While
										   if($sp<$i+1){//control para mostrar o ocultar siguiente pagina
										  ?>
                | <a href="index_1.php?pag=<?php echo $sp; ?>&orden=<?php echo $io; ?>&torden=<?php echo $it; ?>" class="link1">Siguiente</a> | <a href="index_1.php?pag=<?php echo ceil($i); ?>&orden=<?php echo $io; ?>&torden=<?php echo $it; ?>" title="Ultima p&aacute;gina" class="link1">&gt;&gt;</a>
                <?php
										    }//fin de if($sp<=$j)
											}
											?>
                <br />
                </div></td>
              <td><div align="right"></div></td>
              </tr>
            </table>
          </div>
        <?php }//fin de if($numv<0)
			  
			  ?></td>
      </tr>
  </table>
  <?php }elseif($op=='res'){
		//paginacion 
			$numn=30;
			if($_GET['pag']){
			$fin=$_GET['pag']*$numn;
			$ini=$fin-$numn;
			$vpag=$_GET['pag'];
			}else{
			$fin=$numn;
			$ini=0;
			$vpag=1;
			}//fin de if($_GET['pag']){
				if($_POST['pal']){
				$palabra=trim($_POST['pal']);
				$fil=$_POST['filtro'];
				if($fil==1){
					$sqladi="where cliente like '%".$palabra."%'";
				}else{
					$sqladi="where servicio like '%".$palabra."%'";
				}
			    $textadi=" Encontradas ";
			}
			if($_GET['pal']){
				$palabra=trim($_GET['pal']);
				$fil=$_GET['filtro'];
				if($fil==1){
					$sqladi="where cliente like '%".$palabra."%'";
				}else{
					$sqladi="where servicio like '%".$palabra."%'";
				}
			    $textadi=" Encontradas ";
			}
			
			$sqlv=mysql_query("select * from reservas ".$sqladi." order by fecha DESC LIMIT ".$ini." , ".$numn);
			$_SESSION['print']="select * from reservas ".$sqladi." order by fecha DESC LIMIT ".$ini." , ".$numn;
			$numv=mysql_num_rows($sqlv);
			 $numf=mysql_fetch_object(mysql_query("select count(*) as nf from reservas ".$sqladi));
		$num_filas=$numf->nf;
		?>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td><?php 
			  if($_GET['env']==1){
			    echo '<span class="Estilo7">Cotizacion Enviada</span>';
			  }elseif($_GET['env']==2){
			  echo '<span class="Estilo7">Cotizacion No Enviada</span>';
			  }
			  
			  ?>
        <?php if(!$_GET['in']==1){//si no ingresa noticia se visualiza noticias ?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td><br><table border="0" cellpadding="2" cellspacing="2">
              <tr>
                <td valign="middle"><strong>Reservaciones Web Realizadas:</strong></td>
                <td valign="middle"><span class="link2"><?php  echo $num_filas." ".$textadi; ?></span></td>
                <td>&nbsp;</td>
                <td valign="middle"><a href="imprimir.php?i=r" onClick="Javascript:window.open('', 'imprimir', 'scrollbars=yes,width=750,height=400,top=100, left=200')" target="imprimir" class="ba3" title="Imprimir Reservaciones"><strong> <img src="../imagenes/printer.gif" width="12" height="12" border="0">Imprimir</strong></a></td>
                <td>&nbsp;</td>
                <td valign="bottom"><form id="fbuscar" name="fbuscar" method="post" action="index_1.php">
                  <strong>Buscador</strong>
                  <input name="pal" type="text" id="pal" value="<?php echo $palabra ?>" size="20" />
                  <select name="filtro" id="filtro">
                    <option value="1"<?php if($fil==1){ ?> selected<?php } ?>>Por Nombre</option>
                    <option value="2"<?php if($fil==2){ ?> selected<?php } ?>>Por Tour</option>
                    </select>
                  <input name="button" type="button" class="boton" id="button" value="Buscar" onClick="enviob(fbuscar)"/>
                  </form></td>
                <td valign="top">
                  <?php 
					  if($palabra!=''){
					  ?>
                  <input name="button2" type="button" class="boton" id="button2" value="Ver Todos" onClick="window.location.href='index_1.php'" >
                  <?php 
					  }//fin de if($palabra!=''){
					  ?>              </td>
                </tr>
              </table>
              <br>
              <?php if($num_filas>0){ ?>
              <table width="100%" border="0">
                <tr>
                  <td><table border="0" cellpadding="3" cellspacing="1" bordercolor="#CCCCCC">
                    <tr bgcolor="#CAE2A5">
                      <th  bgcolor="#CCCCCC">N&ordm;</th>
                      <th  bgcolor="#CCCCCC" style="display:none">Tipo</th>
                      <th  bgcolor="#CCCCCC">Paquete</th>
                      <th  bgcolor="#CCCCCC">Nombre</th>
                      <th  bgcolor="#CCCCCC">Ciudad</th>
                      <th  bgcolor="#CCCCCC">Tel&eacute;fono</th>
                      <th  bgcolor="#CCCCCC">E-Mail</th>
                      <th  nowrap bgcolor="#CCCCCC">Para Fecha</th>
                      <th  nowrap bgcolor="#CCCCCC">No. Personas</th>
                      <th  nowrap bgcolor="#CCCCCC">Comentarios</th>
                      <th  nowrap bgcolor="#CCCCCC">Fecha </th>
                      <th  nowrap bgcolor="#CCCCCC">Estado</th>
                      </tr>
                    <?php 
			$i=$ini;
		while($row=mysql_fetch_object($sqlv)){
		$j=$i+1;
		?>
                    <tr class="texto1" style="background-color:#F5F5F5" onMouseOver="this.style.backgroundColor='#CCCCCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'">
                      <td><div align="center"><strong><?php echo $j; ?></strong></div></td>
                      <td style="display:none"><?php echo $row->tipo; ?></td>
                      <td><?php echo $row->servicio; ?></td>
                      <td><?php echo $row->cliente; ?></td>
                      <td nowrap><?php echo $row->ciudad; ?></td>
                      <td nowrap><?php echo $row->telefono; ?></td>
                      <td nowrap><?php echo $row->email; ?></td>
                      <td><?php echo $row->fechar; ?></td>
                      <td><?php echo $row->personas; ?></td>
                      <td><?php echo $row->comentario; ?></td>
                      <td><div align="center">
                        <?php 
		  $fecha_1=explode(" ",$row->fecha);
		  $fecha=explode("-",$fecha_1[0]);
		  echo $mes[$fecha[1]-1]." ".$fecha[2].", ".$fecha[0]; ?>
                        </div></td>
                      <td <?php if($row->estado!=1){ ?>bgcolor="#FF6A6A"<?php } ?>>
                        <?php if($row->estado==1){ ?>
                        <a href="res_mail.php?r=<?php echo $row->idr; ?>" onClick="Javascript:window.open('', 'rreserva', 'scrollbars=yes,width=750,height=500,top=100, left=200')" target="rreserva" style="color:#006; font-weight:bold">Mail Enviado</a>
                        <?php }else{?>
                        <a href="res_mail.php?r=<?php echo $row->idr; ?>" onClick="Javascript:window.open('', 'aproducto', 'scrollbars=yes,width=750,height=500,top=100, left=200')" target="aproducto" style="color:#006; font-weight:bold">Sin responder</a><?php } ?>
                      </td>
                      </tr>
                    <?php 
		$i=$i+1;
		}//fin while?>
                    </table>
                    <table border="0" cellpadding="0" cellspacing="0" style="background:url(images/fcde1.jpg) repeat-x top">
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        </tr>
                      <tr>
                        <td><div align="center" > <span class="Est6">
                          <?php 
											 if($vpag<=7){//control para desplegar solo $numn catalogos 
											 $j=0;//inicio
											 $k=7;//final
											 }else{
											 $j=$vpag-7;//inicio
											 $k=$vpag;//final
											 }
											 $sp=$vpag+1;//siguiente pagina
											 $ap=$vpag-1;//pagina anterior
											 //desplegar numeros si hay mas numeros de pagina
											 if($num_filas>$numn){
											 $i=$num_filas/$numn;
											 ?>
                          <?php
											 echo 'P&Aacute;GINAS: ';
											 if($ap>0){//control para mostrar o ocultar pagina anterior
										  ?>
                          </span><a href="index_1.php?pag=1&pal=<?php echo $palabra ?>&filtro=<?php echo $fil ?>" title="Primera p&aacute;gina" class="link1">&lt;&lt; </a> | <a href="index_1.php?pag=<?php echo $ap; ?>&pal=<?php echo $palabra ?>&filtro=<?php echo $fil ?>" class="link1">Anterior</a>
                          <?php
										    }//fin de if($ap>1)
											 while($j<$i and $j<$k){
											 $j++;
											 if($vpag==$j){//ver en que catalogo estamos
											 ?>
                          | <strong><?php echo $j; ?></strong>
                          <?php
										  }else{
										  ?>
                          | <a href="index_1.php?pag=<?php echo $j; ?>&pal=<?php echo $palabra ?>&filtro=<?php echo $fil ?>" class="link1"><?php echo $j; ?></a>
                          <?php
										  }//fin de if($vpag=$j)
										   }//fin While
										   if($sp<$i+1){//control para mostrar o ocultar siguiente pagina
										  ?>
                          | <a href="index_1.php?pag=<?php echo $sp; ?>&pal=<?php echo $palabra ?>&filtro=<?php echo $fil ?>" class="link1">Siguiente</a> | <a href="index_1.php?pag=<?php echo ceil($i); ?>&pal=<?php echo $palabra ?>&filtro=<?php echo $fil ?>" title="Ultima p&aacute;gina" class="link1">&gt;&gt;</a>
                          <?php
										    }//fin de if($sp<=$j)
											}
											?>
                          <br />
                          </div></td>
                        <td><div align="right"></div></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
              <?php }//fin de if($num_filas>0){ ?>
              </td>
            </tr>
          </table>
        <iframe id="exportframe" name="exportframe" height="2px" width="2px" frameborder="0"></iframe>
        <?php }elseif($_GET['in']==1){
	//c&oacute;digo para crear proforma de cotizaci&oacute;n
if($_GET['nv']==1){//nueva venta
unset($_SESSION['cotiza']);
}
//variables de sesion
$compramp=$_SESSION['cotiza'];
//captura de datos seguro
$vq=sprintf('%s',$_GET['q']);//codigo de producto a borrar
if($vq){//borrar un producto de la factura
unset($compramp[$vq]);
}// fin de 	if($vq)
////////////////////////////////////////////////
if($_POST['cantidad']){// a&ntilde;adir un producto nuevo a la factura 
$item=$_POST['articulo1'];
$vcantidad=$_POST['cantidad'];
  if($item>0){
      $sqlpr=mysql_fetch_object(mysql_query("select precio,nombrep from productos where codp=".$item));
	  $vprecio=$sqlpr->precio;
	  $vproducto=$sqlpr->nombrep;
  }else{
	  $vprecio=$_POST['precio'];
    $nopermitidos = array("-","+","*","$","@","#"," ","&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&ntilde;","&Ntilde;","&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;");//caracteres no permitidos
	$vproducto=$_POST['articulo'];
   $item = str_replace($nopermitidos, "", $vproducto);
  }
		//comprobamos cantidad sea mayor a cero
		if($vcantidad>0){
		//llenamos el carro de compras
			if ($item){ 
			   if (!isset($compramp)){ 
				  $compramp[$item]['cant']=$vcantidad;//variable codp->cantidad
				  $compramp[$item]['prod']=$vproducto;//variable codp->cantidad
				 // $compramp[$item]['prec']=round($vprecio/1.12,2);//variable precio
				  $compramp[$item]['prec']=$vprecio;//variable precio
			   }else{ 
				  foreach($compramp as $k => $v){ 
					 if ($item==$k){ 
					 $compramp[$k]['cant']=$compramp[$k]['cant']+$vcantidad; //variable codp-cantidad
					 $encontrado=1; 
					 } 
				  } 
				  if (!$encontrado){ 
				  $compramp[$item]['cant']=$vcantidad;//variable codp->cantidad
				  $compramp[$item]['prod']=$vproducto;//variable codp->cantidad
				  //$compramp[$item]['prec']=round($vprecion/1.12,2);//variable precio
				  $compramp[$item]['prec']=$vprecio;//variable precio
					 } 
			   } //fin de if (!isset($compramp)){ 
			}//fin de if ($item){
			//$_SESSION['codcot']=$item;
		 }//fin de if($vcantidadn>0){
}// fin de if($_POST['np']==1 and !$vq)
/////////////////////////////////////////////
//actualizamos variable de sesion carro
$_SESSION['cotiza']=$compramp; 
////fin de creacion de cotizacion///////
	 ?>
        <table border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td><p align="center" class="Estilo10">Formulario de cotizaci&oacute;n</p>
              <p align="left"><strong>Ingrese los art&iacute;culos que desea enviar en su cotizaci&oacute;n</strong></p>
              <form action="index_1.php?in=1" method="post" name="fcot" id="fcot">
                <table border="0" cellpadding="2" cellspacing="2">
                  <tr>
                    <td>Art&iacute;culo:
                      <select name="articulo1" id="articulo1" style="width:200px" onChange="arti(fcot,'dna')">
                        <option value="">---------------Otro------------------</option>
                        <?php $sqlp=@mysql_query("select codp,nombrep from productos");
				  while($rp=@mysql_fetch_object($sqlp)){
				?>
                        <option value="<?php echo $rp->codp; ?>"><?php echo $rp->nombrep; ?></option>
                        <?php } ?>
                        </select></td>
                    <td>Cantidad</td>
                    <td><input name="cantidad" type="text" id="cantidad" value="1" size="3" maxlength="3"></td>
                    <td>&nbsp;</td>
                    <td><input name="btna" type="button" id="btna" value="A&ntilde;adir" onClick="acot(fcot)"></td>
                    </tr>
                  <tr>
                    <td colspan="5"><div align="left" id="dna">Nombre:
                      <input name="articulo" type="text" id="articulo" size="54" maxlength="100">
                      Precio:
                      <input name="precio" type="text" id="precio" size="5" maxlength="10" >
                      <span class="Estilo14">(incluido impuestos)</span>
                      </div></td>
                    </tr>
                  </table>
                </form></td>
            </tr>
          </table>
        <p>
          <?php 
			echo '<span class="Estilo7">'.$mensaje.'</span>';
			if (!empty($_SESSION['cotiza'])){
			 $compramp= $_SESSION['cotiza'];
				 ?>
          </p>
        <table border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th width="170" bgcolor="#FFFFFF" class="ladobi">Art&iacute;culo</th>
            <th width="70" bgcolor="#FFFFFF" class="ladobi">V. Unit </th>
            <th width="50" bgcolor="#FFFFFF" class="ladobi">Cantidad</th>
            <th width="80" bgcolor="#FFFFFF" class="ladobi">V. Total </th>
            <th width="20" bgcolor="#FFFFFF" class="ladod"> </th>
            </tr>
          <?php //EL CONTENIDO DE LA FACTURA 
			  $i=1;
			     foreach($compramp as $k => $v){ 
				 //$producto=mysql_query("select * from productos where codp='$k'");
				 //$producto1=mysql_fetch_object($producto);?>
          <tr bgcolor="#FFFFFF">
            <td class="ladobi"><div align="center"><?php echo $compramp[$k]['prod']; ?></div></td>
            <td class="ladobi"><div align="center"><?php echo sprintf("%01.2f",$compramp[$k]['prec']); ?></div></td>
            <td class="ladobi"><div align="center"><?php echo $compramp[$k]['cant']; ?></div></td>
            <td class="ladobi"><div align="center">
              <?php 
				$vtotal=$compramp[$k]['cant']*$compramp[$k]['prec'];
				echo sprintf("%01.2f",$vtotal); 
				$subtotal=$subtotal+$vtotal;?>
              </div></td>
            <td class="ladobid"><?php if($vg!='guardado'){?>
              <div align="center" id="dviqp"><a href="index_1.php?in=1&q=<?php echo $k; ?>" class="link1">Quitar</a></div>
              <?php }?></td>
            </tr>
          <?php 
			      //guardar datos en detallefactural si esta guardado
				  if($vg=='guardado'){
				    $codpe=$compramp[$k]['cod'];
					$nombrep=$compramp[$k]['prod'];
					$preciop=$compramp[$k]['prec'];
					$cantidadp=$compramp[$k]['cant'];
					$descuentop=$compramp[$k]['desc'];
				    mysql_query("insert into detallefactural values('$numfactura','$i','','$codpe','$nombrep','$preciop','$cantidadp','$monto','$descuentop','$vtotal')");
					$i=$i+1;
				  }
			  } // fin de foreach($compramp as $k => $v){ ?>
          <tr bgcolor="#FFFFFF">
            <td colspan="3" class="ladoi"><div align="right" ><strong>TOTAL</strong></div></td>
            <td nowrap class="ladobi"><div align="center">
              <?php 
			  $total=round($subtotal+$iva+$operadora,2);
			  echo sprintf("%01.2f",$total); ?>
              <input name="tot" type="hidden" id="tot" value="<?php echo $total ?>">
              </div></td>
            <td class="ladod"></td>
            </tr>
          </table>
        <br>
        <form name="fcot1" method="post" action="index_1.php" id="fcot1">
          <ul>
            <li class="Estilo8">Ingrese opcionalmente un comentario </li>
            <li class="Estilo8">Ingrese el nombre del destinatario </li>
            <li class="Estilo8"> Ingrese e-mail al cual se enviar&aacute; la cotizaci&oacute;n </li>
            </ul>
          <table border="0" cellpadding="2" cellspacing="2" bgcolor="#EFEFEF">
            <tr>
              <td><div align="right"><strong>Comentario: </strong></div></td>
              <td colspan="4"><textarea name="comc" cols="50" rows="5" id="comc">.</textarea></td>
              </tr>
            <tr>
              <td><div align="right"><strong>Nombre:</strong></div></td>
              <td><input name="nomc" type="text" id="nomc" size="30"></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><input name="envc" type="button" class="boton" id="envc" onClick="enviacot(fcot1)" value="Enviar Cotizaci&oacute;n"></td>
              </tr>
            <tr>
              <td><div align="right"><strong>E-Mail:</strong></div></td>
              <td><input name="emailc" type="text" id="emailc" size="30"></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><input name="envc1" type="button" class="boton" id="envc1" onClick="vistacot(fcot1)" value="Vista Previa"></td>
              </tr>
            </table>
          </form>
        <?php }//fin de if (!empty($compramp)){ ?>
        <?php  }//fin de $_GET['in']==1){ ?></td>
      </tr>
  </table>
  <?php }elseif($op=='tes'){//testimonios ?>
  <table width="100%" border="0" cellpadding="2" cellspacing="2">
    <tr>
      <td><?php
			  //paginacion 
			$numn=20;
			if($_GET['pag']){
			$fin=$_GET['pag']*$numn;
			$ini=$fin-$numn;
			$vpag=$_GET['pag'];
			}else{
			$fin=$numn;
			$ini=0;
			$vpag=1;
			}//fin de if($_GET['pag']){
			
			$sqlv=mysql_query("select * from testimonios order by fecha DESC LIMIT ".$ini." , ".$numn);
			$_SESSION['print']="select * from testimonios order by fecha DESC LIMIT ".$ini." , ".$numn;
			$numv=mysql_num_rows($sqlv);
			   $numf=mysql_fetch_object(mysql_query("select count(*) as nf from testimonios"));
											 $num_filas=$numf->nf;											
			  ?>
        <br>
        <table width="400" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td>
              <a href="itestimonio.php" onClick="Javascript:window.open('', 'inoticia', 'scrollbars=yes,width=750,height=500,top=100, left=200')" target="inoticia" class="ba" title="Ingresar testimonio"><strong> <img src="../imagenes/pa.gif" width="12" height="12" border="0">Ingresar Nuevo </strong></a>
              </td>
            <td><strong>Testimonios Ingresados: </strong> <span class="link2"><?php echo $num_filas; ?></span></td>
            </tr>
          </table>
        <br>
        <?php if($numv>0){ ?>
        <div id="gallery">
          <table width="500" border="0" cellpadding="2" cellspacing="1">
            <tr bgcolor="#666666">
              <th bgcolor="#CCCCCC"><div align="center">N&ordm;</div></th>
              <th bgcolor="#CCCCCC">T&iacute;tulo</th>
              <th bgcolor="#CCCCCC">Imagen</th>
              <th bgcolor="#CCCCCC"><div align="center">Fecha</div></th>
              <th bgcolor="#CCCCCC">Borrar</th>
              <th bgcolor="#CCCCCC">Actualizar</th>
              </tr>
            <?php 
				  $i=$ini;
				  while($row=mysql_fetch_object($sqlv)){
  $i=$i+1;
  ?>
            <tr class="texto" style="background-color:#F5F5F5" onMouseOver="this.style.backgroundColor='#CCCCCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'">
              <td><div align="center"><strong><?php echo $i; ?></strong></div></td>
              <td>
                <div align="center"><?php echo $row->nom; ?></div>
                </td>
              <td><div align="center">
                <img src="../imagenes/g/<?php $f=explode("+",$row->foto); echo $f[0]; ?>" width="100" height="100" />
                
                </div>                </td>
              <td><div align="center">
                <?php 
		  $fecha_1=explode(" ",$row->fecha);
		  $fecha=explode("-",$fecha_1[0]);
		  echo $mes[$fecha[1]-1]." ".$fecha[2].", ".$fecha[0]; ?>
                </div></td>
              <td><div align="center"><a href='Javascript:confirma("<?php echo "id=".md5($row->idt)."&dt=".$row->idt."&im=".$row->f1; ?>","<?php echo str_replace("'","",$row->nom); ?>")' class="link1"><img src="../imagenes/botones/borrar.png" alt="Borrar" width="25" height="25" border="0" title="Borrar"></a></div></td>
              <td><div align="center"><a href="atestimonio.php?t=<?php echo $row->idt; ?>" onClick="Javascript:window.open('', 'anoticia', 'scrollbars=yes,width=750,height=500,top=100, left=200')" target="anoticia" class="link1"><img src="../imagenes/botones/actualizar.png" alt="Actualizar" width="25" height="25" border="0" title="Actualizar"></a></div>                </td>
              </tr>
            <?php }//fin de while?>
            </table>
          <table border="0" cellpadding="0" cellspacing="0" style="background:url(images/fcde1.jpg) repeat-x top">
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              </tr>
            <tr>
              <td><div align="center" > <span class="Est6">
                <?php 
											 if($vpag<=7){//control para desplegar solo $numn catalogos 
											 $j=0;//inicio
											 $k=7;//final
											 }else{
											 $j=$vpag-7;//inicio
											 $k=$vpag;//final
											 }
											 $sp=$vpag+1;//siguiente pagina
											 $ap=$vpag-1;//pagina anterior
											 //desplegar numeros si hay mas numeros de pagina
											 if($num_filas>$numn){
											 $i=$num_filas/$numn;
											 ?>
                <?php
											 echo 'P&Aacute;GINAS: ';
											 if($ap>0){//control para mostrar o ocultar pagina anterior
										  ?>
                </span><a href="index_1.php?pag=1" title="Primera p&aacute;gina" class="link1">&lt;&lt; </a> | <a href="index_1.php?pag=<?php echo $ap; ?>" class="link1">Anterior</a>
                <?php
										    }//fin de if($ap>1)
											 while($j<$i and $j<$k){
											 $j++;
											 if($vpag==$j){//ver en que catalogo estamos
											 ?>
                | <strong><?php echo $j; ?> </strong>
                <?php
										  }else{
										  ?>
                | <a href="index_1.php?pag=<?php echo $j; ?>" class="link1"><?php echo $j; ?></a>
                <?php
										  }//fin de if($vpag=$j)
										   }//fin While
										   if($sp<$i+1){//control para mostrar o ocultar siguiente pagina
										  ?>
                | <a href="index_1.php?pag=<?php echo $sp; ?>" class="link1">Siguiente</a> | <a href="index_1.php?pag=<?php echo ceil($i); ?>" title="Ultima p&aacute;gina" class="link1">&gt;&gt;</a>
                <?php
										    }//fin de if($sp<=$j)
											}
											?>
                <br />
                </div></td>
              <td><div align="right"></div></td>
              </tr>
            </table>
          </div>
        <?php }//fin de if($numv<0)
			  
			  ?></td>
      </tr>
  </table>
  <?php }elseif($op=='abo'){//contenidos about ?>
  <table width="100%" border="0" cellpadding="2" cellspacing="2">
    <tr>
      <td>
        <br>
        <table border="0" cellpadding="1" cellspacing="10">
          <tr>
            <td nowrap>&nbsp;</td>
            <td><strong>Contenido About</strong></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
          </table>
        <br>
       
        <div id="gallery3">
          <table border="0" cellpadding="2" cellspacing="1">
            <tr bgcolor="#666666">
              <th bgcolor="#CCCCCC">Nombre</th>
              <th bgcolor="#CCCCCC">Imagen</th>
              <th bgcolor="#CCCCCC"><div align="center">Fecha Actualizaci&oacute;n</div></th>
              <th bgcolor="#CCCCCC">Actualizar</th>
              </tr>
           
            <tr class="texto" style="background-color:#F5F5F5" onMouseOver="this.style.backgroundColor='#CCCCCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'">
              <td><a href="../about.php"  target="_blank" class="lorden" title="Ver informaci&oacute;n">About</a> <?php $rp=mysql_fetch_object(mysql_query("select * from contenidos where idc=1"));?></td>
              <td><div align="center">
                <?php $ip=explode("+",$rp->foto); ?>
                <img src="../imagenes/g/<?php echo $ip[0]; ?>" width="70" height="70" /></div></td>
              <td><div align="center">
                <?php 
		  $fecha_1=explode(" ",$rp->fecha);
		  $fecha=explode("-",$fecha_1[0]);
		  echo $mes[$fecha[1]-1]." ".$fecha[2].", ".$fecha[0]; ?>
              </div></td>
              <td><div align="center"><a href="acontenido.php?c=<?php echo $rp->idc; ?>" onClick="Javascript:window.open('', 'acontenido', 'scrollbars=yes,width=750,height=500,top=100, left=200')" target="acontenido" class="link1"><img src="../imagenes/botones/actualizar.png" alt="Actualizar" width="25" height="25" border="0" title="Actualizar"></a></div></td>
              </tr>
            </table>
          <table border="0" cellpadding="0" cellspacing="0" style="background:url(images/fcde1.jpg) repeat-x top">
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              </tr>
            <tr>
              <td><div align="center" > <span class="Est6">
                <?php 
											 if($vpag<=7){//control para desplegar solo $numn catalogos 
											 $j=0;//inicio
											 $k=7;//final
											 }else{
											 $j=$vpag-7;//inicio
											 $k=$vpag;//final
											 }
											 $sp=$vpag+1;//siguiente pagina
											 $ap=$vpag-1;//pagina anterior
											 //desplegar numeros si hay mas numeros de pagina
											 if($num_filas>$numn){
											 $i=$num_filas/$numn;
											 ?>
                <?php
											 echo 'P&Aacute;GINAS: ';
											 if($ap>0){//control para mostrar o ocultar pagina anterior
										  ?>
                </span><a href="index_1.php?pag=1&orden=<?php echo $io; ?>&torden=<?php echo $it; ?>" title="Primera p&aacute;gina" class="link1">&lt;&lt; </a> | <a href="index_1.php?pag=<?php echo $ap; ?>&orden=<?php echo $io; ?>&torden=<?php echo $it; ?>" class="link1">Anterior</a>
                <?php
										    }//fin de if($ap>1)
											 while($j<$i and $j<$k){
											 $j++;
											 if($vpag==$j){//ver en que catalogo estamos
											 ?>
                | <strong><?php echo $j; ?></strong>
                <?php
										  }else{
										  ?>
                | <a href="index_1.php?pag=<?php echo $j; ?>&orden=<?php echo $io; ?>&torden=<?php echo $it; ?>" class="link1"><?php echo $j; ?></a>
                <?php
										  }//fin de if($vpag=$j)
										   }//fin While
										   if($sp<$i+1){//control para mostrar o ocultar siguiente pagina
										  ?>
                | <a href="index_1.php?pag=<?php echo $sp; ?>&orden=<?php echo $io; ?>&torden=<?php echo $it; ?>" class="link1">Siguiente</a> | <a href="index_1.php?pag=<?php echo ceil($i); ?>&orden=<?php echo $io; ?>&torden=<?php echo $it; ?>" title="Ultima p&aacute;gina" class="link1">&gt;&gt;</a>
                <?php
										    }//fin de if($sp<=$j)
											}
											?>
                <br />
                </div></td>
              <td><div align="right"></div></td>
              </tr>
            </table>
          </div>
       </td>
      </tr>
  </table>
<?php }elseif($op=='our'){//contenidos pur dream ?>  
<table width="100%" border="0" cellpadding="2" cellspacing="2">
    <tr>
      <td>
        <br>
        <table border="0" cellpadding="1" cellspacing="10">
          <tr>
            <td nowrap>&nbsp;</td>
            <td><strong>Contenido Our Dream</strong></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
          </table>
        <br>
       
        <div id="gallery3">
          <table border="0" cellpadding="2" cellspacing="1">
            <tr bgcolor="#666666">
              <th bgcolor="#CCCCCC">Nombre</th>
              <th bgcolor="#CCCCCC">Imagen</th>
              <th bgcolor="#CCCCCC"><div align="center">Fecha Actualizaci&oacute;n</div></th>
              <th bgcolor="#CCCCCC">Actualizar</th>
              </tr>
            <tr class="texto" style="background-color:#F5F5F5" onMouseOver="this.style.backgroundColor='#CCCCCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'">
              <td><a href="../ourdream.php"  target="_blank" class="lorden" title="Ver informaci&oacute;n">Our Dream</a><?php $rp=mysql_fetch_object(mysql_query("select * from contenidos where idc=2"));?></td>
              <td><div align="center">
                <?php $ip=explode("+",$rp->foto); ?>
                <img src="../imagenes/g/<?php echo $ip[0]; ?>" width="70" height="70" /></div></td>
              <td><div align="center">
                <?php 
		  $fecha_1=explode(" ",$rp->fecha);
		  $fecha=explode("-",$fecha_1[0]);
		  echo $mes[$fecha[1]-1]." ".$fecha[2].", ".$fecha[0]; ?>
                </div></td>
              <td><div align="center"><a href="acontenido.php?c=<?php echo $rp->idc; ?>" onClick="Javascript:window.open('', 'acontenido', 'scrollbars=yes,width=750,height=500,top=100, left=200')" target="acontenido" class="link1"><img src="../imagenes/botones/actualizar.png" alt="Actualizar" width="25" height="25" border="0" title="Actualizar"></a></div></td>
            </tr>
            </table>
          <table border="0" cellpadding="0" cellspacing="0" style="background:url(images/fcde1.jpg) repeat-x top">
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              </tr>
            <tr>
              <td><div align="center" > <span class="Est6">
                <?php 
											 if($vpag<=7){//control para desplegar solo $numn catalogos 
											 $j=0;//inicio
											 $k=7;//final
											 }else{
											 $j=$vpag-7;//inicio
											 $k=$vpag;//final
											 }
											 $sp=$vpag+1;//siguiente pagina
											 $ap=$vpag-1;//pagina anterior
											 //desplegar numeros si hay mas numeros de pagina
											 if($num_filas>$numn){
											 $i=$num_filas/$numn;
											 ?>
                <?php
											 echo 'P&Aacute;GINAS: ';
											 if($ap>0){//control para mostrar o ocultar pagina anterior
										  ?>
                </span><a href="index_1.php?pag=1&orden=<?php echo $io; ?>&torden=<?php echo $it; ?>" title="Primera p&aacute;gina" class="link1">&lt;&lt; </a> | <a href="index_1.php?pag=<?php echo $ap; ?>&orden=<?php echo $io; ?>&torden=<?php echo $it; ?>" class="link1">Anterior</a>
                <?php
										    }//fin de if($ap>1)
											 while($j<$i and $j<$k){
											 $j++;
											 if($vpag==$j){//ver en que catalogo estamos
											 ?>
                | <strong><?php echo $j; ?></strong>
                <?php
										  }else{
										  ?>
                | <a href="index_1.php?pag=<?php echo $j; ?>&orden=<?php echo $io; ?>&torden=<?php echo $it; ?>" class="link1"><?php echo $j; ?></a>
                <?php
										  }//fin de if($vpag=$j)
										   }//fin While
										   if($sp<$i+1){//control para mostrar o ocultar siguiente pagina
										  ?>
                | <a href="index_1.php?pag=<?php echo $sp; ?>&orden=<?php echo $io; ?>&torden=<?php echo $it; ?>" class="link1">Siguiente</a> | <a href="index_1.php?pag=<?php echo ceil($i); ?>&orden=<?php echo $io; ?>&torden=<?php echo $it; ?>" title="Ultima p&aacute;gina" class="link1">&gt;&gt;</a>
                <?php
										    }//fin de if($sp<=$j)
											}
											?>
                <br />
                </div></td>
              <td><div align="right"></div></td>
              </tr>
            </table>
          </div>
       </td>
      </tr>
  </table>
  
  <?php }elseif($op=='ban'){//imagenes banner ?>
  <table border="0" align="center" cellpadding="2" cellspacing="2">
    <tr>
      <td><?php
			$sqlv=mysql_query("select * from galeria where tipo=2 order by fecha");
			$numv=mysql_num_rows($sqlv);
			   $numf=mysql_fetch_object(mysql_query("select count(*) as nf from galeria where tipo=2"));
											 $num_filas=$numf->nf;											
			  ?>
        <table border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td nowrap><?php if($num_filas<10){ ?>
              <a href="igaleria3.php" onClick="Javascript:window.open('', 'igaleria', 'scrollbars=yes,width=750,height=300,top=100, left=200')" target="igaleria" class="ba341" title="Ingresar Imagen Banner"><strong> <img src="../imagenes/pa.gif" width="12" height="12" border="0">Ingresar Nuevo </strong></a>
              <?php }//fin de if($num_filas<=){ ?></td>
            <td>&nbsp;</td>
            <td><strong>Imagenes Banner Ingresados:</strong> <?php echo $num_filas; ?> de10</td>
          </tr>
        </table>
        <br>
        <?php if($numv>0){ ?>
        <div id="gallery4">
          <table border="0" cellpadding="2" cellspacing="1">
            <tr bgcolor="#666666">
              <th bgcolor="#B9DCFF"><div align="center">N&ordm;</div></th>
              <th bgcolor="#B9DCFF">Imagen</th>
              <th bgcolor="#B9DCFF"><div align="center">Fecha</div></th>
              <th bgcolor="#B9DCFF">Borrar</th>
            </tr>
            <?php 
				  $i=$ini;
				  while($row=mysql_fetch_object($sqlv)){
  $i=$i+1;
  ?>
            <tr class="texto" style="background-color:#F5F5F5" onMouseOver="this.style.backgroundColor='#CCCCCC'" onMouseOut="this.style.backgroundColor='#F5F5F5'">
              <td><div align="center"><strong><?php echo $i; ?></strong></div></td>
              <td><div align="center">
                <?php 
			  if($row->tipo==2){
			  echo '<a class="group" rel="group1" href="../imagenes/g/'.$row->imagen.'"><img src="../imagenes/g/'.$row->imagen.'" width="480" height="125" /></a>';
			  } 
			  ?>
              </div></td>
              <td><div align="center">
                <?php 
		  $fecha_1=explode(" ",$row->fecha);
		  $fecha=explode("-",$fecha_1[0]);
		  echo $mes[$fecha[1]-1]." ".$fecha[2].", ".$fecha[0]; ?>
              </div></td>
              <td><div align="center"><a href="Javascript:confirmav('<?php echo md5($row->idg)."&dg=".$row->idg."&im=".$row->imagen."&tip=".$row->tipo; ?>','1')" class="link1"><img src="../imagenes/botones/borrar.png" alt="Borrar" width="25" height="25" border="0" title="Borrar"></a></div></td>
            </tr>
            <?php }//fin de while?>
          </table>
        </div>
        <?php }//fin de if($numv<0)
			  
			  ?></td>
    </tr>
  </table>
  <?php }elseif($op=='soc'){//socios
 $m[1]="Afiliaci&oacute;n por medio a&ntilde;o";
        $m[2]="Afiliaci&oacute;n por un a&ntilde;o";
        $pm[1]=97.5;
        $pm[2]=195; 
		//paginacion 
			$numn=30;
			if($_GET['pag']){
			$fin=$_GET['pag']*$numn;
			$ini=$fin-$numn;
			$vpag=$_GET['pag'];
			}else{
			$fin=$numn;
			$ini=0;
			$vpag=1;
			}//fin de if($_GET['pag']){
				if($_POST['pal']){
				$palabra=trim($_POST['pal']);
				$fil=$_POST['filtro'];
				if($fil==1){
					$sqladi="and cliente like '%".$palabra."%'";
				}else{
					$sqladi="and ruc_ci like '%".$palabra."%'";
				}
			    $textadi=" Encontradas ";
			}
			if($_GET['pal']){
				$palabra=trim($_GET['pal']);
				$fil=$_GET['filtro'];
				if($fil==1){
					$sqladi="and cliente like '%".$palabra."%'";
				}else{
					$sqladi="and ruc_ci like '%".$palabra."%'";
				}
			    $textadi=" Encontradas ";
			}
			
			$sqlv=mysql_query("select * from socios where estado=1 ".$sqladi." order by fecha DESC LIMIT ".$ini." , ".$numn);
			$_SESSION['print']="select * from socios where estado=1 ".$sqladi." order by fecha DESC LIMIT ".$ini." , ".$numn;
			$numv=mysql_num_rows($sqlv);
			 $numf=mysql_fetch_object(mysql_query("select count(*) as nf from socios where estado=1 ".$sqladi));
		$num_filas=$numf->nf;
		?>
  <table width="100%" border="0" cellpadding="2" cellspacing="2">
        <tr>
          <td>
            <table border="0" cellpadding="2" cellspacing="2">
              <tr>
                <td valign="middle"><strong>Socios registrados:</strong></td>
                <td valign="middle"><span class="link2"><?php  echo $num_filas." ".$textadi; ?></span></td>
                <td>&nbsp;</td>
                <td nowrap><a href="isocio.php" onClick="Javascript:window.open('', 'isocio', 'scrollbars=yes,width=750,height=500,top=100, left=200')" target="isocio" class="ba33" title="Ingresar Socio"><strong> <img src="../imagenes/pa.gif" width="12" height="12" border="0">Ingresar Nuevo </strong></a></td>
                <td valign="middle"><a href="imprimir.php?i=so" onClick="Javascript:window.open('', 'imprimir', 'scrollbars=yes,width=750,height=400,top=100, left=200')" target="imprimir" class="ba3" title="Imprimir Socios"><strong> <img src="../imagenes/printer.gif" width="12" height="12" border="0">Imprimir</strong></a></td>
                <td>&nbsp;</td>
                <td valign="bottom" nowrap><form id="fbuscar" name="fbuscar" method="post" action="index_1.php">
                  <strong>Buscador</strong>
                  <input name="pal" type="text" id="pal" value="<?php echo $palabra ?>" size="20" />
                  <select name="filtro" id="filtro">
                    <option value="1"<?php if($fil==1){ ?> selected<?php } ?>>Por Nombre</option>
                    <option value="2"<?php if($fil==2){ ?> selected<?php } ?>>Por Cedula</option>
                    </select>
                  <input name="button" type="button" class="boton" id="button" value="Buscar" onClick="enviob(fbuscar)"/>
                  </form></td>
                <td valign="top">
                  <?php 
					  if($palabra!=''){
					  ?>
                  <input name="button2" type="button" class="boton" id="button2" value="Ver Todos" onClick="window.location.href='index_1.php'" >
                  <?php 
					  }//fin de if($palabra!=''){
					  ?>              </td>
              </tr>
              </table>
            <?php if($numv>0){ ?>
            <div>
              <table border="0" cellpadding="2" cellspacing="1">
                <tr bgcolor="#CCCCCC">
                  <th><div align="center">N&ordm;</div></th>
                  <th>C&eacute;dula</th>
                  <th>Nombre</th>
                  <th><div align="center">Ciudad</div></th>
                  <th><div align="center">Tel&eacute;fono</div></th>
                  <th><div align="center">E-mail</div></th>
                  <th><div align="center">Membres&iacute;a</div></th>
                  <th><div align="center">Fecha</div></th>
                  <th>Actualizar</th>
                </tr>
                <?php 
				  $i=$ini;
				  while($row=mysql_fetch_object($sqlv)){
  $i=$i+1;
  ?>
                <tr class="texto" style="background-color:#F5F5F5" onMouseOver="this.style.backgroundColor='#EBFCE2'" onMouseOut="this.style.backgroundColor='#F5F5F5'">
                  <td><div align="center"><?php echo $i; ?></div></td>
                  <td><div align="center"><?php echo $row->ruc_ci; ?></div></td>
                  <td><div align="center"><?php echo $row->cliente; ?></div></td>
                  <td><div align="center"><?php echo $row->ciudad; ?></div></td>
                  <td><div align="center"><?php echo $row->telefono; ?></div></td>
                  <td><div align="center"><?php echo $row->email; ?></div></td>
                  <td><div align="center"><?php echo $m[$row->tipo]; ?></div></td>
                  <td><div align="center">
                    <?php 
		  $fecha_1=explode(" ",$row->fecha);
		  $fecha=explode("-",$fecha_1[0]);
		  echo $mes[$fecha[1]-1]." ".$fecha[2].", ".$fecha[0]; ?>
                  </div></td>
                  <td><div align="center"><a href="asocio.php?s=<?php echo $row->ids; ?>" onClick="Javascript:window.open('', 'asocio', 'scrollbars=yes,width=750,height=500,top=100, left=200')" target="asocio" class="link1"><img src="../imagenes/botones/actualizar.png" alt="Actualizar" width="25" height="25" border="0" title="Actualizar"></a></div></td>
                </tr>
                <?php }//fin de while?>
              </table>
              <table border="0" cellpadding="0" cellspacing="0" style="background:url(images/fcde1.jpg) repeat-x top">
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="center" > <span class="Est6">
                    <?php 
											 if($vpag<=7){//control para desplegar solo $numn catalogos 
											 $j=0;//inicio
											 $k=7;//final
											 }else{
											 $j=$vpag-7;//inicio
											 $k=$vpag;//final
											 }
											 $sp=$vpag+1;//siguiente pagina
											 $ap=$vpag-1;//pagina anterior
											 //desplegar numeros si hay mas numeros de pagina
											 if($num_filas>$numn){
											 $i=$num_filas/$numn;
											 ?>
                    <?php
											 echo 'P&Aacute;GINAS: ';
											 if($ap>0){//control para mostrar o ocultar pagina anterior
										  ?>
                    </span><a href="index_1.php?pag=1&pal=<?php echo $palabra ?>&filtro=<?php echo $fil ?>" title="Primera p&aacute;gina" class="link1">&lt;&lt; </a> | <a href="index_1.php?pag=<?php echo $ap; ?>&pal=<?php echo $palabra ?>&filtro=<?php echo $fil ?>" class="link1">Anterior</a>
                    <?php
										    }//fin de if($ap>1)
											 while($j<$i and $j<$k){
											 $j++;
											 if($vpag==$j){//ver en que catalogo estamos
											 ?>
                    | <strong><?php echo $j; ?></strong>
                    <?php
										  }else{
										  ?>
                    | <a href="index_1.php?pag=<?php echo $j; ?>&pal=<?php echo $palabra ?>&filtro=<?php echo $fil ?>" class="link1"><?php echo $j; ?></a>
                    <?php
										  }//fin de if($vpag=$j)
										   }//fin While
										   if($sp<$i+1){//control para mostrar o ocultar siguiente pagina
										  ?>
                    | <a href="index_1.php?pag=<?php echo $sp; ?>&pal=<?php echo $palabra ?>&filtro=<?php echo $fil ?>" class="link1">Siguiente</a> | <a href="index_1.php?pag=<?php echo ceil($i); ?>&pal=<?php echo $palabra ?>&filtro=<?php echo $fil ?>" title="Ultima p&aacute;gina" class="link1">&gt;&gt;</a>
                    <?php
										    }//fin de if($sp<=$j)
											}
											?>
                    <br />
                  </div></td>
                  <td><div align="right"></div></td>
                </tr>
              </table>
            </div>
          <?php }//fin de if($numv<0)
			  
			  ?></td>
        </tr>
      </table> 
  <?php }elseif($op=='usu'){//usuarios
		//paginacion 
			$numn=30;
			if($_GET['pag']){
			$fin=$_GET['pag']*$numn;
			$ini=$fin-$numn;
			$vpag=$_GET['pag'];
			}else{
			$fin=$numn;
			$ini=0;
			$vpag=1;
			}//fin de if($_GET['pag']){
				if($_POST['pal']){
				$palabra=trim($_POST['pal']);
				$fil=$_POST['filtro'];
				if($fil==1){
					$sqladi="and cliente like '%".$palabra."%'";
				}else{
					$sqladi="and ruc_ci like '%".$palabra."%'";
				}
			    $textadi=" Encontradas ";
			}
			if($_GET['pal']){
				$palabra=trim($_GET['pal']);
				$fil=$_GET['filtro'];
				if($fil==1){
					$sqladi="and cliente like '%".$palabra."%'";
				}else{
					$sqladi="and ruc_ci like '%".$palabra."%'";
				}
			    $textadi=" Encontradas ";
			}
			
			$sqlv=mysql_query("select * from usuarios where idus>1 and estado=0 ".$sqladi." order by nombre LIMIT ".$ini." , ".$numn);
			$_SESSION['print']="select * from usuarios where idus>1 and estado=0 ".$sqladi." order by nombre LIMIT ".$ini." , ".$numn;
			$numv=mysql_num_rows($sqlv);
			 $numf=mysql_fetch_object(mysql_query("select count(*) as nf from usuarios where idus>1 and estado=0 ".$sqladi));
		$num_filas=$numf->nf;
		?><br>
  <table width="100%" border="0" cellpadding="2" cellspacing="2">
        <tr>
          <td>
            <table border="0" cellpadding="2" cellspacing="2">
              <tr>
                <td valign="middle"><strong>Usuarios registrados:</strong></td>
                <td valign="middle"><span class="link2"><?php  echo $num_filas." ".$textadi; ?></span></td>
                <td>&nbsp;</td>
                <td nowrap><a href="iusuario.php" onClick="Javascript:window.open('', 'iusuario', 'scrollbars=yes,width=650,height=400,top=100, left=200')" target="iusuario" class="ba33" title="Ingresar Usuario"><strong> <img src="../imagenes/pa.gif" width="12" height="12" border="0">Ingresar Nuevo </strong></a></td>
                <td valign="middle"><a href="imprimir.php?i=us" onClick="Javascript:window.open('', 'imprimir', 'scrollbars=yes,width=750,height=400,top=100, left=200')" target="imprimir" class="ba3" title="Imprimir Usuarios"><strong> <img src="../imagenes/printer.gif" width="12" height="12" border="0">Imprimir</strong></a></td>
                <td>&nbsp;</td>
              </tr>
              </table><br>
            <?php if($numv>0){ ?>
            <div>
              <table border="0" cellpadding="2" cellspacing="1">
                <tr bgcolor="#CCCCCC">
                  <th><div align="center">N&ordm;</div></th>
                  <th>C&eacute;dula</th>
                  <th>Nombre</th>
                  <th><div align="center">Ciudad</div></th>
                  <th><div align="center">Tel&eacute;fono</div></th>
                  <th><div align="center">E-mail</div></th>
                  <th><div align="center">Fecha Ingreso</div></th>
                  <th>Actualizar</th>
                  <th>Borrar</th>
                </tr>
                <?php 
				  $i=$ini;
				  while($row=mysql_fetch_object($sqlv)){
  $i=$i+1;
  ?>
                <tr class="texto" style="background-color:#F5F5F5" onMouseOver="this.style.backgroundColor='#EBFCE2'" onMouseOut="this.style.backgroundColor='#F5F5F5'">
                  <td><div align="center"><?php echo $i; ?></div></td>
                  <td><div align="center"><?php echo $row->usuario; ?></div></td>
                  <td><div align="center"><?php echo $row->nombre; ?></div></td>
                  <td><div align="center"><?php echo $row->ciudad; ?></div></td>
                  <td><div align="center"><?php echo $row->telefono; ?></div></td>
                  <td><div align="center"><?php echo $row->email; ?></div></td>
                  <td><div align="center">
                    <?php 
		  $fecha_1=explode(" ",$row->fecha);
		  $fecha=explode("-",$fecha_1[0]);
		  echo $mes[$fecha[1]-1]." ".$fecha[2].", ".$fecha[0]; ?>
                  </div></td>
                  <td><div align="center"><a href="ausuario.php?u=<?php echo $row->idus; ?>" onClick="Javascript:window.open('', 'ausuario', 'scrollbars=yes,width=650,height=400,top=100, left=200')" target="ausuario" class="link1"><img src="../imagenes/botones/actualizar.png" alt="Actualizar" width="25" height="25" border="0" title="Actualizar"></a></div></td>
                  <td><div align="center"><a href="Javascript:confirmau('<?php echo md5($row->idus)."&du=".$row->idus; ?>','<?php echo $row->nombre; ?>')" class="link1"><img src="../imagenes/botones/borrar.png" alt="Borrar" width="25" height="25" border="0" title="Borrar"></a></div></td>
                </tr>
                <?php }//fin de while?>
              </table>
              <table border="0" cellpadding="0" cellspacing="0" style="background:url(images/fcde1.jpg) repeat-x top">
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="center" > <span class="Est6">
                    <?php 
											 if($vpag<=7){//control para desplegar solo $numn catalogos 
											 $j=0;//inicio
											 $k=7;//final
											 }else{
											 $j=$vpag-7;//inicio
											 $k=$vpag;//final
											 }
											 $sp=$vpag+1;//siguiente pagina
											 $ap=$vpag-1;//pagina anterior
											 //desplegar numeros si hay mas numeros de pagina
											 if($num_filas>$numn){
											 $i=$num_filas/$numn;
											 ?>
                    <?php
											 echo 'P&Aacute;GINAS: ';
											 if($ap>0){//control para mostrar o ocultar pagina anterior
										  ?>
                    </span><a href="index_1.php?pag=1&pal=<?php echo $palabra ?>&filtro=<?php echo $fil ?>" title="Primera p&aacute;gina" class="link1">&lt;&lt; </a> | <a href="index_1.php?pag=<?php echo $ap; ?>&pal=<?php echo $palabra ?>&filtro=<?php echo $fil ?>" class="link1">Anterior</a>
                    <?php
										    }//fin de if($ap>1)
											 while($j<$i and $j<$k){
											 $j++;
											 if($vpag==$j){//ver en que catalogo estamos
											 ?>
                    | <strong><?php echo $j; ?></strong>
                    <?php
										  }else{
										  ?>
                    | <a href="index_1.php?pag=<?php echo $j; ?>&pal=<?php echo $palabra ?>&filtro=<?php echo $fil ?>" class="link1"><?php echo $j; ?></a>
                    <?php
										  }//fin de if($vpag=$j)
										   }//fin While
										   if($sp<$i+1){//control para mostrar o ocultar siguiente pagina
										  ?>
                    | <a href="index_1.php?pag=<?php echo $sp; ?>&pal=<?php echo $palabra ?>&filtro=<?php echo $fil ?>" class="link1">Siguiente</a> | <a href="index_1.php?pag=<?php echo ceil($i); ?>&pal=<?php echo $palabra ?>&filtro=<?php echo $fil ?>" title="Ultima p&aacute;gina" class="link1">&gt;&gt;</a>
                    <?php
										    }//fin de if($sp<=$j)
											}
											?>
                    <br />
                  </div></td>
                  <td><div align="right"></div></td>
                </tr>
              </table>
            </div>
          <?php }//fin de if($numv<0)
			  
			  ?></td>
        </tr>
      </table>     
  <?php }//fin de if($op=='va'){?></td>
  </tr>
  <tr>
    <td style="background:url(pie.jpg) top"><div align="center"><strong>Copyright &copy; <?php echo date('Y') ?> </strong></div></td>
  </tr>
</table>
</body>
</html>