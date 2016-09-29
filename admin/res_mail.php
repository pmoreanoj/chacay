<?php 
if (!isset($_SESSION)) {
  session_start();
}
include_once("../conect.php");
if($_SESSION['id_us']){
$idop=$_SESSION['id_us'];
$du=mysql_fetch_object(mysql_query("select * from usuarios where idus=".$idop));
}else{
header("Location:index.php");
}//fin de if($_SESSION['cod_e']){
	
$vr=$_GET['r'];
$rowr=mysql_fetch_object(mysql_query("select * from reservas where idr=".$vr));
///Insertar Noticia
if($_POST){
////////////////////enviar mensaje html/////
$cuerpo='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
                <td><img src="http://www.amigosprofesionales.com/chacay/imagenes/chacay.png" width="112" height="40" /></td>
                <td><div align="center">
                      <span class="Estilo1"><strong>Chacay</strong></span><br />
                      <span class="style21"> '.$du->direccion.'<br />
                      Phone:'.$du->telefono.' <br /> 
                      '.$du->ciudad.'- '.$du->pais.'</span><br />
                      <strong class="Estilo11"></strong></div></td>
              </tr>
            </table>
          </td>
          <td class="ladod"><strong>Date: </strong>'.date('Y-m-d').'</td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td class="ladoi"><strong>Name: </strong>'.$rowr->cliente.'</td>
          <td class="ladod">&nbsp;</td>
        </tr>
      </table>
      <table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>Tour:</td>
          <td>'.$rowr->servicio.'</td>
        </tr>
        <tr>
          <td>Number of People:</td>
          <td>'.$rowr->personas.'</td>
        </tr>
        <tr>
          <td>What date:</td>
          <td>'.$rowr->fechar.'</td>
        </tr>
        <tr>
          <td>Comments:</td>
          <td>'.$rowr->comentario.'</td>
        </tr>
      </table>
      <strong>Reply</strong><br />
      <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
        <tr bgcolor="#FFFFFF">
          <td class="ladoi">'.$_POST['comc'].'</td>
        </tr>
      </table></td>
  </tr>
</table>';
if($_POST['link']==1){//envio de link de pago opcional
$cuerpo.='<table width="90%" align="center" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC"><tr bgcolor="#FFFFFF"><td>You can pay securely on the following link:<br>
<a href="http://www.amigosprofesionales.com/chacay/pago.php?id='. md5($rowr->idr) .'">http://www.amigosprofesionales.com/chacay/pago.php?id='. md5($rowr->idr) .'
</a></td></tr></table>';
}
$cuerpo.='</body>
</html>';
$sql="update reservas set estado=1,precio='". $_POST['pre']."',idl='". md5($rowr->idr)."',respuesta='".$cuerpo."' where idr=".$vr;
mysql_query($sql);
// Para enviar correo HTML, la cabecera Content-type debe definirse
			$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
			$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			// Cabeceras adicionales
		   $cabeceras .= 'From: '.$du->email . "\r\n";
		 // Enviamos el mensaje por e-mail
			@mail($rowr->email, 'Reply Chacay', $cuerpo,$cabeceras);
			@mail($du->email, 'Reply Chacay', $cuerpo,$cabeceras);
 
 $fallo='Respuesta Enviada';
}elseif($_POST){ 
 $fallo='Respuesta No Enviada';
}// fin de if(strlen($vtextot)>10){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Respuesta Reserva</title>
<script language="javascript" type="text/javascript" src="../tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull",
		theme_advanced_buttons2 : "",
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
</script>
<style type="text/css">
<!--
.Estilo10 {	font-size: 20px;
	color: #000033;
}
.Estilo11 {	font-size: 20px;
	color:#990000;
}
.boton {width:115px; height:25px; font-size:11px; font-family:Verdana; font-weight:bold }
.Estilo14 {
	font-size: 10px;
	font-family: Verdana;
}
.Estilo1 {
	color: #990000;
	font-weight: bold;
}
.link2 {color:#000099; font-family:Verdana; font-size:12px; font-weight:bold}
.textop {font-family:Verdana; font-size:10px; color:#333 }
-->
</style>
<script language="javascript">
function enviot(f){
 var  msj='';
 //if(f.tit.value==''){ msj=msj + "Ingrese un titulo"; }
 if(msj==''){
  f.env.value='Enviando';
  f.env.disabled=true;
  f.submit();
 }else{
  alert(msj);
 }
}
function ingresado(){
//window.opener.location.href='index_1.php?option=us';
window.opener.location.reload();
//window.close();
}
</script>
</head>

<body onLoad="<?php if($fallo=='Respuesta Enviada'){ echo "ingresado()";}  ?>">
<?php if($fallo=='Respuesta Enviada'){ 
echo $cuerpo;
}elseif($rowr->estado==1){
	echo $rowr->respuesta;
}else{
?>
<div align="right"><a href="#" onclick="window.close()" style="font-size:smaller; color:#000000">Cerrar Ventana</a></div>
<form action="res_mail.php?r=<?php echo $vr; ?>" method="post" enctype="multipart/form-data" name="fdoc" id="fdoc">
        <table border="0" align="center" cellpadding="1" cellspacing="2" bgcolor="#F4F4F4">
          <tr>
            <td>&nbsp;</td>
            <td class="Estilo10">Enviar respuesta reservaci&oacute;n</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><?php 
			echo ' <span class="Estilo1">'.$fallo.'</span>';
			?></td>
          </tr>
          <tr>
            <td width="76"><div align="right"><strong>Tour</strong></div></td>
            <td width="540"><?php 
			echo $rowr->servicio;
			?></td>
          </tr>
          <tr>
            <td><div align="right"><strong>Para:</strong></div></td>
            <td><?php 
			echo $rowr->cliente.' ('.$rowr->email.')';
			?></td>
          </tr>
          <tr>
            <td colspan="2"><strong>Respuesta:</strong><br>
            <textarea name="comc" cols="80" rows="15" id="comc">
			  <?php echo $rown->des; ?>
			  </textarea></td>
          </tr>

          <tr>
            <td colspan="2"><strong>PRECIO:</strong><label>
<input type="text" name="pre" id="pre" />
USD</label></td>
          </tr>
          <tr>
            <td colspan="2"><label>
              <input name="link" type="checkbox" id="link" value="1" />
            Incluir Link de Pago</label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input name="env" type="button" class="boton" id="env" onClick="enviot(fdoc)" value="ENVIAR"></td>
          </tr>
        </table>
      </form>
      <?php }//fin de if($fallo=='Respuesta Enviada'){ ?>
</body>
</html>