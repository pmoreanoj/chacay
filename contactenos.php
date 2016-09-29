<?php 
if (isset($_POST['email'])) {
	$dest = "info@tradecus.com.ec";
	//$head = "From: ".$_POST['email']."\r\n";
	$head = "From: info@tradecus.com.ec \r\n";
		// Ahora creamos el cuerpo del mensaje
	$msg = "------------------------------- \n";
	$msg.= "        FORMULARIO DE CONTACTO            \n";
	$msg.= "------------------------------- \n";
	$msg.= "NOMBRE:   ".$_POST['nombre']."\n";
	$msg.= "EMAIL:    ".$_POST['email']."\n";
	$msg.= "TELEFONO:    ".$_POST['telefono']."\n";
	$msg.= "CONSULTA:    ".$_POST['mensaje']."\n\n\n\n";
	$msg.= "HORA:     ".date("h:i:s a ")."\n";
	$msg.= "FECHA:    ".date("D, d M Y")."\n";
		$msg.= " Mensaje creado por www.tradecus.com.ec \n";
	// Finalmente enviamos el mensaje
	if (mail($dest, "Nuevo CONTACTO", $msg, $head)) {
		 header("Location: contactenos.php?e=1");
	} else {
		//echo "rpta=error";
		header("Location: contactenos.php?e=2");
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="favicon.ico" />
<title>Tradecus</title>
<link href="css/template.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
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
//-->
</script>
<script language="javascript">
function valid(f){
var msj="";
var nc=0;
//bucle for paso 16 para saber el total campos
	for(i=0; i<f.length; i++){
	//si el elemento definido en la array formulario esta vacio...
		if(f.elements[i].value == ""){
			f.elements[i].style.backgroundColor = '#f96';
			nc=1;
		}else{
		   f.elements[i].style.backgroundColor = '';
		}
	}	
  if(nc>0){
  alert("Datos Incompletos");
  }else{
  f.submit();
  }
} 
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


</head>

<body onload="MM_preloadImages('imagenes/salud-on.jpg','imagenes/tecnologia-on.jpg')">
<div id="menu"> 
<div id="menu_iz"> </div> <div id="menu_arr" align="right"><script type="text/javascript" language="JavaScript1.2" src="js/reloj.js"></script></div><div id="menu_de"></div>
    	<?php include("menu.php");?>
</div>
	<div id="cuerpo">
	  <div id="izquierda">
        <?php include("izquierdo.php");?>
	  </div>
	  <div id="contenido"><img src="imagenes/titulo-contactenos.jpg" />
        <div class="textos"> 
          <FORM ACTION="contactenos.php" METHOD="post" name="fc" id="fc">
  <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
<tr>
  <td>
        <p >Escriba su Nombre: <br />
          <input name="nombre" type="text" class="cuadros" id="nombre" size="40" />
        </p>
        <p >Escriba su email: <br />
          <input name="email" type="text" class="cuadros" id="email" size="40" />
        </p>
        <p>Escriba su Tel&eacute;fono: <br />
          <input name="telefono" type="text" class="cuadros" id="telefono" size="40" />
        </p>
        <p >Escriba su consulta: <br />
          <textarea name="mensaje" cols="50" rows="6" class="cuadros" id="mensaje"></textarea>
          </p>          </td>
    </tr>
        
        <tr>
          <td><table>
              <tr>
                <td ><input name="btnenvio" type="button" class="moduloleft1_boton" id="btnenvio" onclick="valid(fc)"  value="Enviar" />                </td>
                <td><input name="reset" type="reset" class="moduloleft1_boton" value="Borrar" />                </td>
              </tr>
          </table></td>
        </tr>
        
        <tr> <td><div class="texto_iconos"> 
        <p> <img src="imagenes/direccion.png" /><strong>Ubicación:</strong> Isla Santa Fe N43-12, ofi. 301 y Thomas de Berlanga</p>
        <p> <img src="imagenes/telefono.png" /><strong>Teléfono:</strong> (593) 02-275279. (593) 02-2484393. (593) 09-3613180</p>
        <p><img src="imagenes/mail.png" /><strong>Información:</strong> <a href="mailto:info@tradecus.com.ec">info@tradecus.com.ec</a>, <strong><br />
          Ventas</strong>: <a href="mailto:sales@tradecus.com.ec">sales@tradecus.com.ec</a></p>
<p> Quito, Ecuador</p>
      <?php if(isset($_GET['e']) and $_GET['e']==1){ ?>
      <p style="color:#900"> MENSAJE ENVIADO, GRACIAS POR CONTACTARNOS</p>
      <?php }elseif(isset($_GET['e']) and $_GET['e']==2){ ?>
      <p style="color:#900"> ERROR DE ENV&Iacute;O, INT&Eacute;NTELO NUEVAMENTE</p>
      <?php } ?>
      </div>
      </tr></td>
  </table>
</form>

      </div>
      <div id="derecha"> <?php include("derecha.php");?></div></div>
      <div class="vacio"></div>
	<?php include("pie.php");?>

</div>
	<div class="abajo_iz"></div><div class="abajo"></div><div class="abajo_de"></div>
</body>
</html>