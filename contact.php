<?php 
include_once("conect.php");
include("Contador/contador.php");
$re=mysql_fetch_object(mysql_query("select * from usuarios where idus=1"));
if (isset($_POST['email'])) {
	$dest = "reyesjorge_10@hotmail.com, david@chacay.com";
	//$head = "From: ".$_POST['email']."\r\n";
	$head = "From: CHACAY CONTACTO\r\n";
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
		$msg.= " Mensaje creado por www.chacay.com \n";
	// Finalmente enviamos el mensaje
	if (mail($dest, "Nuevo CONTACTO", $msg, $head)) {
		mysql_query("insert into contactos values('','". trim($_POST['nombre']) ."','". trim($_POST['ciudad']) ."','". trim($_POST['telefono']) ."','". trim($_POST['email']) ."','". trim($_POST['mensaje']) ."',NOW())");
		 header("Location: contact.php?e=1");
	} else {
		//echo "rpta=error";
		header("Location: contact.php?e=2");
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script language="javascript" src="js/jquery.js"></script>
   <script type="text/javascript" src="./js/codjs.js"></script>
<title>Chacay</title>
<link href="css/template.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="images/favicon.ico">
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

<body>
<div id="contenedor">
  <?php include_once('header.php'); ?>
  <div id="contenido">	

    <div class="animacion">    </div>
    <div id="contenido_right">
    <div class="textos"> 
          <FORM ACTION="contact.php" METHOD="post" name="fc" id="fc">
  <table width="98%" border="0" align="left" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
<tr>
  <td width="66%">
  <?php if(isset($_GET['e']) and $_GET['e']==1){ ?>
          <p style="color:#900"> MESSAGE SENT, THANKS FOR CONTACT</p>
          <?php }elseif(isset($_GET['e']) and $_GET['e']==2){ ?>
          <p style="color:#900">SEND ERROR, TRY AGAIN</p>
          <?php } ?>
          
        <p >Your Name: <br />
          <input name="nombre" type="text" class="cuadros" id="nombre" size="40" />
        </p>
        <p >Your email: <br />
          <input name="email" type="text" class="cuadros" id="email" size="40" />
        </p>
        <p>Your Phone: <br />
          <input name="telefono" type="text" class="cuadros" id="telefono" size="40" />
        </p>
        <p>Your message: <br />
          <textarea name="mensaje" cols="50" rows="6" class="cuadros" id="mensaje"></textarea>
          </p>          
          </td>
          <td><img src="imagenes/descriptive.jpg" width="230" height="135" /></td>
    </tr>
        
        <tr>
          <td ><table>
              <tr>
                <td ><input name="btnenvio" type="button" class="moduloleft1_boton" id="btnenvio" onclick="valid(fc)"  value="Enviar" />                </td>
                <td><input name="reset" type="reset" class="moduloleft1_boton" value="Borrar" />                </td>
              </tr>
          </table></td>
        </tr>
        
        <tr> <td colspan="7"><div class="texto_iconos"> <br />
          <p> <img src="imagenes/direccion.png" /><strong>Address:</strong><?php echo $re->direccion; ?></p>
          <p> <img src="imagenes/fono.png" /><strong>Phone:</strong><?php echo $re->telefono; ?> (<?php echo $re->ciudad; ?>, <?php echo $re->pais; ?>)</p>
          <p><img src="imagenes/email.png" /><strong>Information:</strong> <a href="mailto:info@tradecus.com.ec"><?php echo $re->email; ?></a>, <br />
            </p>
  <p> Quito, Ecuador</p>
          <?php if(isset($_GET['e']) and $_GET['e']==1){ ?>
          <p style="color:#900"> MESSAGE SENT, THANKS FOR CONTACT</p>
          <?php }elseif(isset($_GET['e']) and $_GET['e']==2){ ?>
          <p style="color:#900">SEND ERROR, TRY AGAIN</p>
          <?php } ?>
          </div></tr>
        </td>
  </table>
</form>

      </div>
    </div></div>
  <?php include_once('pie.php'); ?>
  <div class="vacio"></div>
</div>
<div class="compra">Copyright 2013 EbusinessEcuador</div>
</body>
</html>